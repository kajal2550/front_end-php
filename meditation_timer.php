<?php
session_start();

if(!isset($_SESSION['user_id']) || !isset($_GET['duration']) || !isset($_GET['session_id'])) {
    header("Location: meditation.php");
    exit;
}

$duration = (int)$_GET['duration'];
$session_id = (int)$_GET['session_id'];
$activity_type = isset($_GET['activity_type']) ? $_GET['activity_type'] : 'meditation';
$page_title = ($activity_type === 'exercise') ? 'Exercise Timer' : 'Meditation Timer';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?> - ZenSpace</title>
    
    <!-- Development environment flag -->
    <script>
        window.process = { env: { NODE_ENV: 'development' } }
    </script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Use latest stable version of Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --color-primary: #7C3AED;
            --color-primary-dark: #6D28D9;
        }
        body {
            font-family: 'Poppins', sans-serif;
        }
        .timer-circle {
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: conic-gradient(var(--color-primary) 0%, #E5E7EB 0%);
            transition: background 1s linear;
        }
        .audio-controls {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 400px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .volume-slider {
            width: 100%;
            margin-top: 0.5rem;
        }
        /* Custom utility classes */
        .bg-primary {
            background-color: var(--color-primary) !important;
        }
        .hover\:bg-primary-dark:hover {
            background-color: var(--color-primary-dark) !important;
        }
        .text-primary {
            color: var(--color-primary) !important;
        }
        /* Dark mode overrides */
        .dark .dark\:bg-gray-800 {
            background-color: #1f2937 !important;
        }
        .dark .dark\:bg-gray-900 {
            background-color: #111827 !important;
        }
        .dark .dark\:text-white {
            color: #ffffff !important;
        }
        .dark .dark\:text-gray-400 {
            color: #9ca3af !important;
        }
        /* Update timer progress color */
        .updateTimerProgress {
            background: conic-gradient(var(--color-primary) var(--progress), #E5E7EB var(--progress)) !important;
        }
    </style>
</head>
<body class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-2xl mx-auto text-center">
            <h1 class="text-3xl font-bold text-gray-800 dark:text-white mb-6">
                <?php echo ($activity_type === 'exercise') ? 'Exercise Timer' : 'Meditation Timer'; ?>
            </h1>
            <div class="relative mb-12">
                <div class="timer-circle mx-auto flex items-center justify-center">
                    <div class="bg-white dark:bg-gray-800 rounded-full w-[280px] h-[280px] flex items-center justify-center">
                        <div>
                            <div id="timer" class="text-5xl font-bold text-gray-800 dark:text-white mb-2">
                                0:00
                            </div>
                            <div class="text-gray-500 dark:text-gray-400">time elapsed</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="space-y-6">
                <button id="playPauseButton" class="bg-primary hover:bg-primary-dark text-white font-medium py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition duration-300 mx-2">
                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg>
                        Start
                    </span>
                </button>
                <button id="stopButton" class="bg-red-500 hover:bg-red-600 text-white font-medium py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition duration-300 mx-2">
                    End Session
                </button>
            </div>
        </div>
    </div>

    <!-- Audio Controls -->
    <div class="audio-controls">
        <div class="flex items-center justify-center space-x-4 mb-4">
            <select id="soundSelect" class="bg-white dark:bg-gray-800 text-gray-800 dark:text-white rounded-lg px-4 py-2">
                <option value="meditation-bowls">Meditation Bowls</option>
                <option value="birdsong">Beautiful Birdsong</option>
                <option value="angelical-pad">Angelical Pad</option>
                <option value="uplifting-pad">Uplifting Pad</option>
                <option value="beautiful-choir">Beautiful Choir</option>
                <option value="birds-pakistan">Birds in Pakistan</option>
            </select>
            <button id="toggleAudio" class="bg-primary hover:bg-primary-dark text-white rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828a1 1 0 010-1.415z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        <input type="range" id="volumeSlider" class="w-full" min="0" max="100" value="50">
    </div>

    <!-- Audio Elements -->
    <audio id="meditation-bowls" preload="auto">
        <source src="audio/meditation-bowls-23651.mp3" type="audio/mpeg">
    </audio>
    <audio id="birdsong" preload="auto">
        <source src="audio/beautiful-birdsong-3-301866.mp3" type="audio/mpeg">
    </audio>
    <audio id="angelical-pad" preload="auto">
        <source src="audio/angelical-pad-143276.mp3" type="audio/mpeg">
    </audio>
    <audio id="uplifting-pad" preload="auto">
        <source src="audio/uplifting-pad-texture-113842.mp3" type="audio/mpeg">
    </audio>
    <audio id="beautiful-choir" preload="auto">
        <source src="audio/beautiful-choir-170206.mp3" type="audio/mpeg">
    </audio>
    <audio id="birds-pakistan" preload="auto">
        <source src="audio/voice-beautiful-birds-in-pakistan-8984.mp3" type="audio/mpeg">
    </audio>

    <script>
        // Add error reporting with file path checking
        window.onerror = function(msg, url, lineNo, columnNo, error) {
            console.error('Error: ' + msg + '\nURL: ' + url + '\nLine: ' + lineNo + '\nColumn: ' + columnNo + '\nError object: ' + JSON.stringify(error));
            return false;
        };

        // Timer and audio state
        const duration = <?php echo $duration ?>;
        let timeElapsed = 0;
        let isPaused = true;
        let timerInterval;
        let isPlaying = false;
        let currentAudio = null;

        // Timer functions
        function updateTimer() {
            const minutes = Math.floor(timeElapsed / 60);
            const seconds = timeElapsed % 60;
            document.getElementById('timer').textContent = 
                `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            const progress = (timeElapsed / (duration * 60)) * 100;
            document.querySelector('.timer-circle').style.background = 
                `conic-gradient(#7C3AED ${progress}%, #E5E7EB ${progress}%)`;
            
            if (timeElapsed >= duration * 60) {
                clearInterval(timerInterval);
                sessionComplete();
            }
        }
        
        function startTimer() {
            timerInterval = setInterval(() => {
                if (!isPaused && timeElapsed < duration * 60) {
                    timeElapsed++;
                    updateTimer();
                }
            }, 1000);
            updateTimer(); // Initial update
        }

        // Stop button handler
        document.getElementById('stopButton').addEventListener('click', function() {
            if (confirm('Are you sure you want to end this session?')) {
                sessionComplete();
            }
        });
        
        // Initialize audio elements
        const soundSelect = document.getElementById('soundSelect');
        const volumeSlider = document.getElementById('volumeSlider');
        const toggleAudio = document.getElementById('toggleAudio');
        const audioElements = {
            'meditation-bowls': document.getElementById('meditation-bowls'),
            'birdsong': document.getElementById('birdsong'),
            'angelical-pad': document.getElementById('angelical-pad'),
            'uplifting-pad': document.getElementById('uplifting-pad'),
            'beautiful-choir': document.getElementById('beautiful-choir'),
            'birds-pakistan': document.getElementById('birds-pakistan')
        };

        // Update sound options
        soundSelect.innerHTML = '<option value="meditation-bowls">Meditation Bowls</option><option value="birdsong">Beautiful Birdsong</option><option value="angelical-pad">Angelical Pad</option><option value="uplifting-pad">Uplifting Pad</option><option value="beautiful-choir">Beautiful Choir</option><option value="birds-pakistan">Birds in Pakistan</option>';

        // Set initial audio
        currentAudio = audioElements[soundSelect.value];

        // Initialize audio settings
        if (currentAudio) {
            currentAudio.volume = volumeSlider.value / 100;
            currentAudio.loop = true;
            
            // Add comprehensive error handling
            currentAudio.addEventListener('error', (e) => {
                console.error('Audio Error:', {
                    element: currentAudio.id,
                    error: e.target.error,
                    code: e.target.error ? e.target.error.code : null,
                    message: e.target.error ? e.target.error.message : null,
                    src: currentAudio.querySelector('source') ? currentAudio.querySelector('source').src : null
                });
                alert('Audio error occurred. Check console for details.');
            });

            // Add loading and state handlers
            currentAudio.addEventListener('loadstart', () => {
                console.log('Audio loading started');
            });

            currentAudio.addEventListener('loadeddata', () => {
                console.log('Audio data loaded');
            });

            currentAudio.addEventListener('canplay', () => {
                console.log('Audio can start playing');
            });

            currentAudio.addEventListener('play', () => {
                console.log('Audio started playing');
            });

            currentAudio.addEventListener('pause', () => {
                console.log('Audio paused');
            });

            // Force load
            try {
                currentAudio.load();
                console.log('Audio loading initiated');
            } catch (error) {
                console.error('Error loading audio:', error);
            }
        }

        // Play/Pause button handler
        const playPauseButton = document.getElementById('playPauseButton');
        playPauseButton.addEventListener('click', async function() {
            isPaused = !isPaused;
            
            if (isPaused) {
                // Pause both timer and audio
                this.innerHTML = `<span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                    </svg>
                    Resume
                </span>`;
                await pauseAudio();
            } else {
                // Start both timer and audio
                this.innerHTML = `<span class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zM7 8a1 1 0 012 0v4a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v4a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    Pause
                </span>`;
                await playAudio(); // Start audio when timer starts
            }
        });

        // Audio controls
        toggleAudio.addEventListener('click', async () => {
            if (!currentAudio) return;

            if (isPlaying) {
                await pauseAudio();
            } else {
                if (!isPaused) { // Only play if timer is running
                    await playAudio();
                }
            }
        });

        // Sound selection handler
        soundSelect.addEventListener('change', async () => {
            const wasPlaying = isPlaying;
            if (isPlaying) {
                await pauseAudio();
            }
            currentAudio = audioElements[soundSelect.value];
            if (wasPlaying && !isPaused) {
                await playAudio();
            }
        });

        // Volume control
        volumeSlider.addEventListener('input', () => {
            const volume = volumeSlider.value / 100;
            Object.values(audioElements).forEach(audio => {
                if (audio) audio.volume = volume;
            });
        });

        // Audio control functions
        async function playAudio() {
            if (!currentAudio || isPaused) {
                console.log('Cannot play: audio not ready or timer paused');
                return;
            }
            
            try {
                console.log('Attempting to play audio...');
                const playPromise = currentAudio.play();
                if (playPromise !== undefined) {
                    await playPromise;
                    isPlaying = true;
                    updatePlayButton(true);
                    console.log('Audio playing successfully');
                }
            } catch (error) {
                console.error('Error playing audio:', error);
                isPlaying = false;
                updatePlayButton(false);
                if (error.name === 'NotAllowedError') {
                    alert('Please click anywhere on the page first, then try playing the sound again.');
                } else {
                    alert('Error playing audio: ' + error.message);
                }
            }
        }

        async function pauseAudio() {
            if (!currentAudio) return;
            
            try {
                currentAudio.pause();
                isPlaying = false;
                updatePlayButton(false);
                console.log('Audio paused:', currentAudio.id);
            } catch (error) {
                console.error('Error pausing audio:', error);
            }
        }

        function updatePlayButton(playing) {
            const icon = toggleAudio.querySelector('svg');
            if (playing) {
                icon.innerHTML = `<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8 7a1 1 0 00-1 1v4a1 1 0 001 1h4a1 1 0 001-1V8a1 1 0 00-1-1H8z" clip-rule="evenodd" />`;
            } else {
                icon.innerHTML = `<path fill-rule="evenodd" d="M9.383 3.076A1 1 0 0110 4v12a1 1 0 01-1.707.707L4.586 13H2a1 1 0 01-1-1V8a1 1 0 011-1h2.586l3.707-3.707a1 1 0 011.09-.217zM14.657 2.929a1 1 0 011.414 0A9.972 9.972 0 0119 10a9.972 9.972 0 01-2.929 7.071 1 1 0 01-1.414-1.414A7.971 7.971 0 0017 10c0-2.21-.894-4.208-2.343-5.657a1 1 0 010-1.414zm-2.829 2.828a1 1 0 011.415 0A5.983 5.983 0 0115 10a5.984 5.984 0 01-1.757 4.243 1 1 0 01-1.415-1.415A3.984 3.984 0 0013 10a3.983 3.983 0 00-1.172-2.828a1 1 0 010-1.415z" clip-rule="evenodd" />`;
            }
        }

        // Session completion
        function sessionComplete() {
            pauseAudio();
            window.location.href = 'tracker.php?success=1';
        }

        // Cleanup
        window.addEventListener('beforeunload', pauseAudio);

        // Start the timer
        startTimer();
    </script>
</body>
</html> 