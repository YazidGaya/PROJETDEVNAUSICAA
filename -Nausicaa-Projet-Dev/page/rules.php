<?php

?>


<!DOCTYPE html>
<head>
    <title>Battleships</title>
    <link rel="stylesheet" href="style/style.css">
    <script src="script.js" defer></script>
</head>
<?php
    //Barre de navigation
    require("../pageparts/nav.php");
    ?>
<body>
<h2> RULES</h2>
    <br>
    <div class="contentpage">

        <p> The battleships game is played on a grid, where some of the squares hide a boat, while the rest hides water. 

    The boats can be from one to four squares long, and the goal is to find all of them. At the beginning, you know 

    the number of hidden ships and their composition, as well as the number of squares taken by boats for each 

    column and line. In addition, boats cannot touch each other, even diagonally. You click one time to set a 

    square to water, and twice to set it to a boat part.</p>

    </div>

    <div class="Exemple_rules">
        <h3>Example</h3>
		
        
        <div class="Step">
        <img src="../page/images/Grid_empty.png" alt="Grid empty"> <p> Here is an example of a grid. When you start a grid, each square is already filled with either boats or water. Here, we only have boat squares. </p>

        </div>
        <br>
        <div class="Step">

        <img src="../page/images/step 1.png" alt="Step 1"> <p> The numbers on the top and left of the grid indicate the number of squares taken by boats for each column and line. here we have a line where we have 0 squares representing a boat, so we can guess that on the line we can only pass water. </p>

        </div>
        <br>
        <div class="Step">

        <img src="../page/images/step 2.png" alt="Step 2"> <p> Finally, we can guess where we can place boats or water. For example, in the last column of our grid, we need to place a boat square, but the whole column contains water except for the first square in the column, so we know that this is where we need to place the only boat square in the column. </p>

        </div>

        
        

    </div>

    <br><br><br><br>

    <?php
    require("../pageparts/footer.php");
    ?>

</html>
