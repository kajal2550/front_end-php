<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();

// Check if user is logged in
if(!isset($_SESSION['user_id'])) {
    // Redirect to login page with a message
    header("Location: login.php?redirect=tracker.php&message=Please log in to access your meditation tracker");
    exit;
}

// Include database connection
include 'includes/db.php';

// Get user data
$user_id = $_SESSION['user_id'];

// Check for success message from start_session.php
$success_message = '';
if (isset($_GET['success']) && $_GET['success'] == 1) {
    $success_message = "Your activity session has been recorded successfully!";
}

// Process form submission for adding new session
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_session'])) {
    // Debug form data
    error_log("Form submitted with data: " . print_r($_POST, true));
    error_log("User ID from session: " . $_SESSION['user_id']);

    $date = $_POST['date'];
    $duration = $_POST['duration'];
    $session_type = $_POST['session_type'];
    $notes = isset($_POST['notes']) ? $_POST['notes'] : '';
    $activity_type = isset($_POST['activity_type']) ? $_POST['activity_type'] : 'meditation';
    
    // Calculate start_time and end_time based on date and duration
    $start_time = $date . ' ' . date('H:i:s');
    $end_time = date('Y-m-d H:i:s', strtotime($start_time . ' + ' . $duration . ' minutes'));
    
    // Debug values
    error_log("Calculated times - Start: $start_time, End: $end_time");
    
    $stmt = $conn->prepare("INSERT INTO meditation_sessions (user_id, start_time, end_time, duration, session_type, notes, activity_type) VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        $error_message = "Error preparing statement: " . $conn->error;
    } else {
        error_log("Statement prepared successfully");
        $stmt->bind_param("ississs", $user_id, $start_time, $end_time, $duration, $session_type, $notes, $activity_type);
        
        if ($stmt->execute()) {
            error_log("Session added successfully - Last Insert ID: " . $conn->insert_id);
            $success_message = "Activity session added successfully!";
            // Redirect to prevent form resubmission
            header("Location: tracker.php?success=1");
            exit;
        } else {
            error_log("Execute failed: " . $stmt->error);
            $error_message = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

// Get activity data for charts
$past_week = date('Y-m-d', strtotime('-7 days'));
$past_month = date('Y-m-d', strtotime('-30 days'));

// Weekly data
$weekly_data = array();
$weekly_stmt = $conn->prepare("
    SELECT DATE(start_time) as session_date, SUM(duration) as total_duration, activity_type
    FROM meditation_sessions 
    WHERE user_id = ? AND DATE(start_time) >= ? 
    GROUP BY DATE(start_time), activity_type
    ORDER BY DATE(start_time) ASC
");

if ($weekly_stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$weekly_stmt->bind_param("is", $user_id, $past_week);
$weekly_stmt->execute();
$weekly_result = $weekly_stmt->get_result();

$meditation_weekly_data = array();
$exercise_weekly_data = array();

while ($row = $weekly_result->fetch_assoc()) {
    if ($row['activity_type'] == 'exercise') {
        $exercise_weekly_data[$row['session_date']] = $row['total_duration'];
    } else {
        $meditation_weekly_data[$row['session_date']] = $row['total_duration'];
    }
}

// Total stats
$stats_stmt = $conn->prepare("
    SELECT 
        COUNT(DISTINCT id) as total_sessions,
        COALESCE(SUM(duration), 0) as total_minutes,
        COALESCE(ROUND(AVG(duration)), 0) as avg_duration,
        COALESCE(MAX(duration), 0) as longest_session,
        activity_type
    FROM meditation_sessions 
    WHERE user_id = ?
    GROUP BY activity_type
");

if (!$stats_stmt) {
    error_log("Stats prepare failed: " . $conn->error);
    die("Error preparing stats statement: " . $conn->error);
}

$stats_stmt->bind_param("i", $user_id);

if (!$stats_stmt->execute()) {
    error_log("Stats execute failed: " . $stats_stmt->error);
    die("Error executing stats query: " . $stats_stmt->error);
}

$stats_result = $stats_stmt->get_result();

$meditation_stats = [
    'total_sessions' => 0,
    'total_minutes' => 0,
    'avg_duration' => 0,
    'longest_session' => 0
];

$exercise_stats = [
    'total_sessions' => 0,
    'total_minutes' => 0,
    'avg_duration' => 0,
    'longest_session' => 0
];

while ($row = $stats_result->fetch_assoc()) {
    if ($row['activity_type'] == 'exercise') {
        $exercise_stats = $row;
    } else {
        $meditation_stats = $row;
    }
}

// Recent sessions
$recent_stmt = $conn->prepare("
    SELECT * FROM meditation_sessions 
    WHERE user_id = ? 
    ORDER BY start_time DESC, id DESC
");
$recent_stmt->bind_param("i", $user_id);
$recent_stmt->execute();
$recent_result = $recent_stmt->get_result();

// Session types data for pie chart
$types_stmt = $conn->prepare("
    SELECT session_type, COUNT(*) as count, activity_type 
    FROM meditation_sessions 
    WHERE user_id = ? 
    GROUP BY session_type, activity_type
");
$types_stmt->bind_param("i", $user_id);
$types_stmt->execute();
$types_result = $types_stmt->get_result();

$meditation_session_types = array();
$meditation_session_counts = array();
$exercise_session_types = array();
$exercise_session_counts = array();

while ($row = $types_result->fetch_assoc()) {
    if ($row['activity_type'] == 'exercise') {
        $exercise_session_types[] = $row['session_type'];
        $exercise_session_counts[] = $row['count'];
    } else {
        $meditation_session_types[] = $row['session_type'];
        $meditation_session_counts[] = $row['count'];
    }
}

$weekly_stmt->close();
$stats_stmt->close();
$recent_stmt->close();
$types_stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activity Tracker - ZenSpace</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            light: '#8B5CF6', // lavender
                            DEFAULT: '#7C3AED',
                            dark: '#6D28D9',
                        },
                        secondary: {
                            light: '#5EEAD4', // teal
                            DEFAULT: '#14B8A6',
                            dark: '#0D9488',
                        },
                        accent: {
                            light: '#BFDBFE', // light sky blue
                            DEFAULT: '#93C5FD',
                            dark: '#60A5FA',
                        },
                        calm: {
                            light: '#FED7AA', // pale peach
                            DEFAULT: '#FDBA74',
                            dark: '#FB923C',
                        }
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style type="text/css">
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .gradient-bg {
            background: linear-gradient(120deg, rgba(139, 92, 246, 0.1), rgba(94, 234, 212, 0.1));
            background-size: 300% 300%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.5s ease-in-out forwards;
        }
        
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(10px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in:nth-child(1) { animation-delay: 0.1s; }
        .fade-in:nth-child(2) { animation-delay: 0.2s; }
        .fade-in:nth-child(3) { animation-delay: 0.3s; }
        .fade-in:nth-child(4) { animation-delay: 0.4s; }
        .fade-in:nth-child(5) { animation-delay: 0.5s; }
        
        /* Activity toggle styles */
        .activity-toggle {
            transition: all 0.3s ease;
            color: #7C3AED;
        }
        
        .active-toggle {
            background-color: rgba(124, 58, 237, 0.1);
            color: #7C3AED;
            font-weight: 600;
        }
        
        .dark .activity-toggle {
            color: #8B5CF6;
        }
        
        .dark .active-toggle {
            background-color: rgba(139, 92, 246, 0.2);
            color: #8B5CF6;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <?php include 'includes/header.php'; ?>
    
    <main>
        <!-- Hero Section -->
        <section class="py-12 gradient-bg">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-4xl font-bold mb-4 text-gray-800 dark:text-white fade-in">Your Activity Tracker</h1>
                    <p class="text-lg mb-8 text-gray-600 dark:text-gray-300 fade-in">
                        Track your progress and build consistency in your mindfulness and exercise journey.
                    </p>
                    
                    <!-- Activity Type Toggle -->
                    <div class="flex justify-center mb-8 fade-in">
                        <div class="bg-white dark:bg-gray-800 rounded-full p-1 inline-flex">
                            <button id="meditation-toggle" class="activity-toggle px-6 py-2 rounded-full text-sm font-medium active-toggle">
                                Meditation
                            </button>
                            <button id="exercise-toggle" class="activity-toggle px-6 py-2 rounded-full text-sm font-medium">
                                Exercise
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Header Section -->
        <section class="relative py-20 gradient-bg">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center">
                    <!-- <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800 dark:text-white fade-in" id="activity-title">
                        Your Meditation Journey
                    </h1>
                    <p class="text-lg mb-8 text-gray-600 dark:text-gray-300 fade-in" id="activity-description">
                        Track your progress and celebrate your meditation consistency.
                    </p> -->
                   
                </div>
            </div>
        </section>
        
        <!-- Statistics Section -->
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 max-w-4xl mx-auto">
                    <!-- Meditation Stats -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300 fade-in meditation-stats lg:col-start-1">
                        <div class="flex w-full items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Sessions</h3>
                            <i class="fas fa-spa text-indigo-500 text-xl"></i>
                        </div>
                        <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400"><?php echo $meditation_stats['total_sessions']; ?></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Meditation sessions completed</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300 fade-in meditation-stats">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Minutes</h3>
                            <i class="fas fa-clock text-indigo-500 text-xl"></i>
                        </div>
                        <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400"><?php echo $meditation_stats['total_minutes']; ?></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Minutes spent meditating</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300 fade-in meditation-stats">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Average Session</h3>
                            <i class="fas fa-chart-line text-indigo-500 text-xl"></i>
                        </div>
                        <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400"><?php echo $meditation_stats['avg_duration']; ?></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Minutes per session</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300 fade-in meditation-stats">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Longest Session</h3>
                            <i class="fas fa-trophy text-indigo-500 text-xl"></i>
                        </div>
                        <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400"><?php echo $meditation_stats['longest_session']; ?></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Minutes in one session</p>
                    </div>

                    <!-- Exercise Stats -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300 fade-in exercise-stats hidden lg:col-start-1">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Workouts</h3>
                            <i class="fas fa-dumbbell text-blue-500 text-xl"></i>
                        </div>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400"><?php echo $exercise_stats['total_sessions']; ?></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Exercise sessions completed</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300 fade-in exercise-stats hidden">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Total Minutes</h3>
                            <i class="fas fa-clock text-blue-500 text-xl"></i>
                        </div>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400"><?php echo $exercise_stats['total_minutes']; ?></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Minutes spent exercising</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300 fade-in exercise-stats hidden">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Average Session</h3>
                            <i class="fas fa-chart-line text-blue-500 text-xl"></i>
                        </div>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400"><?php echo $exercise_stats['avg_duration']; ?></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Minutes per session</p>
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 transform hover:scale-105 transition-transform duration-300 fade-in exercise-stats hidden">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Longest Session</h3>
                            <i class="fas fa-trophy text-blue-500 text-xl"></i>
                        </div>
                        <p class="text-3xl font-bold text-blue-600 dark:text-blue-400"><?php echo $exercise_stats['longest_session']; ?></p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Minutes in one session</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Charts -->
        <section class="py-16 bg-gray-50 dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Weekly Meditation Chart -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md fade-in">
                            <h3 class="text-xl font-semibold mb-6 text-gray-800 dark:text-white">This Week's Progress</h3>
                            <div class="h-80">
                                <canvas id="weeklyChart"></canvas>
                            </div>
                        </div>
                        
                        <!-- Session Types Chart -->
                        <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md fade-in">
                            <h3 class="text-xl font-semibold mb-6 text-gray-800 dark:text-white">Session Types</h3>
                            <div class="h-80">
                                <canvas id="typesChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Recent Sessions & Add New -->
        <section class="py-16 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <!-- Recent Sessions -->
                    <div class="fade-in">
                        <h3 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">Your Activity History</h3>
                        
                        <?php
                        // Get recent activities (both meditation and exercise)
                        $recent_stmt = $conn->prepare("
                            SELECT * FROM meditation_sessions 
                            WHERE user_id = ? 
                            ORDER BY start_time DESC, id DESC
                            LIMIT 10
                        ");
                        $recent_stmt->bind_param("i", $user_id);
                        $recent_stmt->execute();
                        $recent_result = $recent_stmt->get_result();
                        
                        if ($recent_result->num_rows > 0): ?>
                            <div class="space-y-4 max-h-[600px] overflow-y-auto pr-4">
                                <?php 
                                $current_date = '';
                                while ($session = $recent_result->fetch_assoc()): 
                                    $session_date = date('F j, Y', strtotime($session['start_time']));
                                    if ($current_date != $session_date):
                                        $current_date = $session_date;
                                ?>
                                    <div class="sticky top-0 bg-white dark:bg-gray-800 py-2 z-10">
                                        <h4 class="text-lg font-medium text-primary dark:text-primary-light"><?php echo $session_date; ?></h4>
                                    </div>
                                <?php endif; ?>
                                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-4 shadow-sm hover:shadow-md transition duration-300">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-3">
                                                    <?php if ($session['activity_type'] === 'exercise'): ?>
                                                        <span class="bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-400 px-3 py-1 rounded-full text-sm font-medium">
                                                            <i class="fas fa-dumbbell mr-1"></i><?php echo $session['duration']; ?> min
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="bg-primary/10 text-primary dark:text-primary-light px-3 py-1 rounded-full text-sm font-medium">
                                                            <i class="fas fa-spa mr-1"></i><?php echo $session['duration']; ?> min
                                                        </span>
                                                    <?php endif; ?>
                                                    <h4 class="font-medium text-gray-800 dark:text-white"><?php echo htmlspecialchars($session['session_type']); ?></h4>
                                                </div>
                                                <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                    <?php 
                                                    $start = new DateTime($session['start_time']);
                                                    $end = new DateTime($session['end_time']);
                                                    echo $start->format('g:i A') . ' - ' . $end->format('g:i A'); 
                                                    ?>
                                                </div>
                                                <?php if (!empty($session['notes'])): ?>
                                                    <div class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                                        <i class="fas fa-sticky-note mr-1"></i><?php echo htmlspecialchars($session['notes']); ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        <?php else: ?>
                            <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-6 text-center">
                                <p class="text-gray-600 dark:text-gray-300">You haven't logged any activities yet.</p>
                                <p class="text-gray-600 dark:text-gray-300 mt-2">Start tracking your meditation and exercise sessions.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        
        

                        
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Weekly Chart
            var weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
            var weeklyChart = new Chart(weeklyCtx, {
                type: 'bar',
                data: {
                    labels: [
                        <?php 
                        for($i = 6; $i >= 0; $i--) {
                            $date = date('Y-m-d', strtotime("-$i days"));
                            echo "'" . date('D, M j', strtotime($date)) . "', ";
                        }
                        ?>
                    ],
                    datasets: [{
                        label: 'Minutes Meditated',
                        data: [
                            <?php 
                            for($i = 6; $i >= 0; $i--) {
                                $date = date('Y-m-d', strtotime("-$i days"));
                                echo isset($meditation_weekly_data[$date]) ? $meditation_weekly_data[$date] : 0;
                                echo ", ";
                            }
                            ?>
                        ],
                        backgroundColor: 'rgba(124, 58, 237, 0.5)',
                        borderColor: '#7C3AED',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Minutes'
                            }
                        }
                    }
                }
            });
            
            // Types Chart
            var typesCtx = document.getElementById('typesChart').getContext('2d');
            var typesChart = new Chart(typesCtx, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($meditation_session_types); ?>,
                    datasets: [{
                        data: <?php echo json_encode($meditation_session_counts); ?>,
                        backgroundColor: [
                            'rgba(124, 58, 237, 0.7)',
                            'rgba(14, 165, 233, 0.7)',
                            'rgba(20, 184, 166, 0.7)',
                            'rgba(249, 115, 22, 0.7)',
                            'rgba(236, 72, 153, 0.7)',
                            'rgba(168, 85, 247, 0.7)',
                            'rgba(59, 130, 246, 0.7)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                        }
                    }
                }
            });
            
            // Initialize fade-in elements
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('opacity-100');
                }, 100 * index);
            });
        });
    </script>
    <script>
        // Activity Type Toggle
        const meditationToggle = document.getElementById('meditation-toggle');
        const exerciseToggle = document.getElementById('exercise-toggle');
        const activityTypeInput = document.getElementById('activity_type');
        
        // Initialize activity type based on stored preference or default to meditation
        let currentActivityType = localStorage.getItem('zenspace_activity_type') || 'meditation';
        
        // Set initial toggle state
        if (currentActivityType === 'exercise') {
            meditationToggle.classList.remove('active-toggle');
            exerciseToggle.classList.add('active-toggle');
            
            // If there's a form with activity_type input, update it
            if (activityTypeInput) {
                activityTypeInput.value = 'exercise';
            }
            
            // Hide meditation stats, show exercise stats if they exist
            document.querySelectorAll('.meditation-stats').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.exercise-stats').forEach(el => el.classList.remove('hidden'));
        } else {
            meditationToggle.classList.add('active-toggle');
            exerciseToggle.classList.remove('active-toggle');
            
            // If there's a form with activity_type input, update it
            if (activityTypeInput) {
                activityTypeInput.value = 'meditation';
            }
            
            // Show meditation stats, hide exercise stats
            document.querySelectorAll('.meditation-stats').forEach(el => el.classList.remove('hidden'));
            document.querySelectorAll('.exercise-stats').forEach(el => el.classList.add('hidden'));
        }
        
        // Toggle between meditation and exercise
        meditationToggle.addEventListener('click', () => {
            meditationToggle.classList.add('active-toggle');
            exerciseToggle.classList.remove('active-toggle');
            currentActivityType = 'meditation';
            localStorage.setItem('zenspace_activity_type', currentActivityType);
            
            // If there's a form with activity_type input, update it
            if (activityTypeInput) {
                activityTypeInput.value = 'meditation';
            }
            
            // Show meditation stats, hide exercise stats
            document.querySelectorAll('.meditation-stats').forEach(el => el.classList.remove('hidden'));
            document.querySelectorAll('.exercise-stats').forEach(el => el.classList.add('hidden'));
        });
        
        exerciseToggle.addEventListener('click', () => {
            exerciseToggle.classList.add('active-toggle');
            meditationToggle.classList.remove('active-toggle');
            currentActivityType = 'exercise';
            localStorage.setItem('zenspace_activity_type', currentActivityType);
            
            // If there's a form with activity_type input, update it
            if (activityTypeInput) {
                activityTypeInput.value = 'exercise';
            }
            
            // Hide meditation stats, show exercise stats
            document.querySelectorAll('.meditation-stats').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.exercise-stats').forEach(el => el.classList.remove('hidden'));
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const meditationBtn = document.getElementById('meditation-btn');
            const exerciseBtn = document.getElementById('exercise-btn');
            const activityType = document.getElementById('activity_type');
            const meditationStats = document.querySelectorAll('.meditation-stats');
            const exerciseStats = document.querySelectorAll('.exercise-stats');

            // Function to switch between meditation and exercise
            function switchActivity(type) {
                if (type === 'meditation') {
                    meditationBtn.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                    meditationBtn.classList.add('bg-indigo-600', 'text-white');
                    exerciseBtn.classList.remove('bg-indigo-600', 'text-white');
                    exerciseBtn.classList.add('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                    
                    meditationStats.forEach(stat => stat.classList.remove('hidden'));
                    exerciseStats.forEach(stat => stat.classList.add('hidden'));
                } else {
                    exerciseBtn.classList.remove('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                    exerciseBtn.classList.add('bg-indigo-600', 'text-white');
                    meditationBtn.classList.remove('bg-indigo-600', 'text-white');
                    meditationBtn.classList.add('bg-gray-200', 'dark:bg-gray-700', 'text-gray-700', 'dark:text-gray-300');
                    
                    exerciseStats.forEach(stat => stat.classList.remove('hidden'));
                    meditationStats.forEach(stat => stat.classList.add('hidden'));
                }
                activityType.value = type;
            }

            // Event listeners for activity buttons
            meditationBtn.addEventListener('click', () => switchActivity('meditation'));
            exerciseBtn.addEventListener('click', () => switchActivity('exercise'));

            // Form submission handler
            const form = document.getElementById('activity-form');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = new FormData(form);
                fetch('tracker.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    // Reload the page to show updated stats
                    window.location.reload();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while saving your activity. Please try again.');
                });
            });
        });
    </script>
</body>
</html> 