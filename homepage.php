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
    <title>VRTX</title>
    <link rel="stylesheet" href="homepage.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>

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
        <form method="POST">
            <input type="text" id="searchInput" name="search" class="search-bar" placeholder="Wanna listen to some tunes?" required autocomplete="off">
            <button type="submit" class="search-btn">Seek</button>
        </form>

        <div class="tracks">
            <h2>YOUR TRACKS</h2>
            <?php
            $db = new Database();
            $stmt = $db->pdo->query("SELECT * FROM tracks");
            while ($row = $stmt->fetch()) {
                echo '<div class="track-item">';
                echo '<img src="' . $row['cover'] . '" alt="Cover" class="track-cover">';
                echo '<span class="track-name">' . $row['name'] . '</span>';
                echo '<span class="track-artist">' . $row['artist'] . '</span>';
                echo '<button class="play-btn" data-path="' . $row['path'] . '">Play</button>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div> 

<div class="play-cont">
    <div class="album-img-player">
        <!-- Add Album Image Here -->
    </div>
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
    
    <div class="timestamps">
        <span id="current-time">0:00</span>
        <span id="duration-time">0:00</span>
    </div>

</div>


<script src="music-player.js"></script>

</body>
</html>
