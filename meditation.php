<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guided Meditation - ZenSpace</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
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
                    },
                    animation: {
                        'breathing': 'breathe 8s infinite ease-in-out',
                    },
                    keyframes: {
                        breathe: {
                            '0%, 100%': { transform: 'scale(1)', opacity: '0.9' },
                            '50%': { transform: 'scale(1.2)', opacity: '0.7' },
                        }
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
            background: linear-gradient(120deg, rgba(139, 92, 246, 0.1), rgba(94, 234, 212, 0.1), rgba(191, 219, 254, 0.1));
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
            transition: opacity 0.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <?php include 'includes/header.php'; ?>
    
    <main>
        <!-- Hero Section -->
        <section class="relative py-20 gradient-bg">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800 dark:text-white fade-in">Guided Meditation</h1>
                    <p class="text-lg mb-8 text-gray-600 dark:text-gray-300 fade-in">
                        Select from our collection of mindful sessions designed to help you relax, focus, and rejuvenate.
                    </p>
                    
                    <!-- Meditation Filters -->
                    <div class="mb-8 fade-in">
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Filter by Duration</h3>
                        <div class="flex flex-wrap justify-center gap-3 mb-6">
                            <button class="duration-filter bg-primary text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300" data-duration="all">
                                All
                            </button>
                            <button class="duration-filter bg-white dark:bg-gray-800 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300" data-duration="5">
                                5 Minutes
                            </button>
                            <button class="duration-filter bg-white dark:bg-gray-800 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300" data-duration="10">
                                10 Minutes
                            </button>
                            <button class="duration-filter bg-white dark:bg-gray-800 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300" data-duration="20">
                                20 Minutes
                            </button>
                        </div>
                        
                        <h3 class="text-lg font-medium text-gray-700 dark:text-gray-300 mb-4">Filter by Category</h3>
                        <div class="flex flex-wrap justify-center gap-3 mb-10">
                            <button class="category-filter bg-primary text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300" data-category="all">
                                All Categories
                            </button>
                            <button class="category-filter bg-white dark:bg-gray-800 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300" data-category="beginner">
                                Beginner
                            </button>
                            <button class="category-filter bg-white dark:bg-gray-800 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300" data-category="stress">
                                Stress Relief
                            </button>
                            <button class="category-filter bg-white dark:bg-gray-800 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300" data-category="sleep">
                                Sleep
                            </button>
                            <button class="category-filter bg-white dark:bg-gray-800 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300" data-category="focus">
                                Focus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Meditation Sessions -->
        <section class="py-16 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Meditation Session Card 1 -->
                    <div class="meditation-session bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 fade-in" data-duration="5" data-category="beginner">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1518241353330-0f7941c2d9b5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Meditation for Beginners" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 text-primary px-3 py-1 rounded-full text-sm font-medium">
                                5 min
                            </div>
                            <div class="absolute top-4 left-4 bg-primary/80 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Beginner
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Meditation for Beginners</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                A gentle introduction to mindfulness meditation with guided breathing and body awareness exercises.
                            </p>
                            <div class="mb-4 flex flex-wrap gap-2">
                                <span class="inline-block bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-light text-xs px-2 py-1 rounded">Reduce Stress</span>
                                <span class="inline-block bg-secondary/10 text-secondary dark:bg-secondary/20 dark:text-secondary-light text-xs px-2 py-1 rounded">Improve Focus</span>
                                <span class="inline-block bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">For Everyone</span>
                            </div>
                            <form action="start_session.php" method="POST">
                                <input type="hidden" name="session_type" value="Beginner Meditation">
                                <input type="hidden" name="duration" value="5">
                                <button type="submit" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                    <span>Start Session</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Meditation Session Card 2 -->
                    <div class="meditation-session bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 fade-in" data-duration="10" data-category="stress">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Calm Your Mind" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 text-primary px-3 py-1 rounded-full text-sm font-medium">
                                10 min
                            </div>
                            <div class="absolute top-4 left-4 bg-primary/80 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Stress Relief
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Calm Your Mind</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Release stress and anxiety with this gentle guided meditation featuring progressive relaxation techniques.
                            </p>
                            <div class="mb-4 flex flex-wrap gap-2">
                                <span class="inline-block bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-light text-xs px-2 py-1 rounded">Anxiety Relief</span>
                                <span class="inline-block bg-secondary/10 text-secondary dark:bg-secondary/20 dark:text-secondary-light text-xs px-2 py-1 rounded">Emotional Balance</span>
                                <span class="inline-block bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">All Levels</span>
                            </div>
                            <form action="start_session.php" method="POST">
                                <input type="hidden" name="session_type" value="Stress Relief">
                                <input type="hidden" name="duration" value="10">
                                <button type="submit" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                    <span>Start Session</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Meditation Session Card 3 -->
                    <div class="meditation-session bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 fade-in" data-duration="20" data-category="focus">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1499209974431-9dddcece7f88?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Deep Relaxation" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 text-primary px-3 py-1 rounded-full text-sm font-medium">
                                20 min
                            </div>
                            <div class="absolute top-4 left-4 bg-primary/80 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Focus
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Deep Focus</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Enhance your concentration and productivity with mindfulness techniques to sharpen attention.
                            </p>
                            <div class="mb-4 flex flex-wrap gap-2">
                                <span class="inline-block bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-light text-xs px-2 py-1 rounded">Concentration</span>
                                <span class="inline-block bg-secondary/10 text-secondary dark:bg-secondary/20 dark:text-secondary-light text-xs px-2 py-1 rounded">Mental Clarity</span>
                                <span class="inline-block bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">Intermediate</span>
                            </div>
                            <form action="start_session.php" method="POST">
                                <input type="hidden" name="session_type" value="Deep Focus">
                                <input type="hidden" name="duration" value="20">
                                <button type="submit" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                    <span>Start Session</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Meditation Session Card 4 -->
                    <div class="meditation-session bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 fade-in" data-duration="5" data-category="beginner">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1515377905703-c4788e51af15?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Morning Mindfulness" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 text-primary px-3 py-1 rounded-full text-sm font-medium">
                                5 min
                            </div>
                            <div class="absolute top-4 left-4 bg-primary/80 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Beginner
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Morning Mindfulness</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Energize your day with this quick morning practice to set positive intentions and create clarity.
                            </p>
                            <div class="mb-4 flex flex-wrap gap-2">
                                <span class="inline-block bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-light text-xs px-2 py-1 rounded">Energy</span>
                                <span class="inline-block bg-secondary/10 text-secondary dark:bg-secondary/20 dark:text-secondary-light text-xs px-2 py-1 rounded">Positivity</span>
                                <span class="inline-block bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">For Everyone</span>
                            </div>
                            <form action="start_session.php" method="POST">
                                <input type="hidden" name="session_type" value="Morning Mindfulness">
                                <input type="hidden" name="duration" value="5">
                                <button type="submit" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                    <span>Start Session</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Meditation Session Card 5 -->
                    <div class="meditation-session bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 fade-in" data-duration="10" data-category="sleep">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1487147264018-f937fba0c817?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Sleep Meditation" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 text-primary px-3 py-1 rounded-full text-sm font-medium">
                                10 min
                            </div>
                            <div class="absolute top-4 left-4 bg-primary/80 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Sleep
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Sleep Meditation</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Prepare for restful sleep with this soothing practice using body scanning and gentle breathing techniques.
                            </p>
                            <div class="mb-4 flex flex-wrap gap-2">
                                <span class="inline-block bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-light text-xs px-2 py-1 rounded">Better Sleep</span>
                                <span class="inline-block bg-secondary/10 text-secondary dark:bg-secondary/20 dark:text-secondary-light text-xs px-2 py-1 rounded">Insomnia Relief</span>
                                <span class="inline-block bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">All Levels</span>
                            </div>
                            <form action="start_session.php" method="POST">
                                <input type="hidden" name="session_type" value="Sleep Meditation">
                                <input type="hidden" name="duration" value="10">
                                <button type="submit" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                    <span>Start Session</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Meditation Session Card 6 -->
                    <div class="meditation-session bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 fade-in" data-duration="20" data-category="stress">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1447752875215-b2761acb3c5d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Nature Connection" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 text-primary px-3 py-1 rounded-full text-sm font-medium">
                                20 min
                            </div>
                            <div class="absolute top-4 left-4 bg-primary/80 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Stress Relief
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Nature Connection</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Immerse yourself in nature with this visualization journey to reduce stress and increase feelings of peace.
                            </p>
                            <div class="mb-4 flex flex-wrap gap-2">
                                <span class="inline-block bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-light text-xs px-2 py-1 rounded">Inner Peace</span>
                                <span class="inline-block bg-secondary/10 text-secondary dark:bg-secondary/20 dark:text-secondary-light text-xs px-2 py-1 rounded">Visualization</span>
                                <span class="inline-block bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">Intermediate</span>
                            </div>
                            <form action="start_session.php" method="POST">
                                <input type="hidden" name="session_type" value="Nature Connection">
                                <input type="hidden" name="duration" value="20">
                                <button type="submit" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                    <span>Start Session</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Meditation Session Card 7 -->
                    <div class="meditation-session bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 fade-in" data-duration="10" data-category="focus">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Work Focus" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 text-primary px-3 py-1 rounded-full text-sm font-medium">
                                10 min
                            </div>
                            <div class="absolute top-4 left-4 bg-primary/80 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Focus
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Work Focus</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Boost your productivity and concentration with this mindful practice designed for work environments.
                            </p>
                            <div class="mb-4 flex flex-wrap gap-2">
                                <span class="inline-block bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-light text-xs px-2 py-1 rounded">Productivity</span>
                                <span class="inline-block bg-secondary/10 text-secondary dark:bg-secondary/20 dark:text-secondary-light text-xs px-2 py-1 rounded">Work Flow</span>
                                <span class="inline-block bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">All Levels</span>
                            </div>
                            <form action="start_session.php" method="POST">
                                <input type="hidden" name="session_type" value="Work Focus">
                                <input type="hidden" name="duration" value="10">
                                <button type="submit" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                    <span>Start Session</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Meditation Session Card 8 -->
                    <div class="meditation-session bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 fade-in" data-duration="15" data-category="stress">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1474418397713-7ede21d49118?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Anxiety Relief" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 text-primary px-3 py-1 rounded-full text-sm font-medium">
                                15 min
                            </div>
                            <div class="absolute top-4 left-4 bg-primary/80 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Stress Relief
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Anxiety Relief</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Find peace and calmness with this guided meditation specifically designed to reduce anxiety and worry.
                            </p>
                            <div class="mb-4 flex flex-wrap gap-2">
                                <span class="inline-block bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-light text-xs px-2 py-1 rounded">Calm Mind</span>
                                <span class="inline-block bg-secondary/10 text-secondary dark:bg-secondary/20 dark:text-secondary-light text-xs px-2 py-1 rounded">Peace</span>
                                <span class="inline-block bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">All Levels</span>
                            </div>
                            <form action="start_session.php" method="POST">
                                <input type="hidden" name="session_type" value="Anxiety Relief">
                                <input type="hidden" name="duration" value="15">
                                <button type="submit" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                    <span>Start Session</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Meditation Session Card 9 -->
                    <div class="meditation-session bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1 fade-in" data-duration="30" data-category="focus">
                        <div class="relative">
                            <img src="https://images.unsplash.com/photo-1519834785169-98be25ec3f84?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Deep Concentration" class="w-full h-48 object-cover">
                            <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 text-primary px-3 py-1 rounded-full text-sm font-medium">
                                30 min
                            </div>
                            <div class="absolute top-4 left-4 bg-primary/80 text-white px-3 py-1 rounded-full text-sm font-medium">
                                Focus
                            </div>
                        </div>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Deep Concentration</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Achieve deep focus and mental clarity with this extended meditation session for advanced practitioners.
                            </p>
                            <div class="mb-4 flex flex-wrap gap-2">
                                <span class="inline-block bg-primary/10 text-primary dark:bg-primary/20 dark:text-primary-light text-xs px-2 py-1 rounded">Deep Focus</span>
                                <span class="inline-block bg-secondary/10 text-secondary dark:bg-secondary/20 dark:text-secondary-light text-xs px-2 py-1 rounded">Mental Clarity</span>
                                <span class="inline-block bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 text-xs px-2 py-1 rounded">Advanced</span>
                            </div>
                            <form action="start_session.php" method="POST">
                                <input type="hidden" name="session_type" value="Deep Concentration">
                                <input type="hidden" name="duration" value="30">
                                <button type="submit" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                    <span>Start Session</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- No Results Message -->
                <div id="no-results" class="hidden mt-8 text-center">
                    <p class="text-lg text-gray-600 dark:text-gray-300">No meditation sessions match your filters. Try different criteria.</p>
                </div>
            </div>
        </section>
        
        <!-- Extra: Learn More About Meditation -->
        <section class="py-12 bg-gray-50 dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
                    <div class="p-8">
                        <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">New to Meditation?</h2>
                        <p class="text-gray-600 dark:text-gray-300 mb-6">
                            Regular meditation can reduce stress, improve focus, enhance sleep quality, and promote emotional well-being. 
                            Our guided sessions are designed for all experience levels and include detailed instructions.
                        </p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-800 dark:text-white mb-2">Find a Quiet Space</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Choose a peaceful location with minimal distractions where you can sit comfortably.</p>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-800 dark:text-white mb-2">Start Small</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Begin with 5-minute sessions and gradually increase the duration as you become more comfortable.</p>
                            </div>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-medium text-gray-800 dark:text-white mb-2">Be Consistent</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300">Try to meditate at the same time each day to establish a regular practice that becomes a habit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Breathing Exercise -->
        <section class="py-20 bg-gray-50 dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white fade-in">Breathing Exercise</h2>
                    <p class="text-lg mb-12 text-gray-600 dark:text-gray-300 fade-in">
                        Practice mindful breathing anytime, anywhere with our interactive breathing circle.
                    </p>
                    
                    <div class="flex flex-col items-center">
                        <div class="mb-8 fade-in">
                            <div id="breathing-circle" class="w-48 h-48 bg-gradient-to-br from-primary/60 to-secondary/60 rounded-full flex items-center justify-center cursor-pointer shadow-lg hover:shadow-xl transition duration-300">
                                <div class="w-36 h-36 bg-white dark:bg-gray-800 rounded-full flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-primary dark:text-primary-light" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <p id="breathing-instruction" class="text-lg font-medium text-gray-700 dark:text-gray-300 fade-in">
                            Click the circle to start breathing exercise
                        </p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Quote Section -->
        <section class="py-16 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center">
                    <div class="mb-6 text-primary dark:text-primary-light">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                        </svg>
                    </div>
                    <p id="daily-quote" class="text-xl md:text-2xl italic text-gray-700 dark:text-gray-300 fade-in">
                        "The quieter you become, the more you can hear."
                    </p>
                </div>
            </div>
        </section>
    </main>
    
    <!-- Meditation Session Modal -->
    <div id="meditation-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white dark:bg-gray-800 rounded-xl w-full max-w-4xl mx-4 overflow-hidden shadow-2xl transform transition-all">
            <div class="relative">
                <img id="modal-image" src="" alt="Meditation" class="w-full h-64 object-cover">
                <div class="absolute top-4 right-4 bg-white dark:bg-gray-800 text-primary px-3 py-1 rounded-full text-sm font-medium" id="modal-duration">
                    10 min
                </div>
                <div class="absolute top-4 left-4 bg-primary/80 text-white px-3 py-1 rounded-full text-sm font-medium" id="modal-category">
                    Category
                </div>
                <button class="absolute top-4 right-16 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700" id="close-modal">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-8">
                <h2 id="modal-title" class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">Meditation Title</h2>
                <p id="modal-description" class="text-gray-600 dark:text-gray-300 mb-6">
                    Meditation description will appear here.
                </p>
                
                <div class="mb-6 flex flex-wrap gap-2" id="modal-tags">
                    <!-- Tags will be inserted dynamically -->
                </div>
                
                <!-- Audio player -->
                <div class="mb-8 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <div class="flex items-center justify-between mb-4">
                        <div class="flex items-center">
                            <button id="play-pause-btn" class="bg-primary hover:bg-primary-dark text-white rounded-full p-3 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </button>
                            <div>
                                <p class="text-sm text-gray-800 dark:text-gray-200 font-medium" id="track-name">Guided Meditation</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">ZenSpace</p>
                            </div>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            <span id="current-time">0:00</span> / <span id="duration-time">10:00</span>
                        </div>
                    </div>
                    
                    <div class="relative h-2 bg-gray-300 dark:bg-gray-600 rounded-full overflow-hidden">
                        <div id="progress-bar" class="absolute h-full bg-primary rounded-full" style="width: 0%"></div>
                    </div>
                    
                    <audio id="meditation-audio" preload="metadata">
                        <source src="audio/meditation-bowls-23651.mp3" type="audio/mpeg">
                        <source src="audio/beautiful-birdsong-3-301866.mp3" type="audio/mpeg">
                        <source src="audio/angelical-pad-143276.mp3" type="audio/mpeg">
                        <source src="audio/uplifting-pad-texture-113842.mp3" type="audio/mpeg">
                        <source src="audio/beautiful-choir-170206.mp3" type="audio/mpeg">
                        <source src="audio/voice-beautiful-birds-in-pakistan-8984.mp3" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                
                <!-- Instructions -->
                <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg mb-6">
                    <h3 class="font-medium text-gray-800 dark:text-white mb-2">Meditation Instructions</h3>
                    <ol class="list-decimal pl-5 text-gray-600 dark:text-gray-300 space-y-2">
                        <li>Find a comfortable position, either sitting or lying down.</li>
                        <li>Close your eyes and take a few deep breaths to settle in.</li>
                        <li>Follow the guided audio instructions.</li>
                        <li>If your mind wanders, gently bring your focus back to the meditation.</li>
                        <li>At the end, take a moment to notice how you feel before resuming your day.</li>
                    </ol>
                </div>
                
                <div class="flex flex-col md:flex-row gap-4">
                    <button class="flex-1 py-3 px-6 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg shadow-md hover:shadow-lg transition duration-300 flex justify-center items-center" id="start-meditation">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        Begin Meditation
                    </button>
                    <button class="py-3 px-6 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-800 dark:text-white font-medium rounded-lg transition duration-300 flex justify-center items-center" id="add-to-favorites">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        Save to Favorites
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="js/main.js"></script>
    <script src="js/meditation.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize fade-in elements
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('opacity-100');
                }, 100 * index);
            });
            
            // Duration filter
            const durationFilters = document.querySelectorAll('.duration-filter');
            const categoryFilters = document.querySelectorAll('.category-filter');
            const meditationSessions = document.querySelectorAll('.meditation-session');
            const noResultsMessage = document.getElementById('no-results');
            
            let activeDuration = 'all';
            let activeCategory = 'all';
            
            function updateMeditationDisplay() {
                let visibleCount = 0;
                
                meditationSessions.forEach(session => {
                    const sessionDuration = session.getAttribute('data-duration');
                    const sessionCategory = session.getAttribute('data-category');
                    
                    const durationMatch = activeDuration === 'all' || sessionDuration === activeDuration;
                    const categoryMatch = activeCategory === 'all' || sessionCategory === activeCategory;
                    
                    if (durationMatch && categoryMatch) {
                        session.style.display = 'block';
                        visibleCount++;
                    } else {
                        session.style.display = 'none';
                    }
                });
                
                // Show/hide no results message
                if (noResultsMessage) {
                    if (visibleCount === 0) {
                        noResultsMessage.style.display = 'block';
                    } else {
                        noResultsMessage.style.display = 'none';
                    }
                }
            }
            
            // Set up duration filter buttons
            durationFilters.forEach(button => {
                button.addEventListener('click', function() {
                    // Update active button styling
                    durationFilters.forEach(btn => {
                        btn.classList.remove('bg-primary', 'text-white');
                        btn.classList.add('bg-white', 'dark:bg-gray-800', 'text-gray-800', 'dark:text-white');
                    });
                    
                    this.classList.remove('bg-white', 'dark:bg-gray-800', 'text-gray-800', 'dark:text-white');
                    this.classList.add('bg-primary', 'text-white');
                    
                    // Update active duration filter
                    activeDuration = this.getAttribute('data-duration');
                    updateMeditationDisplay();
                });
            });
            
            // Set up category filter buttons
            categoryFilters.forEach(button => {
                button.addEventListener('click', function() {
                    // Update active button styling
                    categoryFilters.forEach(btn => {
                        btn.classList.remove('bg-primary', 'text-white');
                        btn.classList.add('bg-white', 'dark:bg-gray-800', 'text-gray-800', 'dark:text-white');
                    });
                    
                    this.classList.remove('bg-white', 'dark:bg-gray-800', 'text-gray-800', 'dark:text-white');
                    this.classList.add('bg-primary', 'text-white');
                    
                    // Update active category filter
                    activeCategory = this.getAttribute('data-category');
                    updateMeditationDisplay();
                });
            });
            
            // Meditation Session Modal functionality now handled by meditation.js
            
            // Breathing exercise
            const breathingCircle = document.getElementById('breathing-circle');
            const breathingInstruction = document.getElementById('breathing-instruction');
            
            if (breathingCircle && breathingInstruction) {
                let isBreathing = false;
                let breathingInterval;
                
                breathingCircle.addEventListener('click', function() {
                    if (!isBreathing) {
                        isBreathing = true;
                        
                        // Start breathing animation
                        breathingCircle.classList.add('animate-breathing');
                        
                        // Update instruction
                        updateBreathingInstruction(0);
                        
                        // Set up interval to cycle through instructions
                        let phase = 0;
                        breathingInterval = setInterval(() => {
                            phase = (phase + 1) % 4;
                            updateBreathingInstruction(phase);
                        }, 4000); // 4 seconds per phase
                    } else {
                        // Stop breathing exercise
                        isBreathing = false;
                        clearInterval(breathingInterval);
                        breathingCircle.classList.remove('animate-breathing');
                        breathingInstruction.textContent = 'Click the circle to start breathing exercise';
                    }
                });
                
                function updateBreathingInstruction(phase) {
                    switch(phase) {
                        case 0:
                            breathingInstruction.textContent = 'Breathe in slowly...';
                            break;
                        case 1:
                            breathingInstruction.textContent = 'Hold your breath...';
                            break;
                        case 2:
                            breathingInstruction.textContent = 'Exhale slowly...';
                            break;
                        case 3:
                            breathingInstruction.textContent = 'Hold...';
                            break;
                    }
                }
            }
            
            // Daily quote rotation
            const quotes = [
                "The quieter you become, the more you can hear.",
                "Meditation is not about stopping thoughts, but recognizing that we are more than our thoughts and our feelings.",
                "Meditation is the dissolution of thoughts in eternal awareness or pure consciousness.",
                "The goal of meditation isn't to control your thoughts, it's to stop letting them control you.",
                "Peace comes from within. Do not seek it without.",
                "The thing about meditation is: you become more and more you."
            ];
            
            const dailyQuote = document.getElementById('daily-quote');
            if (dailyQuote) {
                // Set a random quote on page load
                dailyQuote.textContent = '"' + quotes[Math.floor(Math.random() * quotes.length)] + '"';
            }
        });
    </script>
</body>
</html> 