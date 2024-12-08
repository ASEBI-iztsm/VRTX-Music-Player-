<?php
session_start();


// Spotify API handler
class SpotifyAPI {
    private $accessToken;

    public function __construct($accessToken) {
        $this->accessToken = $accessToken;
    }

    public function search($query, $type = "album,track,artist") {
        $encodedQuery = urlencode($query);
        $url = "https://api.spotify.com/v1/search?q=$encodedQuery&type=$type&include_external=audio";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $this->accessToken"
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            throw new Exception('Curl Error: ' . curl_error($ch));
        }

        curl_close($ch);

        return json_decode($response, true);
    }
}

// Spotify access token
$accessToken = 'BQCgdQLOZEsIGE3wwQ7NCJawRC-4V0kV0RYQ1wWSYRahfV5VhfKIhT7GH7iwZnT_7BrSrCfIqNTomm7cArn9RUuvh_yRXnQ0ZAezhCrggBjbD5vpXGftDltBdfK9LmTpTy3i43WAGVIoubxS47xGJqf2sUX8O6vcb3AFpMJgEAsXLkH5oT89jAkp2miz6JQDyAfwuDd8XvdUGjMhAheDnqrcfFkByZSC2L85K107'; // Replace with your actual token

// Handle search requests
$searchResults = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
    try {
        $spotify = new SpotifyAPI($accessToken);
        $searchResults = $spotify->search($_POST['search']);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VRTX | Playlists</title>
    <link rel="stylesheet" href="homepage.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
<script src="https://sdk.scdn.co/spotify-player.js"></script>

<div class="main-cont">
    <div class="vertnav">
        <center><img src="pics/vrtx.jpg" class="logo"></center>
        <a href="homepage.php" id="options">HOME</a>
        <a href="favorite.php" id="options">FAVORITES</a>
        <a href="playlist.php" id="options">PLAYLISTS</a>
        <a href="account.php" id="options">ACCOUNT</a>
        <a href="logout.php" class="logout">LOGOUT</a> 
    </div>

    <div class="content-homepage">
<!--DISPLAY SOME PLAYLISTS HERE FROM SPOTIFY-->
<h1>PLAYLISTS</h1>
<button type = "" class = "playlist-btn">CREATE PLAYLIST</button>
</div> 

    
<div class="play-cont">
    <div class="music-controls">
        <div id="prev" class="music-controls-item">
            <i class="fas fa-backward music-controls-item--icon"></i>
        </div>

        <div id="play" class="music-controls-item">
            <i class="fas fa-play music-controls-item--icon play-icon"></i>
            <div class="play-icon-background"></div>
        </div>

        <div id="next" class="music-controls-item">
            <i class="fas fa-forward music-controls-item--icon"></i>
        </div>
    </div>
    <div class="progress-bar">
        <input type="range" min="0" max="100" value="0" id="progress">
    </div>
</div>
<!-- <div class="play-cont">
    <div class="music-controls">
            <div id="prev" class="music-controls-item">
                <i class="fas fa-backward music-controls-item--icon"></i>
            </div>

            <div id="play" class="music-controls-item">
                <i class="fas fa-play music-controls-item--icon play-icon"></i>
                <div class="play-icon-background"></div>
            </div>

            <div id="next" class="music-controls-item">
                <i class="fas fa-forward music-controls-item--icon"></i>
               
            </div>
            <div class="music-progress">
                <div id="progress-bar" class="music-progress-bar"></div>
                <div class="music-progress__time">
                    <span class="music-progress__time-item music-current-time">00:00</span>
                    <span class="music-progress__time-item music-duration-time">00:00</span>
                </div>
            </div>
    </div>
</div> -->




<!-- <script src="https://sdk.scdn.co/spotify-player.js"></script> -->
<script src="spotify-player.js"></script>
</body>
</html>
