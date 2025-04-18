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
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800 dark:text-white fade-in">Mindfulness Resources</h1>
                    <p class="text-lg mb-8 text-gray-600 dark:text-gray-300 fade-in">
                        Explore our collection of articles, guides, and resources to deepen your meditation practice.
                    </p>
                </div>
            </div>
        </section>
        
        <!-- Blog Articles -->
        <section class="py-16 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="max-w-6xl mx-auto">
                    <!-- Categories -->
                    <div class="flex flex-wrap gap-3 mb-12 justify-center fade-in">
                        <button class="bg-primary text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300">
                            All Articles
                        </button>
                        <!-- <button class="bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300">
                            Beginners
                        </button>
                        <button class="bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300">
                            Techniques
                        </button>
                        <button class="bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300">
                            Science
                        </button>
                        <button class="bg-white dark:bg-gray-700 text-gray-800 dark:text-white px-4 py-2 rounded-full hover:shadow-md transition duration-300">
                            Sleep
                        </button> -->
                    </div>
                    
                    <!-- Featured Article -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-2xl overflow-hidden shadow-lg mb-12 fade-in">
                        <div class="md:flex">
                            <div class="md:w-1/2">
                                <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="The Science of Meditation" class="w-full h-64 md:h-full object-cover">
                            </div>
                            <div class="p-8 md:w-1/2">
                                <div class="flex items-center mb-4">
                                    <span class="bg-primary/10 text-primary dark:text-primary-light px-3 py-1 rounded-full text-sm font-medium">
                                        Featured
                                    </span>
                                    <span class="ml-3 text-gray-500 dark:text-gray-400 text-sm">May 12, 2023</span>
                                </div>
                                <h2 class="text-2xl font-bold mb-4 text-gray-800 dark:text-white">The Science Behind Meditation: How It Changes Your Brain</h2>
                                <p class="text-gray-600 dark:text-gray-300 mb-6">
                                    Recent scientific studies have shown that regular meditation practice can physically change your brain structure in beneficial ways. Discover how meditation affects neuroplasticity and improves focus, empathy, and emotional regulation.
                                </p>
                                <div class="flex items-center space-x-4">
                                    <a href="#" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white font-medium transition duration-300">
                                        <!-- <span>Read More</span> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="https://www.healthline.com/health/breathing-exercise" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-secondary hover:text-secondary-dark dark:text-secondary-light dark:hover:text-white font-medium transition duration-300">
                                        <span>Related Article</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Article Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Article Card 1 -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 fade-in">
                            <img src="https://images.unsplash.com/photo-1545389336-cf090694435e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Breathing Techniques" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-secondary/10 text-secondary dark:text-secondary-light px-3 py-1 rounded-full text-sm font-medium">
                                        Techniques
                                    </span>
                                    <span class="ml-3 text-gray-500 dark:text-gray-400 text-sm">Apr 28, 2023</span>
                                </div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">5 Powerful Breathing Techniques for Meditation</h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    Discover various breathing techniques from different traditions that can enhance your meditation practice and bring about states of deep calm.
                                </p>
                                <div class="flex items-center space-x-4">
                                    <a href="#" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white font-medium transition duration-300">
                                        <!-- <span>Read More</span> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="https://www.healthline.com/health/breathing-exercise" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-secondary hover:text-secondary-dark dark:text-secondary-light dark:hover:text-white font-medium transition duration-300">
                                        <span>Related Article</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Article Card 2 -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 fade-in">
                            <img src="https://images.unsplash.com/photo-1512438248247-f0f2a5a8b7f0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Meditation for Sleep" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-calm/10 text-calm-dark dark:text-calm px-3 py-1 rounded-full text-sm font-medium">
                                        Sleep
                                    </span>
                                    <span class="ml-3 text-gray-500 dark:text-gray-400 text-sm">Apr 15, 2023</span>
                                </div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">How Meditation Can Improve Your Sleep Quality</h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    Learn how regular meditation practice can help alleviate insomnia, reduce sleep disturbances, and promote deeper, more restorative sleep.
                                </p>
                                <div class="flex items-center space-x-4">
                                    <a href="#" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white font-medium transition duration-300">
                                        <!-- <span>Read More</span> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="https://www.sleepfoundation.org/meditation-for-sleep" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-secondary hover:text-secondary-dark dark:text-secondary-light dark:hover:text-white font-medium transition duration-300">
                                        <span>Related Article</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Article Card 3 -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 fade-in">
                            <img src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Beginner's Guide" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-accent/10 text-accent-dark dark:text-accent px-3 py-1 rounded-full text-sm font-medium">
                                        Beginners
                                    </span>
                                    <span class="ml-3 text-gray-500 dark:text-gray-400 text-sm">Mar 30, 2023</span>
                                </div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">A Complete Beginner's Guide to Meditation</h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    New to meditation? This comprehensive guide covers everything you need to know, from basic postures to common challenges and how to overcome them.
                                </p>
                                <div class="flex items-center space-x-4">
                                    <a href="#" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white font-medium transition duration-300">
                                        <!-- <span>Read More</span> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="https://www.mindful.org/meditation-101-techniques-benefits-and-a-beginners-how-to/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-secondary hover:text-secondary-dark dark:text-secondary-light dark:hover:text-white font-medium transition duration-300">
                                        <span>Related Article</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Article Card 4 -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 fade-in">
                            <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Mindfulness at Work" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-primary/10 text-primary dark:text-primary-light px-3 py-1 rounded-full text-sm font-medium">
                                        Productivity
                                    </span>
                                    <span class="ml-3 text-gray-500 dark:text-gray-400 text-sm">Mar 15, 2023</span>
                                </div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Incorporating Mindfulness into Your Workday</h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    Discover practical ways to bring mindfulness into your work routine to reduce stress, increase focus, and improve your overall job satisfaction.
                                </p>
                                <div class="flex items-center space-x-4">
                                    <a href="#" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white font-medium transition duration-300">
                                        <!-- <span>Read More</span> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="https://hbr.org/2017/12/how-mindfulness-can-help-engineers-solve-problems" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-secondary hover:text-secondary-dark dark:text-secondary-light dark:hover:text-white font-medium transition duration-300">
                                        <span>Related Article</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Article Card 5 -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 fade-in">
                            <img src="https://images.unsplash.com/photo-1499209974431-9dddcece7f88?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Meditation Myths" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-secondary/10 text-secondary dark:text-secondary-light px-3 py-1 rounded-full text-sm font-medium">
                                        Myths
                                    </span>
                                    <span class="ml-3 text-gray-500 dark:text-gray-400 text-sm">Feb 28, 2023</span>
                                </div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Common Meditation Myths Debunked</h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    From "clearing your mind" to "sitting in lotus position," we debunk common misconceptions about meditation that might be holding you back.
                                </p>
                                <div class="flex items-center space-x-4">
                                    <a href="#" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white font-medium transition duration-300">
                                        <!-- <span>Read More</span> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="https://www.verywellmind.com/top-meditation-myths-and-misconceptions-2224081" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-secondary hover:text-secondary-dark dark:text-secondary-light dark:hover:text-white font-medium transition duration-300">
                                        <span>Related Article</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Article Card 6 -->
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-xl overflow-hidden shadow-md hover:shadow-lg transition duration-300 fade-in">
                            <img src="https://images.unsplash.com/photo-1507608616759-54f48f0af0ee?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=600&q=80" alt="Travel Meditation" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-calm/10 text-calm-dark dark:text-calm px-3 py-1 rounded-full text-sm font-medium">
                                        Lifestyle
                                    </span>
                                    <span class="ml-3 text-gray-500 dark:text-gray-400 text-sm">Feb 15, 2023</span>
                                </div>
                                <h3 class="text-xl font-semibold mb-2 text-gray-800 dark:text-white">Meditation on the Go: Practices for Travelers</h3>
                                <p class="text-gray-600 dark:text-gray-300 mb-4">
                                    Don't let travel disrupt your practice. Learn how to maintain mindfulness and meditation routines while on the road, in the air, or abroad.
                                </p>
                                <div class="flex items-center space-x-4">
                                    <a href="#" class="inline-flex items-center text-primary hover:text-primary-dark dark:text-primary-light dark:hover:text-white font-medium transition duration-300">
                                        <!-- <span>Read More</span> -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a href="https://www.headspace.com/articles/how-to-meditate-while-traveling" target="_blank" rel="noopener noreferrer" class="inline-flex items-center text-secondary hover:text-secondary-dark dark:text-secondary-light dark:hover:text-white font-medium transition duration-300">
                                        <span>Related Article</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z" />
                                            <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <!-- <div class="mt-12 flex justify-center fade-in">
                        <nav class="flex items-center space-x-2">
                            <a href="#" class="px-3 py-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="px-4 py-2 rounded-md bg-primary text-white font-medium hover:bg-primary-dark transition duration-300">1</a>
                            <a href="#" class="px-4 py-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300">2</a>
                            <a href="#" class="px-4 py-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300">3</a>
                            <span class="px-4 py-2 text-gray-600 dark:text-gray-400">...</span>
                            <a href="#" class="px-4 py-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300">8</a>
                            <a href="#" class="px-3 py-2 rounded-md bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </nav>
                    </div> -->
                </div>
            </div>
        </section>
        
        <!-- Newsletter -->
        <section class="py-16 bg-gradient-to-r from-primary/10 to-secondary/10 dark:from-primary/20 dark:to-secondary/20">
            <div class="container mx-auto px-4">
                <div class="max-w-xl mx-auto text-center">
                    <h2 class="text-3xl font-bold mb-4 text-gray-800 dark:text-white fade-in">Subscribe to Our Newsletter</h2>
                    <p class="text-lg mb-8 text-gray-600 dark:text-gray-300 fade-in">
                        Get the latest articles, meditation tips, and exclusive offers delivered to your inbox.
                    </p>
                    <form class="fade-in">
                        <div class="flex flex-col sm:flex-row gap-4">
                            <input type="email" placeholder="Your email address" class="flex-grow px-5 py-3 rounded-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 focus:outline-none focus:ring-2 focus:ring-primary dark:focus:ring-primary-light focus:border-transparent shadow-sm">
                            <button type="submit" class="bg-primary hover:bg-primary-dark text-white font-medium py-3 px-6 rounded-full shadow-md hover:shadow-lg transition duration-300">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="js/main.js"></script>
</body>
</html> 