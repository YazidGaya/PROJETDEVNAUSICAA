<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Battleships</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="script.js" defer></script>
</head>

<?php
    //Barre de navigation
    require("../pageparts/nav.php");
?>
</div>
<body>
    <h2 id="titrepage">HOMEPAGE </h2>
    <div class="contentpage">
        <div class="text-and-image">
            <div class="pirate">
                <img src="../page/images/pirate.png" alt="pirate">
            </div>
            <div class="text-content">
                <div class="speech-bubble">
                    <h3>Welcome! Sailor</h3>
                    <p>I am Odyssée. I am the captain of this ship. We are currently under attack by the enemy fleet. We need someone brave to help us repel them. We thought of you, young adventurer. Your mission, if you choose to accept it, is to locate the enemy ships so that I can then repel them with my legendary sword.</p>
                    <div id="menuindex">
                        <a href="game.php" class="buttonplay">Play</a>
                        <a href="create.php" class="buttonplay">Creator</a>
                        <a href="generate.php" class="buttonplay">Generator</a> 
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    /*
    $compilecmd="gcc -o C:\MAMP\htdocs\grp01-Nausicaa\prog C:/MAMP/htdocs/grp01-Nausicaa/testenc.c 2>&1";
    $executecmd="C:\MAMP\htdocs\grp01-Nausicaa\prog.exe exemple 2>&1";

    $compileOutput = shell_exec($compilecmd);
    echo $compileOutput;

    $execOutput = shell_exec($executecmd);
    echo $execOutput;
    */
    ?>
</body>
<br><br>

<?php
    require("../pageparts/footer.php");
?>

</html>
