// Meditation-specific JavaScript

document.addEventListener('DOMContentLoaded', function() {
    // Audio player elements
    const meditationAudio = document.getElementById('meditation-audio');
    const playPauseBtn = document.getElementById('play-pause-btn');
    const startMeditationBtn = document.getElementById('start-meditation');
    const progressBar = document.getElementById('progress-bar');
    const currentTime = document.getElementById('current-time');
    const durationTime = document.getElementById('duration-time');
    
    // Session Modal elements
    const modal = document.getElementById('meditation-modal');
    const closeModalBtn = document.getElementById('close-modal');
    const modalImage = document.getElementById('modal-image');
    const modalTitle = document.getElementById('modal-title');
    const modalDescription = document.getElementById('modal-description');
    const modalDuration = document.getElementById('modal-duration');
    const modalCategory = document.getElementById('modal-category');
    const modalTags = document.getElementById('modal-tags');
    const trackName = document.getElementById('track-name');
    
    // Audio sources for different meditation types - External URLs
    const audioSources = {
        'beginner': 'https://assets.mixkit.co/active_storage/sfx/2533/2533-preview.mp3',
        'stress': 'https://assets.mixkit.co/active_storage/sfx/2532/2532-preview.mp3',
        'sleep': 'https://assets.mixkit.co/active_storage/sfx/2524/2524-preview.mp3',
        'focus': 'https://assets.mixkit.co/active_storage/sfx/213/213-preview.mp3'
    };
    
    // Local fallback audio for reliability
    const localAudioSources = {
        'beginner': 'audio/meditation/beginner-meditation.mp3',
        'stress': 'audio/meditation/stress-meditation.mp3',
        'sleep': 'audio/meditation/sleep-meditation.mp3',
        'focus': 'audio/meditation/focus-meditation.mp3',
        'default': 'audio/meditation/default-meditation.mp3'
    };
    
    // Set up session links
    const sessionLinks = document.querySelectorAll('.meditation-session a');
    
    sessionLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Get session data from parent elements
            const session = this.closest('.meditation-session');
            const img = session.querySelector('img');
            const title = session.querySelector('h3').textContent;
            const description = session.querySelector('p').textContent;
            const duration = session.getAttribute('data-duration');
            const category = session.getAttribute('data-category');
            const tags = session.querySelectorAll('.mb-4.flex.flex-wrap.gap-2 span');
            
            // Set modal content
            modalImage.src = img.src;
            modalImage.alt = img.alt;
            modalTitle.textContent = title;
            modalDescription.textContent = description;
            modalDuration.textContent = duration + ' min';
            
            // Set category text with first letter capitalized
            modalCategory.textContent = category.charAt(0).toUpperCase() + category.slice(1);
            
            // Clear and add tags
            modalTags.innerHTML = '';
            tags.forEach(tag => {
                const clone = tag.cloneNode(true);
                modalTags.appendChild(clone);
            });
            
            // Set track name
            trackName.textContent = title;
            
            // Add audio file description based on category
            const audioDescriptions = {
                'beginner': 'Gentle nature sounds for beginners',
                'stress': 'Relaxing ambient sounds for stress relief',
                'sleep': 'Soothing night sounds for better sleep',
                'focus': 'Rhythmic tones to enhance focus'
            };
            
            // Set the track name with description
            const audioTypeDescription = audioDescriptions[category] || 'Meditation sounds';
            trackName.textContent = `${title} (${audioTypeDescription})`;
            
            // Set appropriate audio file based on meditation type
            if (meditationAudio) {
                // Stop any playing audio
                meditationAudio.pause();
                meditationAudio.currentTime = 0;
                
                // Use a simple approach to fix CORS and mixed content issues
                // First, try using our reliable local fallback
                let sourceUrl = localAudioSources[category] || localAudioSources['default'];
                
                try {
                    // First try to use the external source based on category
                    if (navigator.onLine && audioSources[category]) {
                        sourceUrl = audioSources[category];
                        console.log("Using external audio source:", sourceUrl);
                    } else {
                        console.log("Using local audio source:", sourceUrl);
                    }
                    
                    // Remove any previous error listeners
                    const oldErrorListener = meditationAudio.onerror;
                    meditationAudio.onerror = null;
                    
                    // Add a specific error handler for this load attempt
                    meditationAudio.onerror = function(e) {
                        console.error("Error loading audio source:", sourceUrl, e);
                        
                        // If external file failed, try local file
                        if (sourceUrl !== localAudioSources[category] && sourceUrl !== localAudioSources['default']) {
                            console.log("External audio failed, trying local fallback");
                            meditationAudio.src = localAudioSources[category] || localAudioSources['default'];
                            meditationAudio.load();
                        } else {
                            // If local file also failed, create synthetic audio
                            console.log("Local audio failed too, creating fallback audio");
                            createFallbackAudio();
                        }
                        
                        // Restore original error handler
                        if (oldErrorListener) {
                            meditationAudio.onerror = oldErrorListener;
                        }
                    };
                    
                    // Set the audio src directly - simpler and more reliable
                    meditationAudio.src = sourceUrl;
                    
                    // Load the new audio
                    meditationAudio.load();
                    console.log("Setting audio source to", sourceUrl);
                    
                    // Do NOT try to pre-buffer as it causes issues on many browsers
                    
                    // Make sure duration updates properly
                    meditationAudio.addEventListener('loadedmetadata', function onceLoaded() {
                        // Set duration display when metadata is loaded
                        if (durationTime) {
                            const totalMinutes = Math.floor(meditationAudio.duration / 60);
                            const totalSeconds = Math.floor(meditationAudio.duration % 60).toString().padStart(2, '0');
                            durationTime.textContent = totalMinutes + ':' + totalSeconds;
                        }
                        updateProgressBar();
                        
                        // Remove the one-time listener
                        meditationAudio.removeEventListener('loadedmetadata', onceLoaded);
                    });
                } catch (e) {
                    console.error("Error setting audio source:", e);
                    // Set a simple 1-second sine wave tone as absolute fallback
                    createFallbackAudio();
                }
                
                // Reset play button to play state
                playPauseBtn.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                `;
            }
            
            // Show modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });
    });
    
    // Close modal
    if (closeModalBtn) {
        closeModalBtn.addEventListener('click', function() {
            closeModal();
        });
    }
    
    // Close modal when clicking outside content
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
        
        // Close on ESC key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
                closeModal();
            }
        });
    }
    
    function closeModal() {
        modal.classList.add('hidden');
        document.body.style.overflow = ''; // Re-enable scrolling
        
        // Pause audio if playing
        if (meditationAudio && !meditationAudio.paused) {
            meditationAudio.pause();
        }
    }
    
    // Play/Pause meditation audio
    if (startMeditationBtn && meditationAudio) {
        startMeditationBtn.addEventListener('click', toggleAudio);
    }
    
    if (playPauseBtn && meditationAudio) {
        playPauseBtn.addEventListener('click', toggleAudio);
    }
    
    function toggleAudio() {
        if (!meditationAudio) {
            console.error("Audio element not found");
            alert("Audio player not available. Please refresh the page.");
            return;
        }
        
        if (!meditationAudio.src || meditationAudio.src === '') {
            console.error("No audio source set");
            alert("No audio source available. Please try a different meditation.");
            return;
        }
        
        // Check if the current media is valid
        if (meditationAudio.error) {
            console.error("Audio error detected:", meditationAudio.error.code, meditationAudio.error.message);
            
            // Try a direct fallback to a known working audio format
            meditationAudio.src = "https://soundbible.com/mp3/Zen_Bell-SoundBible.com-2070036981.mp3";
            meditationAudio.load();
            
            // Show a notification
            alert("Original audio format not supported. Using a fallback meditation sound.");
            
            // Try playing after a short delay
            setTimeout(() => {
                meditationAudio.play().then(() => {
                    updatePlayButtonUI(true);
                }).catch(err => {
                    console.error("Fallback audio also failed:", err);
                    createFallbackAudio();
                });
            }, 500);
            
            return;
        }
        
        if (meditationAudio.paused) {
            // Play meditation audio with error handling
            console.log("Attempting to play audio:", meditationAudio.src);
            
            // Play meditation audio with error handling
            const playPromise = meditationAudio.play();
            
            if (playPromise !== undefined) {
                playPromise.then(_ => {
                    // Playback started successfully
                    console.log("Audio playback started successfully");
                    updatePlayButtonUI(true);
                }).catch(error => {
                    // Auto-play was prevented or other error occurred
                    console.error("Audio playback error:", error);
                    
                    // Try with a user interaction
                    if (error.name === 'NotAllowedError') {
                        alert("Audio playback requires user interaction. Please try again by clicking the play button.");
                    } else {
                        // Try a different approach with a new audio element
                        tryAlternativePlayback();
                    }
                });
            }
        } else {
            // Pause meditation audio
            meditationAudio.pause();
            updatePlayButtonUI(false);
        }
    }
    
    function updatePlayButtonUI(isPlaying) {
        if (isPlaying) {
            playPauseBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            `;
        } else {
            playPauseBtn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            `;
        }
    }
    
    // Create a fallback audio as a last resort
    function createFallbackAudio() {
        try {
            // First try to use Web Audio API
            if (window.AudioContext || window.webkitAudioContext) {
                const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                const oscillator = audioContext.createOscillator();
                const gainNode = audioContext.createGain();
                
                oscillator.type = 'sine';
                oscillator.frequency.value = 440; // A4 note
                oscillator.connect(gainNode);
                gainNode.connect(audioContext.destination);
                
                // Set up a temporary play method
                meditationAudio.customPlay = function() {
                    gainNode.gain.value = 0.1; // Low volume
                    oscillator.start();
                    return Promise.resolve();
                };
                
                meditationAudio.customPause = function() {
                    gainNode.gain.value = 0;
                    try {
                        oscillator.stop();
                    } catch (e) {
                        // Might be already stopped
                    }
                };
                
                // Override the play method
                const originalPlay = meditationAudio.play;
                meditationAudio.play = function() {
                    try {
                        return originalPlay.call(this);
                    } catch (e) {
                        console.log("Using fallback audio oscillator");
                        return this.customPlay();
                    }
                };
                
                // Override the pause method
                const originalPause = meditationAudio.pause;
                meditationAudio.pause = function() {
                    try {
                        originalPause.call(this);
                    } catch (e) {
                        // Continue even if error
                    }
                    this.customPause();
                };
                
                console.log("Web Audio API fallback created successfully");
            } else {
                // If Web Audio API is not available, use a base64 encoded silent MP3
                const base64Mp3 = "data:audio/mpeg;base64,SUQzBAAAAAABEVRYWFgAAAAtAAADY29tbWVudABCaWdTb3VuZEJhbmsuY29tIC8gTGFTb25vdGhlcXVlLm9yZwBURU5DAAAAHQAAA1N3aXRjaCBQbHVzIMKpIE5DSCBTb2Z0d2FyZQBUSVQyAAAABgAAAzIyMzUAVFNTRQAAAA8AAANMYXZmNTcuODMuMTAwAAAAAAAAAAAAAAD/80DEAAAAA0gAAAAATEFNRTMuMTAwVVVVVVVVVVVVVUxBTUUzLjEwMFVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVf/zQsRbAAADSAAAAABVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVf/zQMSkAAADSAAAAABVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV";
                meditationAudio.src = base64Mp3;
                meditationAudio.load();
                console.log("Base64 audio fallback created");
            }
        } catch (e) {
            console.error("Could not create fallback audio:", e);
            alert("Your browser does not support audio playback. Please try a different browser.");
        }
    }
    
    // Alternative approach for browsers with strict autoplay policies
    function tryAlternativePlayback() {
        console.log("Trying alternative playback approach");
        
        // Create a temporary audio element
        const tempAudio = new Audio();
        tempAudio.src = meditationAudio.src;
        tempAudio.volume = 0.7;
        
        // Try playing it
        tempAudio.play().then(() => {
            // If successful, replace the original audio
            console.log("Alternative playback successful");
            meditationAudio.pause();
            
            // Keep reference to original for restoration
            const originalAudio = meditationAudio;
            meditationAudio = tempAudio;
            
            // Update UI
            updatePlayButtonUI(true);
            
            // Set up the event listeners for the new audio element
            tempAudio.addEventListener('timeupdate', updateProgressBar);
            tempAudio.addEventListener('ended', function() {
                updatePlayButtonUI(false);
                
                // Restore original audio element
                meditationAudio = originalAudio;
            });
        }).catch(e => {
            console.error("Alternative playback failed:", e);
            alert("Unable to play audio. Your browser may be blocking autoplay. Please check your settings.");
            
            // Try one more approach - synthetic audio using Web Audio API
            createFallbackAudio();
        });
    }
    
    // Update progress bar
    if (meditationAudio && progressBar && currentTime) {
        meditationAudio.addEventListener('timeupdate', updateProgressBar);
        
        // Add click functionality to the progress bar for seeking
        const progressContainer = progressBar.parentElement;
        if (progressContainer) {
            progressContainer.addEventListener('click', function(e) {
                if (!meditationAudio.duration) return;
                
                const rect = this.getBoundingClientRect();
                const pos = (e.clientX - rect.left) / rect.width;
                meditationAudio.currentTime = pos * meditationAudio.duration;
                updateProgressBar();
            });
        }
    }
    
    function updateProgressBar() {
        if (!meditationAudio || !progressBar || !currentTime) return;
        
        if (isNaN(meditationAudio.duration)) {
            progressBar.style.width = '0%';
            currentTime.textContent = '0:00';
            return;
        }
        
        const percent = (meditationAudio.currentTime / meditationAudio.duration) * 100;
        progressBar.style.width = percent + '%';
        
        // Update current time display
        const minutes = Math.floor(meditationAudio.currentTime / 60);
        const seconds = Math.floor(meditationAudio.currentTime % 60).toString().padStart(2, '0');
        currentTime.textContent = minutes + ':' + seconds;
    }
    
    // Add event listeners for audio completion
    if (meditationAudio) {
        meditationAudio.addEventListener('ended', function() {
            // Reset play button to play state
            updatePlayButtonUI(false);
        });
        
        // Add error handling
        meditationAudio.addEventListener('error', function(e) {
            console.error('Audio error:', e);
            alert('There was an error playing this meditation. Please try another session or refresh the page.');
        });
    }
}); 