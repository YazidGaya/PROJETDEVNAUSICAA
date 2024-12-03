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
    <?php
        if((empty($_GET["dif"]) && empty($_SESSION["mapId"])) || (!empty($_SESSION["mapId"]) && empty($_GET["time"]) )) // si pas d'element dif dans  url et pas de niveau defini on affiche un choix de difficulté
            echo"<div class='contentpage'>
                    <form method='post' action='gameform.php'>
                        <legend>Do you want your game to be timed ?</legend>
                        <input type='radio' name='chronochoice' value='yes' checked>Yes</input>
                        <input type='radio' name='chronochoice' value='no'>No</input>

                        <br><br>
                        <legend>Choose your level of difficulty</legend>

                        <input type='radio' name='difficulty' value='easy' checked>Easy</input>
                        <input type='radio' name='difficulty' value='medium'>Medium</input>
                        <input type='radio' name='difficulty' value='hard'>Hard</input>
                        <br><br>
                        <input type='submit' name='submit' value='Submit'></input>

                    </form>
                    <br>
                    <a href='create.php'>Create new level</a>
                </div>";
        else{
            if(!empty($_SESSION["mapId"]) && isset($_GET["time"])){ //si une map est choisie et un temps est defini c est que une partie vient de se terminer
                echo"<h1>Congratulations, you have successfully completed this level !</h1>"; //on affiche un message de felicitation et le temp
                $time = $_GET["time"];
                if($time > 0){
                    $hour = intdiv($time, 3600);
                    $time = $time % 3600;
                    $minutes = intdiv($time, 60);
                    $time = $time % 60;
                    if($_SESSION['chrono']==='yes'){
                        echo "<h2>your time was $hour h, $minutes m, $time s</h2>";
                    }
                    $reqPrep="SELECT TotalTimePlayed, NumberOfGamesWon FROM statistics";//La requete SQL SELECT
                    $req = $conn->prepare($reqPrep);//Préparer la requete
                    $req->execute();//Executer la requete
                    $resultat = $req->fetchAll(PDO::FETCH_ASSOC);//récupérer le résultat

                    foreach ($resultat as $ligne){
                        foreach ($ligne as $element => $valeur){
                            if($element == "TotalTimePlayed"){
                                $totalTime = $time;
                            }
                            if($element == "NumberOfGamesWon"){
                                $GamesWon = $valeur + 1;
                            }
                        }
                    }
                        
                    $reqPrep="UPDATE statistics SET TotalTimePlayed = :time, NumberOfGamesWon = :won";//La requete SQL SELECT
                        $req = $conn->prepare($reqPrep);//Préparer la requete
                        $req->execute(array(
                            ':time' => $totalTime,
                            ':NumberOfGamesWon' => $GamesWon
                        ));
                
                    if(isset($_SESSION["authentified"])){ // si un compte est connecté, on recupere les info de la table mapplayed et on les mets a jour / cree l'element si inexistant
                        $reqPrep="SELECT BestTime, PlayedTimes FROM mapsplayed WHERE PlayerId = ? AND MapId = ?";//La requete SQL SELECT
                        $req = $conn->prepare($reqPrep);//Préparer la requete
                        $req->execute(array($_SESSION["id"], $_SESSION["mapId"]));//Executer la requete
                        if($req->rowCount()> 0){ //si l element existe on le met a jour
                            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);//récupérer le résultat
                            foreach ($resultat as $ligne){
                                foreach ($ligne as $element => $valeur){
                                    if($element == "BestTime"){
                                        if($valeur < $time)
                                            $time = $valeur;
                                    }
                                    if($element == "PlayedTimes"){
                                        $PlayedTimes = $valeur + 1;
                                    }
                                }
                            }
                            $reqPrep="UPDATE mapsplayed SET BestTime = :besttime, PlayedTimes = :playedtimes WHERE MapId = :mapid AND PlayerId = :playerid";//La requete SQL SELECT
                            $req = $conn->prepare($reqPrep);//Préparer la requete
                            $req->execute(array(
                                ':besttime' => $time,
                                ':playedtimes' => $PlayedTimes,
                                ':mapid' => $_SESSION["mapId"],
                                ':playerid' => $_SESSION["id"]
                            ));
                            $reqPrep="SELECT GamesWon FROM users WHERE Id = ?";//La requete SQL SELECT
                            $req = $conn->prepare($reqPrep);//Préparer la requete
                            $req->execute(array($_SESSION["id"]));//Executer la requete
                            $resultat = $req->fetchAll(PDO::FETCH_ASSOC);//récupérer le résultat
                            foreach ($resultat as $ligne){
                                foreach ($ligne as $element => $valeur){
                                    if($element == "GamesWon"){
                                            $gwon = $valeur;
                                    }
                                }
                            }
                            $reqPrep="UPDATE users SET GamesWon = :won WHERE Id = :ID";//La requete SQL SELECT
                            $req = $conn->prepare($reqPrep);//Préparer la requete
                            $req->execute(array(
                                ':won' => $gwon + 1,
                                ':ID' => $_SESSION["id"]
                            ));
                        }
                        else{ //si il n'existe pas on le cree
                            $reqPrep="INSERT INTO `mapsplayed`(`MapId`, `PlayerId`, `BestTime`, `PlayedTimes`) VALUES (:mapid, :playerid, :besttime, :playedtimes)";//La requete SQL SELECT
                            $req = $conn->prepare($reqPrep);//Préparer la requete
                            $req->execute(array(
                                ':mapid' => $_SESSION["mapId"],
                                ':playerid' => $_SESSION["id"],
                                ':besttime' => $time,
                                ':playedtimes' => 1
                            ));
                        }
                    }
                }
                $_SESSION["mapId"] = 0;
                echo"<a href='game.php'>New Game</a>";                
            }
            else{
                $diff = $_GET["dif"]; //si une difficulté a été choisie on recupere toutes les cartes de cette difficulté de la BDD
                $reqPrep="SELECT Id, size, HorizontalValues, VerticalValues, Field, NBoat1, NBoat2, NBoat3, NBoat4, NBoat5 FROM maps WHERE difficulty = :diff";//La requete SQL SELECT
                $req = $conn->prepare($reqPrep);//Préparer la requete
                $req->execute(array(':diff' => $diff));//Executer la requete
                
                $resultat = $req->fetchAll(PDO::FETCH_ASSOC);//récupérer le résultat
                
                $nb = count($resultat) - 1;
                
                $choosen = rand(0, $nb); // on choisi une carte aleatoirement
                $i = 0;
                foreach ($resultat as $ligne){ // on vient attribuer les valeurs correspondant a celles de la cartes aux variables
                    if($i == $choosen){
                        foreach ($ligne as $element => $valeur){
                            
                            if($element == "Id")
                                $mapid = $valeur;
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
                        $i++;
                    }
                    $_SESSION["difficulty"] = $diff;
                    
    ?>
    
    
    <div id="hautgame">
        <?php 
        if($_SESSION['chrono']==='yes'){
        ?>
        <!--Chronomètre-->
        <div id="timer"></div>
        <?php
        }
        ?>
    </div>

    <?php
         
        echo "<div class='contentpage'>";
        echo "You must find these boats. Good luck !<br><br>";
        if($NBoat1>0){
            echo "<div class='divimages'><p class='pimage'>$NBoat1 x</p> <img class='imgcontent' src='images/smallBoat.png'><br></div><br>";
        }
        if($NBoat2>0){
            echo "<div class='divimages'><p class='pimage'>$NBoat2 x</p><img class='imgcontent' src='images/boat2.png'><br></div><br>";
        }
        if($NBoat3>0){
            echo "<div class='divimages'><p class='pimage'>$NBoat3 x</p><img class='imgcontent' src='images/boat3.png'><br></div><br>";
        }
        if($NBoat4>0){
            echo "<div class='divimages'><p class='pimage'>$NBoat4 x</p><img class='imgcontent' src='images/boat4.png'><br></div><br>";
        }
        if($NBoat5>0){
            echo "<div class='divimages'><p class='pimage'>$NBoat5 x</p><img class='imgcontent' src='images/boat5.png'></div><br>";
        }

        echo "</div>";
    ?>


    <script>
        // variables necessaires au fonctionnement des focntions plus bas
        // récupées depuis les variables php intiialisées plsu haut
        var Boat1 = <?php echo json_encode($NBoat1); ?>;
        var Boat2 = <?php echo json_encode($NBoat2); ?>;
        var Boat3 = <?php echo json_encode($NBoat3); ?>;
        var Boat4 = <?php echo json_encode($NBoat4); ?>;
        var Boat5 = <?php echo json_encode($NBoat5); ?>;

        var size = <?php echo json_encode($size); ?>;
        var horizontalValues = <?php echo json_encode($horizontalValues); ?>;
        var verticalValues = <?php echo json_encode($verticalValues); ?>;
        var map = <?php echo json_encode($Field); ?>;

        var id = <?php echo json_encode($mapid); ?>;

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
    </script>


    <div class="contentpage">
        <table>
            <?php 
            $pos = 0;

            // on defini le tableau de jeu
            echo"<tr><th>   </th>";
            for($i = 0; $i < $size; $i++){
                echo"<th class='headerTh ".($i+1)."/0'><h2>".$verticalValues[2 * $i]."</h2></th>";
                
            }
            echo"</tr>";
            for($i = 0; $i < $size; $i++){
                echo"<tr><th class='headerTh 0/".($i+1)."'><h2>".$horizontalValues[2 * $i]."</h2></th>";
                for($j = 0; $j < $size; $j++){
                    echo"<td><button class='button' id='".($size*$i + $j)."' onclick=changeImage(".($size*$i + $j).")></button></td>";
                }
                echo"</tr>";
            }
            ?>
        </table>
    </div>
    <!--Boutons permettant à l'utilisateur d'agir sur la grille-->
    <div id="controlbuttons">
        <button id="clearbutton" onclick=resetgrid()>
            Reset
        </button>
        <button id="GiveUpButton" onclick=GiveUp()>
            Give Up
        </button>
    </div>
    <?php
            }
        }
    ?>
    

    <script>
         setImage();

        // appliquer la bonne image aux boutons
        function setImage(){
            for(var i = 0; i < size * size; i++){
                var buttons = document.getElementById(String(i));
                if(tab[i] == 0)
                    buttons.innerHTML = '<img src="images/empty.png" />';
                if(tab[i] == 1)
                    buttons.innerHTML = '<img src="images/waterLock.png" />';
                if(tab[i] == 2)
                    buttons.innerHTML = '<img src="images/smallBoatLock.png" />';
                if(tab[i] == 3)
                    buttons.innerHTML = '<img src="images/midLock.png" />';
                if(tab[i] == 4)
                    buttons.innerHTML = '<img src="images/frontBottomLock.png" />';
                if(tab[i] == 5)
                    buttons.innerHTML = '<img src="images/frontTopLock.png" />';
                if(tab[i] == 6)
                    buttons.innerHTML = '<img src="images/frontLeftLock.png" />';
                if(tab[i] == 7)
                    buttons.innerHTML = '<img src="images/frontRightLock.png" />';
            }
        }

        /* coorespondances valeurs - image : 
        0 : empty
        1 : water
        2 : smallBoat
        3 : mid
        4 : frontBottom
        5 : frontTop
        6 : frontLeft
        7 : frontRight */

        //fonction qui change une image quand on clique dessus
        function changeImage(id){
            var buttons = document.getElementById(String(id));
            if(map[2 * id] > 1)
                    return;
            if(tab[id] > 1){
                tab[id] = 0;
                if(id >= size && tab[id - size] > 1 && map[2 * (id - size)] <= 1)
                    tab[id - size] = chooseImage(id - size);
                //si pas en bas
                if((id + size) <= (size * size) && tab[id + size] > 1 && map[2 * (id + size)] <= 1)
                    tab[id + size] = chooseImage(id + size);
                //si pas a gauche
                if((id % size) != 0 && tab[id - 1] > 1 && map[2 * (id - 1)] <= 1)
                    tab[id - 1] = chooseImage(id - 1);
                //si pas a droite
                if((id % size) != (size - 1) && tab[id + 1] > 1 && map[2 * (id + 1)] <= 1)
                    tab[id +1] = chooseImage(id + 1);
            }else
                tab[id]++;

            if(tab[id] == 0)
                buttons.innerHTML = '<img src="images/empty.png" />';
            if(tab[id] == 1)
                buttons.innerHTML = '<img src="images/water.png" />';
            if(tab[id] > 1){
                tab[id] = chooseImage(id);
                // si pas en haut
                if(id >= size && tab[id - size] > 1 && map[2 * (id - size)] <= 1)
                    tab[id - size] = chooseImage(id - size);
                //si pas en bas
                if((id + size) <= (size * size) && tab[id + size] > 1 && map[2 * (id + size)] <= 1)
                    tab[id + size] = chooseImage(id + size);
                //si pas a gauche
                if((id % size) != 0 && tab[id - 1] > 1 && map[2 * (id - 1)] <= 1)
                    tab[id - 1] = chooseImage(id - 1);
                //si a droite
                if((id % size) != (size - 1) && tab[id + 1] > 1 && map[2 * (id + 1)] <= 1)
                    tab[id + 1] = chooseImage(id + 1);
            }

            if (verifBoats() == 1 && verifGrid() == 1 && verifNotTouching() == 1) {
                gridSuccess();
            }
        }

        //focntion qui attribue la bonne valeur et image aux bateaux
        function chooseImage(id){
            var buttons = document.getElementById(String(id));
            // si en haut a gauche
            if((id % size) == 0 && id < size){ 
                if(tab[id + 1] > 1){
                    buttons.innerHTML = '<img src="images/frontLeft.png" />';
                    return 6;
                }
                else {
                    if(tab[id + size] > 1){
                        buttons.innerHTML = '<img src="images/frontTop.png" />';
                        return 5;
                    }
                    else{
                        buttons.innerHTML = '<img src="images/smallBoat.png" />';
                        return 2;
                    }
                }
            }
            // si en haut a droite
            if((id % size) == (size - 1) && id < size){ 
                if(tab[id - 1] > 1){
                    buttons.innerHTML = '<img src="images/frontRight.png" />';
                    return 7;
                }
                else {
                    if(tab[id + size] > 1){
                        buttons.innerHTML = '<img src="images/frontTop.png" />';
                        return 5;
                    }
                    else{
                        buttons.innerHTML = '<img src="images/smallBoat.png" />';
                        return 2;
                    }
                }
            }
            // si en bas a droite
            if((id % size) == (size - 1) && (id + size) > (size * size)){ 
                if(tab[id - 1] > 1){
                    buttons.innerHTML = '<img src="images/frontRight.png" />';
                    return 7;
                }
                else {
                    if(tab[id - size] > 1){
                        buttons.innerHTML = '<img src="images/frontBottom.png" />';
                        return 4;
                    }
                    else{
                        buttons.innerHTML = '<img src="images/smallBoat.png" />';
                        return 2;
                    }
                }
            }
            // si en bas a gauche
            if((id % size) == 0 && (id + size) > (size * size - 1)){ 
                if(tab[id + 1] > 1){
                    buttons.innerHTML = '<img src="images/frontLeft.png" />';
                    return 6;
                }
                else {
                    if(tab[id - size] > 1){
                        buttons.innerHTML = '<img src="images/frontBottom.png" />';
                        return 4;
                    }
                    else{
                        buttons.innerHTML = '<img src="images/smallBoat.png" />';
                        return 2;
                    }
                }
            }
            // si en haut
            if(id < size){
                if(tab[id + size] > 1){
                    buttons.innerHTML = '<img src="images/frontTop.png" />';
                    return(5);
                }
                else{
                    if(tab[id + 1] > 1 && tab[id - 1] > 1){
                        buttons.innerHTML = '<img src="images/mid.png" />';
                        return(3);
                    }
                    else{
                        if(tab[id + 1] > 1){
                            buttons.innerHTML = '<img src="images/frontLeft.png" />';
                            return(6);
                        }
                        else{
                            if(tab[id - 1] > 1){
                                buttons.innerHTML = '<img src="images/frontRight.png" />';
                                return(7);
                            }
                            else{
                                buttons.innerHTML = '<img src="images/smallBoat.png" />';
                                return(2);
                            }
                        }                        
                    }
                }
            }
            //si en bas
            if((id + size) > (size * size - 1)){
                if(tab[id - size] > 1){
                    buttons.innerHTML = '<img src="images/frontBottom.png" />';
                    return(4);
                }
                else{
                    if(tab[id + 1] > 1 && tab[id - 1] > 1){
                        buttons.innerHTML = '<img src="images/mid.png" />';
                        return(3);
                    }
                    else{
                        if(tab[id + 1] > 1){
                            buttons.innerHTML = '<img src="images/frontLeft.png" />';
                            return(6);
                        }
                        else{
                            if(tab[id - 1] > 1){
                                buttons.innerHTML = '<img src="images/frontRight.png" />';
                                return(7);
                            }
                            else{
                                buttons.innerHTML = '<img src="images/smallBoat.png" />';
                                return(2);
                            }
                        }                        
                    }
                }
            }
            //si a gauche
            if((id % size) == 0){
                if(tab[id + 1] > 1){
                    buttons.innerHTML = '<img src="images/frontLeft.png" />';
                    return(6);
                }
                else{
                    if(tab[id + size] > 1 && tab[id - size] > 1){
                        buttons.innerHTML = '<img src="images/mid.png" />';
                        return(3);
                    }
                    else{
                        if(tab[id + size] > 1){
                            buttons.innerHTML = '<img src="images/frontTop.png" />';
                            return(6);
                        }
                        else{
                            if(tab[id - size] > 1){
                                buttons.innerHTML = '<img src="images/frontBottom.png" />';
                                return(7);
                            }
                            else{
                                buttons.innerHTML = '<img src="images/smallBoat.png" />';
                                return(2);
                            }
                        }                        
                    }
                }
            }
            //si a droite
            if((id % size) == (size - 1)){
                if(tab[id - 1] > 1){
                    buttons.innerHTML = '<img src="images/frontRight.png" />';
                    return(7);
                }
                else{
                    if(tab[id + size] > 1 && tab[id - size] > 1){
                        buttons.innerHTML = '<img src="images/mid.png" />';
                        return(3);
                    }
                    else{
                        if(tab[id + size] > 1){
                            buttons.innerHTML = '<img src="images/frontTop.png" />';
                            return(6);
                        }
                        else{
                            if(tab[id - size] > 1){
                                buttons.innerHTML = '<img src="images/frontBottom.png" />';
                                return(7);
                            }
                            else{
                                buttons.innerHTML = '<img src="images/smallBoat.png" />';
                                return(2);
                            }
                        }                        
                    }
                }
            }
            //sinon
            if(tab[id + 1] > 1 && tab[id - 1] > 1){
                buttons.innerHTML = '<img src="images/mid.png" />';
                return(3);
            }
            else{
                if(tab[id + size] > 1 && tab[id - size] > 1){
                    buttons.innerHTML = '<img src="images/mid.png" />';
                    return(3);
                }
                else{
                    if(tab[id + 1] > 1){
                        buttons.innerHTML = '<img src="images/frontLeft.png" />';
                        return(6);
                    }
                    else{
                        if(tab[id - 1] > 1){
                            buttons.innerHTML = '<img src="images/frontRight.png" />';
                            return(7);
                        }
                        else{
                            if(tab[id - size] > 1){
                                buttons.innerHTML = '<img src="images/frontBottom.png" />';
                                return(4);
                            }
                            else{
                                if(tab[id + size] > 1){
                                    buttons.innerHTML = '<img src="images/frontTop.png" />';
                                    return(5);
                                }
                                else{
                                    buttons.innerHTML = '<img src="images/smallBoat.png" />';
                                    return(2);
                                }
                            }
                        }
                    }
                }
            }
        }

        // fonction qui verifie que chaques lignes contient le bon nombre de cases bateau
        function verifGrid(){
            var total = 0;
            for(var i = 0; i < size; i++){
                for(var j = 0; j < size; j++){
                    if(tab[j + size * i] > 1){
                        total++;
                    }
                }
                if(total != HValues[i] && i < 5)
                        return(0);
                total = 0;
            }
            for(var i = 0; i < size; i++){
                for(var j = 0; j < size; j++){
                    if(tab[i + size * j] > 1)
                        total++;
                }
                if(total != VValues[i] && i < 5)
                    return(0);
                total = 0;
            }
            return(1);
        }

        // fonction qui verifie que le bon nombre de chaques types de bateaux est présent
        function verifBoats(){
            //chaques bateaux suit un shema : tete, 0 1 ou plusieurs mid (qui depenedent de sa longueur) et queue, donc on compte le nombre de fois que ces shema apparaissent par taille et on verifie que ca corresponde
            var nbBoats = 0;
            // bateaux de longueur 5 en ligne
            for(var i = 0; i < size; i++){
                for(var j = 0; j < size - 4; j++){
                    if(tab[j + size * i] == 6 && tab[j + size * i + 1] == 3 && tab[j + size * i + 2] == 3 && tab[j + size * i + 3] == 3 && tab[j + size * i + 4] == 7)
                        nbBoats++;
                }
            }
            // bateaux de longueur 5 en colonne
            for(var i = 0; i < size - 4; i++){
                for(var j = 0; j < size; j++){
                    if(tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 3 && tab[j + size * (i + 2)] == 3 && tab[j + size * (i + 3)] == 3 && tab[j + size * (i + 4)] == 4)
                        nbBoats++;
                }
            }
            if(nbBoats != Boat5)
                return(0);
            nbBoats = 0;

            // bateaux de longueur 4 en ligne
            for(var i = 0; i < size; i++){
                for(var j = 0; j < size - 3; j++){
                    if(tab[j + size * i] == 6 && tab[j + size * i + 1] == 3 && tab[j + size * i + 2] == 3 && tab[j + size * i + 3] == 7)
                        nbBoats++;
                }
            }
            // bateaux de longueur 4 en colonne
            for(var i = 0; i < size - 3; i++){
                for(var j = 0; j < size; j++){
                    if(tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 3 && tab[j + size * (i + 2)] == 3 && tab[j + size * (i + 3)] == 4)
                        nbBoats++;
                }
            }
            if(nbBoats != Boat4)
                return(0);
            nbBoats = 0;

            // bateaux de longueur 3 en colonne
            for(var i = 0; i < size; i++){
                for(var j = 0; j < size - 2; j++){
                    if(tab[j + size * i] == 6 && tab[j + size * i + 1] == 3 && tab[j + size * i + 2] == 7)
                        nbBoats++;
                }
            }
            // bateaux de longueur 3 en colonne
            for(var i = 0; i < size - 2; i++){
                for(var j = 0; j < size; j++){
                    if(tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 3 && tab[j + size * (i + 2)] == 4)
                        nbBoats++;
                }
            }
            if(nbBoats != Boat3)
                return(0);
            nbBoats = 0;

            // bateaux de longueur 2 en ligne
            for(var i = 0; i < size; i++){
                for(var j = 0; j < size - 1; j++){
                    if(tab[j + size * i] == 6 && tab[j + size * i + 1] == 7)
                        nbBoats++;
                }
            }
            // bateaux de longueur 2 en colonne
            for(var i = 0; i < size - 1; i++){
                for(var j = 0; j < size; j++){
                    if(tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 4)
                        nbBoats++;
                }
            }
            if(nbBoats != Boat2)
                return(0);
            nbBoats = 0;

            // bateaux de longueur 1
            for(var i = 0; i < (size * size); i++){
                if(tab[i] == 2)
                    nbBoats++;
            }
            if(nbBoats != Boat1)
                return(0);

            return(1);
        }
        
        //fonction qui verifie que 2 bateaux ne se touchent pas
        function verifNotTouching(){
            // si 2 bateaux se touchent en diagonale, ce n'est pas bon donc on teste les diagonales de chaques bateaux
            for(var i = (size - 1); i < (size * (size - 1)); i++){
                if(tab[i] > 1){
                    if((i % size) != 0 && tab[i - 1 - size] && tab[i - 1 - size] > 1)
                        return 0;
                    if((i % size) != (size - 1) && tab[i + 1 - size] && tab[i + 1 - size] > 1)
                        return 0;
                    if((i % size) != 0 && tab[i - 1 + size] && tab[i - 1 + size] > 1)
                        return 0;
                    if((i % size) != (size - 1) && tab[i + 1 + size] && tab[i + 1 + size] > 1)
                        return 0;

                }
            }
            return 1;

        }


        // fonction appelée en cas de réussite
        function gridSuccess(){
            // on calcule le temps en secondes, defini la varaible de session mapid et redirige vers la page avec un argument get time
            time = heures * 3600 + minutes * 60 + secondes;
            <?php $_SESSION["mapId"] = $mapid; ?>
            window.location.href = "game.php?time="+time;
        }

        //Fonction permettant de nettoyer la grille afin de repartir à 0
        function resetgrid(){
            // on remet les valurs dans la grille a celle initiales et on remet les images correspondantes
            setMap();
            setImage(); 
        }

        function GiveUp(){
            window.location.href = "GiveUp.php";
        }

        //Implémentation du chronomètre
        let heures=0;
        let minutes=0;
        let secondes=0;

        function fonctiontimer(){

            //let timertext=`Time : ${heures}:${minutes}:${secondes}`;

            let affsec=`${secondes}`;
            let affmin=`${minutes}`;
            let affheure=`${heures}`;

            if(secondes>59){
                secondes=secondes%60;
                minutes++;
            }
            if(minutes>59){
                minutes=minutes%60;
                heures++;
            }

            if(secondes<10){
                affsec=`0${secondes}`;
            }
            if(minutes<10){
                affmin=`0${minutes}`;
            }
            if(heures<10){
                affheure=`0${heures}`;
            }
            

            let timertext=`Time : `+affheure+`:`+affmin+`:`+affsec;

            let divtimer=document.getElementById("timer");        
            divtimer.innerHTML=timertext;
            secondes++;
        }

        
        <?php
        if($_SESSION['chrono']==='yes'){
        ?>
            fonctiontimer();
            let chrono=setInterval(fonctiontimer,1000);
        
            //Bouton qui arrête le chronomètre
            let buttonstop=document.getElementById("stopbutton");

            
        <?php
        }
        else
            $time = -1;
        ?>
        

        /*Procédure pour résoudre un niveau :
        - Parcourir chaque chiffre sur les ligne / colonne à la recherche de zéros
            --> Si il y a des zéros, mettre de la mer sur chaque case de la ligne/colonne correspondante
        
        - Mettre la mer autour de chaque bateau fini
        
        - Parcourir chaque ligne / colonnes pour savoir quelles sont les cases disponibles pour placer les bateaux restants
            --> Si uniquement il n'y a qu'une possibilité pour placer une case de bateau, la placer
        
        [Répéter jusqu'à ce qui'il n'y ait plus de case libre]
        
        */

        

    </script>
</body>
<?php
    require("../pageparts/footer.php");
?>

</html>
