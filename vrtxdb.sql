CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    userName VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    dateMade TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tracks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    path VARCHAR(255) NOT NULL,
    cover VARCHAR(255) NOT NULL
);

INSERT INTO `tracks` (`artist`, `musicName`, `cover`, `musicPath`) VALUES 
('Deftones', 'Diamond Eyes', 'cover/Diamond Eyes.jpg', 'audio/Deftones - Diamond Eyes.mp3'),
('Arcane League of Legends', 'Ma Meilleure Ennemie', 'cover/Arcane.jpg', 'audio/Ma Meilleure Ennemie (from the series Arcane League of Legends).mp3'),
('Pierce The Veil', 'One Hundred Sleepless Nights', 'cover/Collide With The Sky.jpg', 'audio/Pierce The Veil - One Hundred Sleepless Nights.mp3'),
('The Last Shadow Puppets', 'My Mistakes Were Made For You', 'cover/My Mistakes Were Made For You.jpg', 'audio/The Last Shadow Puppets - My Mistakes Were Made For You.mp3'),
('The Strokes', 'The Adults Are Talking', 'cover/The Adults Are Talking.jpg', 'audio/The Strokes - The Adults Are Talking.mp3');
