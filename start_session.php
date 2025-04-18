<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page with a message
    header("Location: login.php?redirect=meditation.php&message=Please log in to start an activity session");
    exit;
}

// Include database connection
include 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $session_type = $_POST['session_type'];
    $duration = $_POST['duration'];
    $activity_type = isset($_POST['activity_type']) ? $_POST['activity_type'] : 'meditation';
    
    // Calculate start_time and end_time
    $start_time = date('Y-m-d H:i:s'); // Current time
    $end_time = date('Y-m-d H:i:s', strtotime("+{$duration} minutes"));
    
    // Insert the session
    $stmt = $conn->prepare("INSERT INTO meditation_sessions (user_id, session_type, duration, start_time, end_time, activity_type) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isisss", $user_id, $session_type, $duration, $start_time, $end_time, $activity_type);
    
    if ($stmt->execute()) {
        // Redirect to timer page
        header("Location: meditation_timer.php?duration=" . $duration . "&session_id=" . $conn->insert_id . "&activity_type=" . $activity_type);
        exit;
    } else {
        // Redirect based on activity type
        if ($activity_type === 'exercise') {
            header("Location: exercise.php?error=Failed to start session");
        } else {
            header("Location: meditation.php?error=Failed to start session");
        }
        exit;
    }
    
    $stmt->close();
} else {
    header("Location: meditation.php");
    exit;
}

$conn->close();
?> 