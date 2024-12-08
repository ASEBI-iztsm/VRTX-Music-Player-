// Get player controls and elements
const playButton = document.getElementById('play');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');
const playIcon = playButton.querySelector('.play-icon');
const progress = document.getElementById('progress');
const currentTimeElement = document.getElementById('current-time');
const durationElement = document.getElementById('duration-time');

// Track list (Add more tracks if you'd like)
const trackList = [
    'audio/Deftones - Diamond Eyes.mp3',
    'audio/Linkin Park - Numb.mp3',
    'audio/Breaking Benjamin - The Diary of Jane.mp3'
];

let currentTrackIndex = 0; // Index of the current track
let isPlaying = false;
let audioElement = null;

// Function to initialize and load the selected audio track
function initializeAudio(trackIndex = 0) {
    if (audioElement) {
        audioElement.pause(); // Pause any previous audio
    }

    // Load new track based on trackList and trackIndex
    audioElement = new Audio(trackList[trackIndex]); 
    audioElement.addEventListener('timeupdate', updateProgress);
    audioElement.addEventListener('loadedmetadata', function() {
        durationElement.textContent = formatTime(audioElement.duration); // Set total duration once metadata is loaded
    });
    audioElement.addEventListener('ended', playNextTrack); // Play next track when the current one finishes
}

// Event listener for play button
playButton.addEventListener('click', function() {
    if (!audioElement) {
        initializeAudio(currentTrackIndex); // Initialize the first track if not loaded
    }

    if (audioElement.paused) {
        audioElement.play();
        playIcon.classList.remove('fa-play');
        playIcon.classList.add('fa-pause');
        isPlaying = true;
    } else {
        audioElement.pause();
        playIcon.classList.remove('fa-pause');
        playIcon.classList.add('fa-play');
        isPlaying = false;
    }
});

// Event listener for previous button
prevButton.addEventListener('click', function() {
    currentTrackIndex = (currentTrackIndex - 1 + trackList.length) % trackList.length; // Loop to the last track
    initializeAudio(currentTrackIndex);
    audioElement.play();
    updatePlayButton();
});

// Event listener for next button
nextButton.addEventListener('click', function() {
    playNextTrack();
});

function playNextTrack() {
    currentTrackIndex = (currentTrackIndex + 1) % trackList.length; // Loop back to first track
    initializeAudio(currentTrackIndex);
    audioElement.play();
    updatePlayButton();
}

// Function to update the play button icon
function updatePlayButton() {
    playIcon.classList.remove('fa-play');
    playIcon.classList.add('fa-pause');
    isPlaying = true;
}

// Event listener for updating the progress bar
function updateProgress() {
    const progressValue = (audioElement.currentTime / audioElement.duration) * 100;
    progress.value = progressValue;

    // Update the progress bar's background color
    const bgColor = `linear-gradient(to right, #6114C0 ${progressValue}%, #585757 ${progressValue}%)`;
    progress.style.background = bgColor;

    // Update the current time display
    currentTimeElement.textContent = formatTime(audioElement.currentTime);
}

// Format time in MM:SS format
function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
}

// Update the audio current time when the progress bar is changed
progress.addEventListener('input', function() {
    audioElement.currentTime = (progress.value / 100) * audioElement.duration;
    
    // Update background color while dragging the thumb
    const progressValue = progress.value;
    const bgColor = `linear-gradient(to right, #6114C0 ${progressValue}%, #585757 ${progressValue}%)`;
    progress.style.background = bgColor;
});

// Event listener for each play button in the content page
const contentPlayButtons = document.querySelectorAll('.play-btn'); // Ensure you have a play button with this class

contentPlayButtons.forEach((button, index) => {
    button.addEventListener('click', function() {
        currentTrackIndex = index; // Set current track based on the clicked button
        initializeAudio(currentTrackIndex);
        audioElement.play();
        updatePlayButton();
    });
});
