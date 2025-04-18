<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZenSpace - Your Personal Meditation Sanctuary</title>
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
                }
            }
        }
    </script>
    <style type="text/css">
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .breathing-circle {
            animation: breathe 8s infinite ease-in-out;
        }
        
        @keyframes breathe {
            0%, 100% {
                transform: scale(1);
                opacity: 0.9;
            }
            50% {
                transform: scale(1.2);
                opacity: 0.7;
            }
        }
        
        .floating {
            animation: float 6s infinite ease-in-out;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        .gradient-bg {
            background: linear-gradient(120deg, rgba(139, 92, 246, 0.2), rgba(94, 234, 212, 0.2), rgba(191, 219, 254, 0.2), rgba(254, 215, 170, 0.2));
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
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <?php include 'includes/header.php'; ?>
    
    <main>
        <!-- Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden gradient-bg">
            <div class="absolute w-96 h-96 rounded-full bg-primary-light/20 breathing-circle"></div>
            <div class="container mx-auto px-4 py-16 relative z-10">
                <div class="text-center max-w-3xl mx-auto">
                    <h1 class="text-5xl md:text-6xl font-bold mb-6 text-gray-800 dark:text-white">
                        Your Journey to Inner Peace
                    </h1>
                    <p class="text-xl md:text-2xl mb-10 text-gray-600 dark:text-gray-300">
                        "The quieter you become, the more you can hear."
                    </p>
                    <a href="meditation.php" class="bg-primary hover:bg-primary-dark text-white font-medium py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition duration-300 inline-flex items-center">
                        <span>Start Meditation</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
            
            <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-gray-50 dark:from-gray-900 to-transparent"></div>
        </section>
        
        <!-- Features Section -->
        <section class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-16 text-gray-800 dark:text-white">Discover Inner Harmony</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-8 shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="w-16 h-16 bg-primary-light/20 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15.536a5 5 0 001.414 1.414m0 0l-2.828 2.828m0 0a9 9 0 010-12.728m0 0l2.828 2.828" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4 text-center text-gray-800 dark:text-white">Guided Meditation</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-center">
                            Follow expert-led sessions tailored to focus, sleep, anxiety, and more.
                        </p>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-8 shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="w-16 h-16 bg-secondary-light/20 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4 text-center text-gray-800 dark:text-white">Track Progress</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-center">
                            Monitor your meditation journey with insightful statistics and streaks.
                        </p>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-8 shadow-md hover:shadow-lg transition duration-300 transform hover:-translate-y-1">
                        <div class="w-16 h-16 bg-accent-light/20 rounded-full flex items-center justify-center mb-6 mx-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-accent-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold mb-4 text-center text-gray-800 dark:text-white">Mindful Resources</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-center">
                            Access a library of articles, techniques, and practices for mindful living.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Why Choose Us Section -->
        <section class="py-20 bg-gray-50 dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-16 text-gray-800 dark:text-white">Why Choose ZenSpace</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md hover:shadow-lg transition duration-300">
                        <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">Flexible Timing</h3>
                        <p class="text-gray-600 dark:text-gray-300">Meditate anytime, anywhere with sessions ranging from 5 to 60 minutes.</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md hover:shadow-lg transition duration-300">
                        <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">Expert Guidance</h3>
                        <p class="text-gray-600 dark:text-gray-300">Learn from certified meditation teachers and mindfulness experts.</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md hover:shadow-lg transition duration-300">
                        <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-accent-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">Community Support</h3>
                        <p class="text-gray-600 dark:text-gray-300">Join a supportive community of like-minded individuals on their meditation journey.</p>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-md hover:shadow-lg transition duration-300">
                        <div class="w-12 h-12 bg-calm/10 rounded-full flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-calm-dark" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-white">Regular Updates</h3>
                        <p class="text-gray-600 dark:text-gray-300">Access new meditation content and features regularly to keep your practice fresh.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Testimonials Section -->
        <section class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl font-bold text-center mb-16 text-gray-800 dark:text-white">What Our Users Say</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-8 shadow-md">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                                <span class="text-xl font-semibold text-primary">S</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Sarah Johnson</h3>
                                <p class="text-gray-600 dark:text-gray-300">Yoga Teacher</p>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300">"ZenSpace has transformed my daily routine. The guided meditations are perfect for both beginners and experienced practitioners."</p>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-8 shadow-md">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-secondary/10 rounded-full flex items-center justify-center">
                                <span class="text-xl font-semibold text-secondary">M</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Michael Chen</h3>
                                <p class="text-gray-600 dark:text-gray-300">Software Engineer</p>
                            </div>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300">"As a busy professional, I appreciate how easy it is to fit meditation into my schedule with ZenSpace. The progress tracking keeps me motivated."</p>
                    </div>
                    
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-xl p-8 shadow-md">
                        <div class="flex items-center mb-6">
                            <div class="w-12 h-12 bg-accent/10 rounded-full flex items-center justify-center">
                                <span class="text-xl font-semibold text-accent-dark">A</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Amanda Torres</h3>
                                <p class="text-gray-600 dark:text-gray-300">"The variety of meditation styles and the calming atmosphere of ZenSpace have helped me manage stress and improve my sleep quality."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Latest Blog Posts -->
        <section class="py-20 bg-gray-50 dark:bg-gray-900">
            <div class="container mx-auto px-4">
                <div class="flex justify-between items-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Latest from Our Blog</h2>
                    <a href="blog.php" class="text-primary hover:text-primary-dark dark:text-primary-light font-medium transition duration-300">View All Posts →</a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                        <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Meditation Science" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">The Science of Meditation</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">Discover the latest research on how meditation affects your brain and overall well-being.</p>
                            <a href="blog.php" class="text-primary hover:text-primary-dark dark:text-primary-light font-medium">Read More →</a>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                        <img src="https://images.unsplash.com/photo-1545389336-cf090694435e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Breathing Techniques" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Essential Breathing Techniques</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">Learn powerful breathing exercises to enhance your meditation practice.</p>
                            <a href="blog.php" class="text-primary hover:text-primary-dark dark:text-primary-light font-medium">Read More →</a>
                        </div>
                    </div>
                    
                    <div class="bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300">
                        <img src="https://images.unsplash.com/photo-1512438248247-f0f2a5a8b7f0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Meditation for Sleep" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Meditation for Better Sleep</h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">Tips and techniques for using meditation to improve your sleep quality.</p>
                            <a href="blog.php" class="text-primary hover:text-primary-dark dark:text-primary-light font-medium">Read More →</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Download App Section -->
        <section class="py-20 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">Take Your Practice Anywhere</h2>
                            <p class="text-lg text-gray-600 dark:text-gray-300 mb-8">
                                Download our mobile app to access guided meditations, track your progress, and maintain your practice wherever you go.
                            </p>
                            <div class="flex flex-col sm:flex-row gap-4">
                                <a href="#" class="inline-flex items-center bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition duration-300">
                                    <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.08-.46-2.07-.48-3.2 0-1.42.61-2.16.44-3.04-.35C4.43 17.01 3.47 12.21 4.85 9.37c.93-1.89 2.56-2.98 4.34-3.02 1.36.02 2.27.74 3.08.74.83 0 2.37-.91 4.01-.78 1.89.16 3.3 1.13 4.14 2.86-3.82 2.42-3.2 7.15.55 8.81-.62 1.36-1.44 2.7-2.92 4.3zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.27 2.33-1.83 4.11-3.74 4.25z"/>
                                    </svg>
                                    <div>
                                        <div class="text-xs">Download on the</div>
                                        <div class="text-lg font-semibold font-sans -mt-1">App Store</div>
                                    </div>
                                </a>
                                
                                <a href="#" class="inline-flex items-center bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition duration-300">
                                    <svg class="w-8 h-8 mr-3" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3.609 1.814L13.792 12 3.61 22.186a.996.996 0 01-.61-.92V2.734a1 1 0 01.609-.92zm10.89 10.893l2.302 2.302-10.937 6.333 8.635-8.635zm3.394-3.394l2.807 1.627a1 1 0 010 1.72l-2.807 1.627-2.472-2.472 2.472-2.472zM5.864 2.658L16.802 8.99l-2.302 2.302-8.636-8.635z"/>
                                    </svg>
                                    <div>
                                        <div class="text-xs">GET IT ON</div>
                                        <div class="text-lg font-semibold font-sans -mt-1">Google Play</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-primary/20 to-secondary/20 rounded-3xl transform rotate-6"></div>
                            <img src="https://images.unsplash.com/photo-1611162618071-b39a2ec055fb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80" alt="Mobile App" class="relative rounded-3xl shadow-2xl">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Call to Action -->
        <section class="py-20 bg-gray-50 dark:bg-gray-900">
            <div class="container mx-auto px-4 text-center">
                <div class="max-w-xl mx-auto">
                    <h2 class="text-3xl font-bold mb-6 text-gray-800 dark:text-white">Begin Your Meditation Journey Today</h2>
                    <p class="text-lg mb-8 text-gray-600 dark:text-gray-300">
                        Join thousands of practitioners finding peace in just a few minutes a day.
                    </p>
                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        <a href="meditation.php" class="bg-primary hover:bg-primary-dark text-white font-medium py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition duration-300">
                            Try Now
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="js/main.js"></script>
</body>
</html> 