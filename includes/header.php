<?php
// Only start a session if one hasn't been started already
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']);
?>
<header class="bg-white dark:bg-gray-800 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <a href="index.php" class="flex items-center">
                <span class="text-2xl font-bold text-primary dark:text-primary-light">Zen<span class="text-secondary">Space</span></span>
            </a>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?> transition duration-200">Home</a>
                <a href="meditation.php" class="<?php echo ($current_page == 'meditation.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?> transition duration-200">Meditate</a>
                <a href="exercise.php" class="<?php echo ($current_page == 'exercise.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?> transition duration-200">Exercise</a>
                <a href="tracker.php" class="<?php echo ($current_page == 'tracker.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?> transition duration-200">Track</a>
                <a href="blog.php" class="<?php echo ($current_page == 'blog.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?> transition duration-200">Resources</a>
                <a href="contact.php" class="<?php echo ($current_page == 'contact.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?> transition duration-200">Contact</a>
            </div>
            
            <div class="flex items-center">
                <button id="theme-toggle" class="p-2 mr-4 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-yellow-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden dark:block" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" clip-rule="evenodd" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 dark:hidden" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                    </svg>
                </button>

                <!-- Profile Button -->
                <button id="profile-button" class="p-2 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-600 transition duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <button id="mobile-menu-button" class="md:hidden ml-4 text-gray-700 dark:text-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white dark:bg-gray-800 shadow-lg">
        <div class="px-4 py-4 space-y-4">
            <a href="index.php" class="block <?php echo ($current_page == 'index.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?>">Home</a>
            <a href="meditation.php" class="block <?php echo ($current_page == 'meditation.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?>">Meditate</a>
            <a href="exercise.php" class="block <?php echo ($current_page == 'exercise.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?>">Exercise</a>
            <a href="tracker.php" class="block <?php echo ($current_page == 'tracker.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?>">Track</a>
            <a href="blog.php" class="block <?php echo ($current_page == 'blog.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?>">Resources</a>
            <a href="contact.php" class="block <?php echo ($current_page == 'contact.php') ? 'text-primary dark:text-primary-light font-semibold' : 'text-gray-700 dark:text-gray-300 hover:text-primary dark:hover:text-primary-light font-medium'; ?>">Contact</a>
        </div>
    </div>
</header>

<!-- Profile Modal -->
<div id="profile-modal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="fixed top-24 right-4 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-lg transform transition-all">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Profile</h3>
                <button id="close-profile-modal" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
            
            <div class="space-y-4">
                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Email</p>
                    <p class="text-gray-800 dark:text-white font-medium"><?php echo isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : 'Not logged in'; ?></p>
                </div>
                
                <a href="/meditation/logout.php" class="block w-full bg-red-500 hover:bg-red-600 text-white text-center py-2 px-4 rounded-lg transition duration-300">
                    Log Out
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    // Profile Modal Functionality
    const profileButton = document.getElementById('profile-button');
    const profileModal = document.getElementById('profile-modal');
    const closeProfileModal = document.getElementById('close-profile-modal');

    profileButton.addEventListener('click', () => {
        profileModal.classList.remove('hidden');
    });

    closeProfileModal.addEventListener('click', () => {
        profileModal.classList.add('hidden');
    });

    // Close modal when clicking outside
    profileModal.addEventListener('click', (e) => {
        if (e.target === profileModal) {
            profileModal.classList.add('hidden');
        }
    });

    // Close modal on escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !profileModal.classList.contains('hidden')) {
            profileModal.classList.add('hidden');
        }
    });
</script> 