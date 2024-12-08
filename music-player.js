const playButton = document.getElementById('play');
const prevButton = document.getElementById('prev');
const nextButton = document.getElementById('next');
const playIcon = playButton.querySelector('.play-icon');
const progress = document.getElementById('progress');
const currentTimeElement = document.getElementById('current-time');
const durationElement = document.getElementById('duration-time');


const trackList = [
    'audio/Deftones - Diamond Eyes.mp3',
    'audio/Ma Meilleure Ennemie (from the series Arcane League of Legends).mp3',
    'audio/Pierce The Veil - One Hundred Sleepless Nights.mp3',
    'audio/The Last Shadow Puppets - My Mistakes Were Made For You.mp3',
    'audio/The Strokes - The Adults Are Talking.mp3'
];


let currentTrackIndex = 0; 
let isPlaying = false;
let audioElement = null;


function initializeAudio(trackIndex = 0) {
    if (audioElement) {
        audioElement.pause(); 
    }

    audioElement = new Audio(trackList[trackIndex]); 
    audioElement.addEventListener('timeupdate', updateProgress);
    audioElement.addEventListener('loadedmetadata', function() {
        durationElement.textContent = formatTime(audioElement.duration); 
    });
    audioElement.addEventListener('ended', playNextTrack); 
}

// Event listener for play button
playButton.addEventListener('click', function() {
    if (!audioElement) {
        initializeAudio(currentTrackIndex);
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
    currentTrackIndex = (currentTrackIndex - 1 + trackList.length) % trackList.length;
    initializeAudio(currentTrackIndex);
    audioElement.play();
    updatePlayButton();
});

nextButton.addEventListener('click', function() {
    playNextTrack();
});

function playNextTrack() {
    currentTrackIndex = (currentTrackIndex + 1) % trackList.length; 
    initializeAudio(currentTrackIndex);
    audioElement.play();
    updatePlayButton();
}


function updatePlayButton() {
    playIcon.classList.remove('fa-play');
    playIcon.classList.add('fa-pause');
    isPlaying = true;
}

// progress barrrr
function updateProgress() {
    const progressValue = (audioElement.currentTime / audioElement.duration) * 100;
    progress.value = progressValue;

   
    const bgColor = `linear-gradient(to right, #6114C0 ${progressValue}%, #585757 ${progressValue}%)`;
    progress.style.background = bgColor;

    
    currentTimeElement.textContent = formatTime(audioElement.currentTime);
}


function formatTime(seconds) {
    const minutes = Math.floor(seconds / 60);
    const remainingSeconds = Math.floor(seconds % 60);
    return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
}


progress.addEventListener('input', function() {
    audioElement.currentTime = (progress.value / 100) * audioElement.duration;
    
    
    const progressValue = progress.value;
    const bgColor = `linear-gradient(to right, #6114C0 ${progressValue}%, #585757 ${progressValue}%)`;
    progress.style.background = bgColor;
});


const contentPlayButtons = document.querySelectorAll('.play-btn'); 

contentPlayButtons.forEach((button, index) => {
    button.addEventListener('click', function() {
        currentTrackIndex = index; 
        initializeAudio(currentTrackIndex);
        audioElement.play();
        updatePlayButton();
    });
});