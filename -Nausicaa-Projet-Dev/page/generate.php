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
    <h2 id="titrepage">GENERATE </h2>
    <div class="contentpage">
        <form action="generateform.php" method="post">
            <legend>Choose the size 
            </legend>
            <input type='radio' name='size' value='6' checked>6*6</input>
            <input type='radio' name='size' value='8'>8*8</input>
            <input type='radio' name='size' value='10' checked>10*10</input>
            <br><br>
            <legend>Choose your level of difficulty</legend>
            <input type='radio' name='difficulty' value='1' checked>Easy</input>
            <input type='radio' name='difficulty' value='2'>Medium</input>
            <input type='radio' name='difficulty' value='3'>Hard</input>
            <br><br>
            <input type='submit' name='submit' value='Submit'></input>
        </form>
    </div>

    <?php
    
    ?>
</body>
<br><br>

<?php
    require("../pageparts/footer.php");
?>

</html>

