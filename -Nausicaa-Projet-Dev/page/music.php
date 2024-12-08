<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Player</title>
</head>
<body>
    <audio id="background-music" autoplay loop>
        <source src="../page/images/yo ho yo ho a pirates life for me.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script>
        const audio = document.getElementById('background-music');
        
        // Load the saved playback position from localStorage
        const savedTime = localStorage.getItem('musicTime');
        if (savedTime) {
            audio.currentTime = savedTime;
        }

        // Save the playback position periodically
        setInterval(() => {
            localStorage.setItem('musicTime', audio.currentTime);
        }, 1000);
    </script>
</body>
</html>
