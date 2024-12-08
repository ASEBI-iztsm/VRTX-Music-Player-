<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

class Database {
    private $host = 'localhost';
    private $dbname = 'vrtxdb';
    private $username = 'root';
    private $password = '';
    public $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
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
