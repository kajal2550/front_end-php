document.addEventListener('DOMContentLoaded', function() {
    // Dark mode toggle
    const themeToggleBtn = document.getElementById('theme-toggle');
    
    // Check if user has a preferred theme already set
    if (localStorage.getItem('color-theme') === 'dark' || 
        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    
    // Toggle dark mode on button click
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function() {
            // Toggle dark class on html element
            document.documentElement.classList.toggle('dark');
            
            // Update localStorage value
            if (document.documentElement.classList.contains('dark')) {
                localStorage.setItem('color-theme', 'dark');
            } else {
                localStorage.setItem('color-theme', 'light');
            }
        });
    }
    
    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });
    }
    
    // Breathing animation (on meditation page)
    const breathingCircle = document.getElementById('breathing-circle');
    if (breathingCircle) {
        const instructionText = document.getElementById('breathing-instruction');
        let isBreathing = false;
        
        breathingCircle.addEventListener('click', function() {
            if (!isBreathing) {
                isBreathing = true;
                breathingCircle.classList.add('animate-breathing');
                
                // Change instruction text with animations
                let count = 1;
                instructionText.textContent = 'Breathe in...';
                
                const breathingInterval = setInterval(function() {
                    if (count % 2 === 0) {
                        instructionText.textContent = 'Breathe in...';
                    } else {
                        instructionText.textContent = 'Breathe out...';
                    }
                    count++;
                }, 4000); // 4 seconds per breath phase
                
                // Add stop button
                const stopBtn = document.createElement('button');
                stopBtn.textContent = 'Stop';
                stopBtn.className = 'mt-4 bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-full transition duration-300';
                stopBtn.addEventListener('click', function(e) {
                    e.stopPropagation(); // Prevent triggering the circle's click event
                    clearInterval(breathingInterval);
                    breathingCircle.classList.remove('animate-breathing');
                    instructionText.textContent = 'Click the circle to start breathing exercise';
                    isBreathing = false;
                    this.remove();
                });
                
                breathingCircle.parentNode.appendChild(stopBtn);
            }
        });
    }
    
    // Audio ambient toggle
    const ambientToggle = document.getElementById('ambient-toggle');
    const ambientAudio = document.getElementById('ambient-audio');
    
    if (ambientToggle && ambientAudio) {
        ambientToggle.addEventListener('click', function() {
            if (ambientAudio.paused) {
                ambientAudio.play();
                ambientToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" clip-rule="evenodd" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2" /></svg>';
                ambientToggle.setAttribute('title', 'Mute Ambient Sound');
            } else {
                ambientAudio.pause();
                ambientToggle.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg>';
                ambientToggle.setAttribute('title', 'Play Ambient Sound');
            }
        });
    }
    
    // Filter meditation sessions
    const durationFilters = document.querySelectorAll('.duration-filter');
    if (durationFilters.length > 0) {
        durationFilters.forEach(filter => {
            filter.addEventListener('click', function() {
                // Remove active class from all filters
                durationFilters.forEach(f => f.classList.remove('bg-primary', 'text-white'));
                
                // Add active class to clicked filter
                this.classList.add('bg-primary', 'text-white');
                
                const duration = this.dataset.duration;
                const sessions = document.querySelectorAll('.meditation-session');
                
                sessions.forEach(session => {
                    if (duration === 'all') {
                        session.classList.remove('hidden');
                    } else {
                        if (session.dataset.duration === duration) {
                            session.classList.remove('hidden');
                        } else {
                            session.classList.add('hidden');
                        }
                    }
                });
            });
        });
    }
    
    // Daily motivational quote
    const quoteElement = document.getElementById('daily-quote');
    if (quoteElement) {
        const quotes = [
            "The quieter you become, the more you can hear.",
            "Peace comes from within. Do not seek it without.",
            "Meditation is the dissolution of thoughts in Eternal awareness.",
            "Your goal is not to battle with the mind, but to witness the mind.",
            "When you own your breath, nobody can steal your peace.",
            "The best way to capture moments is to pay attention.",
            "Quiet the mind, and the soul will speak.",
            "Meditation is not about stopping thoughts, but recognizing that we are more than our thoughts and our feelings.",
            "Mindfulness isn't difficult, we just need to remember to do it.",
            "Be where you are, not where you think you should be."
        ];
        
        // Get random quote
        const randomQuote = quotes[Math.floor(Math.random() * quotes.length)];
        quoteElement.textContent = randomQuote;
    }
});

// Add floating animation to elements with the 'floating' class
function initFloatingElements() {
    const floatingElements = document.querySelectorAll('.floating');
    
    floatingElements.forEach(el => {
        // Add random delay to create a more natural effect
        const delay = Math.random() * 2;
        el.style.animationDelay = `${delay}s`;
    });
}

// Initialize floating elements
initFloatingElements();

// Add a fade-in effect for page elements
document.addEventListener('DOMContentLoaded', function() {
    const fadeElements = document.querySelectorAll('.fade-in');
    
    fadeElements.forEach((el, index) => {
        setTimeout(() => {
            el.classList.add('opacity-100');
        }, 100 * index);
    });
}); 