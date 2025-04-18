<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "meditation1";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process contact form submission
$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    // Basic validation
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } else {
        // Store data in database
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        
        if ($stmt->execute()) {
            $success_message = "Thank you for your message! We will get back to you soon.";
            
            // Reset form fields after successful submission
            $name = $email = $subject = $message = '';
        } else {
            $error_message = "Error: " . $stmt->error;
        }
        
        $stmt->close();
    }
}

// Close database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - ZenSpace</title>
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
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <?php include 'includes/header.php'; ?>
    
    <main>
        <!-- Header Section -->
        <section class="relative py-20 gradient-bg">
            <div class="container mx-auto px-4">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 text-gray-800 dark:text-white fade-in">Get in Touch</h1>
                    <p class="text-lg mb-8 text-gray-600 dark:text-gray-300 fade-in">
                        Have questions or feedback? We'd love to hear from you.
                    </p>
                </div>
            </div>
        </section>
        
        <!-- Contact Form & Info -->
        <section class="py-16 bg-white dark:bg-gray-800">
            <div class="container mx-auto px-4">
                <div class="max-w-5xl mx-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Contact Form -->
                        <div class="fade-in">
                            <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">Send Us a Message</h2>
                            
                            <?php if (!empty($success_message)): ?>
                                <div class="bg-green-100 dark:bg-green-800/30 text-green-700 dark:text-green-300 p-4 rounded-lg mb-6">
                                    <?php echo $success_message; ?>
                                </div>
                            <?php endif; ?>
                            
                            <?php if (!empty($error_message)): ?>
                                <div class="bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300 p-4 rounded-lg mb-6">
                                    <?php echo $error_message; ?>
                                </div>
                            <?php endif; ?>
                            
                            <form method="POST" action="" class="space-y-6">
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Name*</label>
                                    <input type="text" id="name" name="name" value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>" class="w-full px-4 py-2 rounded-lg bg-white dark:bg-white border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-800" required>
                                </div>
                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email Address*</label>
                                    <input type="email" id="email" name="email" value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>" class="w-full px-4 py-2 rounded-lg bg-white dark:bg-white border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-800" required>
                                </div>
                                
                                <div>
                                    <label for="subject" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subject</label>
                                    <input type="text" id="subject" name="subject" value="<?php echo isset($subject) ? htmlspecialchars($subject) : ''; ?>" class="w-full px-4 py-2 rounded-lg bg-white dark:bg-white border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-800">
                                </div>
                                
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Your Message*</label>
                                    <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 rounded-lg bg-white dark:bg-white border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent text-gray-800" required><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
                                </div>
                                
                                <div class="pt-2">
                                    <button type="submit" name="contact_submit" class="w-full py-3 px-6 bg-primary hover:bg-primary-dark text-white font-medium rounded-lg shadow-md hover:shadow-lg transition duration-300">
                                        Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Contact Information -->
                        <div class="fade-in">
                            <h2 class="text-2xl font-semibold mb-6 text-gray-800 dark:text-white">Contact Information</h2>
                            
                            <div class="space-y-8">
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-primary/10 p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-800 dark:text-white">Email Us</h3>
                                        <p class="mt-1 text-gray-600 dark:text-gray-300">support@zenspace.com</p>
                                        <p class="mt-1 text-gray-600 dark:text-gray-300">info@zenspace.com</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-secondary/10 p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-800 dark:text-white">Call Us</h3>
                                        <p class="mt-1 text-gray-600 dark:text-gray-300">+1 (555) 123-4567</p>
                                        <p class="mt-1 text-gray-600 dark:text-gray-300">Mon-Fri: 9am - 5pm</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-primary/10 p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-800 dark:text-white">Location</h3>
                                        <p class="mt-1 text-gray-600 dark:text-gray-300">123 Mindful Street</p>
                                        <p class="mt-1 text-gray-600 dark:text-gray-300">Serenity City, SC 12345</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <div class="flex-shrink-0 bg-secondary/10 p-3 rounded-full">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-secondary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div class="ml-4">
                                        <h3 class="text-lg font-medium text-gray-800 dark:text-white">Hours</h3>
                                        <p class="mt-1 text-gray-600 dark:text-gray-300">Monday - Friday: 9am - 5pm</p>
                                        <p class="mt-1 text-gray-600 dark:text-gray-300">Saturday: 10am - 2pm</p>
                                        <p class="mt-1 text-gray-600 dark:text-gray-300">Sunday: Closed</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Social Media -->
                            <div class="mt-8">
                                <h3 class="text-lg font-medium text-gray-800 dark:text-white mb-4">Connect With Us</h3>
                                <div class="flex space-x-4">
                                    <a href="#" class="bg-gray-100 dark:bg-gray-700 hover:bg-primary/10 dark:hover:bg-primary/20 p-3 rounded-full transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M22.675 0h-21.35c-.732 0-1.325.593-1.325 1.325v21.351c0 .731.593 1.324 1.325 1.324h11.495v-9.294h-3.128v-3.622h3.128v-2.671c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12v9.293h6.116c.73 0 1.323-.593 1.323-1.325v-21.35c0-.732-.593-1.325-1.325-1.325z"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="bg-gray-100 dark:bg-gray-700 hover:bg-primary/10 dark:hover:bg-primary/20 p-3 rounded-full transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 0c-6.628 0-12 5.373-12 12s5.372 12 12 12 12-5.373 12-12-5.372-12-12-12zm6.207 8.756c.009.125.009.25.009.375 0 3.852-2.932 8.292-8.292 8.292-1.646 0-3.176-.483-4.468-1.308.232.028.455.037.696.037 1.36 0 2.609-.456 3.605-1.24-1.276-.027-2.349-.86-2.717-2.003.179.026.357.044.545.044.259 0 .517-.035.758-.107-1.331-.268-2.33-1.442-2.33-2.856v-.036c.39.214.838.349 1.313.366-.78-.525-1.295-1.415-1.295-2.426 0-.534.143-1.031.393-1.464 1.424 1.75 3.562 2.896 5.966 3.02-.045-.214-.08-.428-.08-.643 0-1.547 1.25-2.807 2.808-2.807.813 0 1.545.339 2.062.883.644-.125 1.249-.366 1.795-.688-.214.652-.66 1.196-1.24 1.54.566-.063 1.115-.223 1.615-.447-.376.563-.857 1.061-1.403 1.458z"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="bg-gray-100 dark:bg-gray-700 hover:bg-primary/10 dark:hover:bg-primary/20 p-3 rounded-full transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                        </svg>
                                    </a>
                                    <a href="#" class="bg-gray-100 dark:bg-gray-700 hover:bg-primary/10 dark:hover:bg-primary/20 p-3 rounded-full transition duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    
    <?php include 'includes/footer.php'; ?>
    
    <script src="js/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize fade-in elements
            const fadeElements = document.querySelectorAll('.fade-in');
            fadeElements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('opacity-100');
                }, 100 * index);
            });
        });
    </script>
</body>
</html> 