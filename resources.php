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
    <title>Meditation Resources - ZenSpace</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            light: '#8B5CF6',
                            DEFAULT: '#7C3AED',
                            dark: '#6D28D9',
                        },
                        secondary: {
                            light: '#5EEAD4',
                            DEFAULT: '#14B8A6',
                            dark: '#0D9488',
                        },
                        accent: {
                            light: '#BFDBFE',
                            DEFAULT: '#93C5FD',
                            dark: '#60A5FA',
                        },
                        calm: {
                            light: '#FED7AA',
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
            background: linear-gradient(120deg, rgba(139, 92, 246, 0.1), rgba(94, 234, 212, 0.1), rgba(191, 219, 254, 0.1));
            background-size: 300% 300%;
            animation: gradient 15s ease infinite;
        }
        
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .resource-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
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
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800 dark:text-white">Meditation Resources</h1>
                    <p class="text-lg mb-8 text-gray-600 dark:text-gray-300">
                        Explore our collection of meditation guides, articles, and tools to deepen your practice.
                    </p>
                </div>
            </div>
        </section>
        
        <!-- Resources Grid -->
        <section class="py-16 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <!-- Resource Categories -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Beginner's Guide -->
                    <div class="resource-card bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Beginner's Guide</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Learn the basics of meditation, including proper posture, breathing techniques, and how to start your practice.
                            </p>
                            <a href="#" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                <span>Read More</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Breathing Techniques -->
                    <div class="resource-card bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Breathing Techniques</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Master different breathing exercises to enhance your meditation practice and reduce stress.
                            </p>
                            <a href="#" class="inline-flex items-center text-secondary hover:text-secondary-dark dark:text-secondary-light dark:hover:text-white transition duration-300">
                                <span>Read More</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Meditation Types -->
                    <div class="resource-card bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Meditation Types</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Explore different meditation styles and find the one that resonates with you.
                            </p>
                            <a href="#" class="inline-flex items-center text-accent hover:text-accent-dark dark:text-accent-light dark:hover:text-white transition duration-300">
                                <span>Read More</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Scientific Research -->
                    <div class="resource-card bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Scientific Research</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Discover the science behind meditation and its proven benefits for mental and physical health.
                            </p>
                            <a href="#" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">
                                <span>Read More</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Daily Practice -->
                    <div class="resource-card bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Daily Practice</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Tips and strategies for establishing and maintaining a consistent meditation routine.
                            </p>
                            <a href="#" class="inline-flex items-center text-secondary hover:text-secondary-dark dark:text-secondary-light dark:hover:text-white transition duration-300">
                                <span>Read More</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    
                    <!-- Community Stories -->
                    <div class="resource-card bg-white dark:bg-gray-700 rounded-xl overflow-hidden shadow-md">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mr-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white">Community Stories</h3>
                            </div>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Read inspiring stories from our meditation community and share your own journey.
                            </p>
                            <a href="#" class="inline-flex items-center text-accent hover:text-accent-dark dark:text-accent-light dark:hover:text-white transition duration-300">
                                <span>Read More</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Featured Articles -->
        <section class="py-16 bg-gray-50 dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold mb-8 text-center text-gray-800 dark:text-white">Featured Articles</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Article 1 -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md">
                        <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Meditation Benefits" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <span class="bg-primary/10 text-primary text-sm px-3 py-1 rounded-full">Science</span>
                                <span class="text-gray-500 dark:text-gray-400 text-sm ml-4">5 min read</span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">The Science of Meditation</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Explore the latest research on how meditation affects the brain and body.
                            </p>
                            <a href="#" class="text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white transition duration-300">Read Article</a>
                        </div>
                    </div>
                    
                    <!-- Article 2 -->
                    <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md">
                        <img src="https://images.unsplash.com/photo-1518241353330-0f7941c2d9b5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Meditation Tips" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <div class="flex items-center mb-4">
                                <span class="bg-secondary/10 text-secondary text-sm px-3 py-1 rounded-full">Tips</span>
                                <span class="text-gray-500 dark:text-gray-400 text-sm ml-4">3 min read</span>
                            </div>
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">10 Tips for Better Meditation</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">
                                Practical advice to enhance your meditation practice and overcome common challenges.
                            </p>
                            <a href="#" class="text-secondary hover:text-secondary-dark dark:text-secondary-light dark:hover:text-white transition duration-300">Read Article</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Newsletter Section -->
        <section class="py-16 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="max-w-2xl mx-auto text-center">
                    <h2 class="text-3xl font-bold mb-4 text-gray-800 dark:text-white">Stay Updated</h2>
                    <p class="text-gray-600 dark:text-gray-300 mb-8">
                        Subscribe to our newsletter for the latest meditation resources, tips, and community updates.
                    </p>
                    <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                        <input type="email" placeholder="Enter your email" class="flex-1 px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary dark:bg-gray-700 dark:text-white">
                        <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-medium py-3 px-6 rounded-lg transition duration-300">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="js/main.js"></script>
</body>
</html> 