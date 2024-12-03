<!DOCTYPE html>
<html lang="en">
<head>
    <title>Game</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<?php
    //Barre de navigation
    require("../pageparts/nav.php");
?>


<body>
    <h2>GAME</h2>

    <h3>You have given up, here is a solution</h3>
    <?php
        if(empty($_SESSION["mapId"])) // si pas d'element dif dans  url et pas de niveau defini on affiche un choix de difficulté
            header("Location:index.php");
        $reqPrep="SELECT size, HorizontalValues, VerticalValues, Field, NBoat1, NBoat2, NBoat3, NBoat4, NBoat5 FROM maps WHERE id = :id";//La requete SQL SELECT
        $req = $conn->prepare($reqPrep);//Préparer la requete
        $req->execute(array(':id' => $_SESSION["mapId"]));//Executer la requete

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);//récupérer le résultat

        foreach ($resultat as $ligne){ // on vient attribuer les valeurs correspondant a celles de la cartes aux variables
            foreach ($ligne as $element => $valeur){
                if($element == "size")
                    $size = $valeur;
                if($element == "HorizontalValues")
                    $horizontalValues = $valeur;
                if($element == "VerticalValues")
                    $verticalValues = $valeur;
                if($element == "Field")
                    $Field = $valeur;
                if($element == "NBoat1")
                    $NBoat1 = $valeur;
                if($element == "NBoat2")
                    $NBoat2 = $valeur;
                if($element == "NBoat3")
                    $NBoat3 = $valeur;
                if($element == "NBoat4")
                    $NBoat4 = $valeur;
                if($element == "NBoat5")
                    $NBoat5 = $valeur;
                }
            }
        $command = "..\cFiles\solveur\solveur.exe $size $horizontalValues $verticalValues $Field $NBoat1 $NBoat2 $NBoat3 $NBoat4 $NBoat5";
        $solution = shell_exec("$command");
        echo"<a href='game.php'>New Game</a>";  
    ?>

<div class="contentpage">
        <table>
            <?php 
            $pos = 0;

            // on defini le tableau de jeu
            echo"<tr><th>   </th>";
            for($i = 0; $i < $size; $i++){
                echo"<th><h2>".$verticalValues[2 * $i]."</h2></th>";
                
            }
            echo"</tr>";
            for($i = 0; $i < $size; $i++){
                echo"<tr><th><h2>".$horizontalValues[2 * $i]."</h2></th>";
                for($j = 0; $j < $size; $j++){
                    echo"<td><button class='button' id='".($size*$i + $j)."'></button></td>";
                }
                echo"</tr>";
            }
            ?>
        </table>
    </div>

    <script>var Boat1 = <?php echo json_encode($NBoat1); ?>;
        var Boat2 = <?php echo json_encode($NBoat2); ?>;
        var Boat3 = <?php echo json_encode($NBoat3); ?>;
        var Boat4 = <?php echo json_encode($NBoat4); ?>;
        var Boat5 = <?php echo json_encode($NBoat5); ?>;

        var size = <?php echo json_encode($size); ?>;
        var horizontalValues = <?php echo json_encode($horizontalValues); ?>;
        var verticalValues = <?php echo json_encode($verticalValues); ?>;
        var map = <?php echo json_encode($solution); ?>;

        // initalisation d autres variables necessaires

        let tab = [size * size];
        let VValues = [size];
        let HValues = [size];

        var pos = 0;
        var nb = 0;
        while(map[pos] != null){
            tab[nb] = Number(map[pos]);
            pos += 2;
            nb++;
        }    

        function setMap(){
            pos = 0;
            nb = 0;
            while(map[pos] != null){
                tab[nb] = Number(map[pos]);
                pos += 2;
                nb++;
            }            
        }

        
        pos = 0;
        nb = 0;
        while(verticalValues[pos] != null){
            VValues[nb] = verticalValues[pos];
            pos += 2;
            nb++;
        }

        pos = 0;
        nb = 0;
        while(horizontalValues[pos] != null){
            HValues[nb] = horizontalValues[pos];
            pos += 2;
            nb++;
        }
        
        setImage();

        // appliquer la bonne image aux boutons
        function setImage(){
            for(var i = 0; i < size * size; i++){
                var buttons = document.getElementById(String(i));
                if(tab[i] == 0)
                    buttons.innerHTML = '<img src="images/empty.png" />';
                if(tab[i] == 1)
                    buttons.innerHTML = '<img src="images/water.png" />';
                if(tab[i] == 2)
                    buttons.innerHTML = '<img src="images/smallBoat.png" />';
                if(tab[i] == 3)
                    buttons.innerHTML = '<img src="images/mid.png" />';
                if(tab[i] == 4)
                    buttons.innerHTML = '<img src="images/frontBottom.png" />';
                if(tab[i] == 5)
                    buttons.innerHTML = '<img src="images/frontTop.png" />';
                if(tab[i] == 6)
                    buttons.innerHTML = '<img src="images/frontLeft.png" />';
                if(tab[i] == 7)
                    buttons.innerHTML = '<img src="images/frontRight.png" />';
            }
        }
        </script>
    
</body>
<?php
    require("../pageparts/footer.php");
?>

</html>
