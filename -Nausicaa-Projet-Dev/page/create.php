<!DOCTYPE html>
<html lang="en">
<head>
    <title>Level Creator</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="levelcreator.js" defer></script>
</head>
<?php
    //Barre de navigation
    require("../pageparts/nav.php");
?>


<body>
    <h2>LEVEL CREATOR</h2>

    <div class="contentpage">
    Hello sailor, welcome to the training session, here you create your own grids. Useful for training your sharp eye.  So you can eliminate your enemies quickly and efficiently.
    </div>

    <?php
    if(!isset($_POST['confirm'])){
    ?>
    <div class='contentpage'>
        
        <form method='post' action='create.php'>

            <label>Size :</label>
            <select name='levelsize' id='difficultyselector'>
                <option value='0'>--Please select an option--</option>
                <option value='6'>6x6</option>
                <option value='8'>8x8</option>
                <option value='10'>10x10</option>
            </select>

            <br><br>
            <input type='submit' value='Submit' name='confirm'></input>

            
        </form>
    </div>
    <?php
    }

    else{
    ?>

    <script>
        // variables necessaires au fonctionnement des focntions plus bas
        // seront recupérées depuis la base de données
        var Boat1 = 2
        var Boat2 = 0
        var Boat3 = 1
        var Boat4 = 1
        var Boat5 = 0

        <?php 
        
        
        
        if(isset($_POST['levelsize'])){
                if($_POST['levelsize']==='0'){
                    header('Location:create.php');
                }
                if($_POST['levelsize']==='6'){
                    $size=6;
                    $horizontalValues = "0/0/0/0/0/0";
                    $verticalValues = "0/0/0/0/0/0";
                    $map=$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues;
                }
                if($_POST['levelsize']==='8'){
                    $size=8;
                    $horizontalValues = "0/0/0/0/0/0/0/0";
                    $verticalValues = "0/0/0/0/0/0/0/0";
                    $map=$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues;
                }
                if($_POST['levelsize']==='10'){
                    $size=10;
                    $horizontalValues = "0/0/0/0/0/0/0/0/0/0";
                    $verticalValues = "0/0/0/0/0/0/0/0/0/0";
                    $map=$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues;
                }
                if($_POST['levelsize']==='15'){
                    $size=15;
                    $horizontalValues = "0/0/0/0/0/0/0/0/0/0/0/0/0/0/0";
                    $verticalValues = "0/0/0/0/0/0/0/0/0/0/0/0/0/0/0";
                    $map=$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues;
                }
            }
            
            ?>

        var size = <?php echo json_encode($size); ?>;
        
        var horizontalValues;
        var verticalValues;
        var map;

        if(size===6){
            horizontalValues = "0/0/0/0/0/0";
            verticalValues = "0/0/0/0/0/0";
            map = "0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0";
        }
        if(size===8){
            horizontalValues = "0/0/0/0/0/0/0/0";
            verticalValues = "0/0/0/0/0/0/0/0";
            map="0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0";
        }
        if(size===10){
            horizontalValues = "0/0/0/0/0/0/0/0/0/0";
            verticalValues = "0/0/0/0/0/0/0/0/0/0";
            map="0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0";
        }
        if(size===15){
            horizontalValues = "0/0/0/0/0/0/0/0/0/0/0/0/0/0/0";
            verticalValues = "0/0/0/0/0/0/0/0/0/0/0/0/0/0/0";
            map="0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0";
        }

        if(size>=10){
            //////////////////////////////////////////////Diminuer la taille des boutons
            


            ////////////////////////////////////////////:
        }


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
                

                if(isset($_POST['levelsize'])){
                    if($_POST['levelsize']==='0'){
                        header('Location:create.php');
                    }
                    if($_POST['levelsize']==='6'){
                        $size=6;
                        $horizontalValues = "0/0/0/0/0/0";
                        $verticalValues = "0/0/0/0/0/0";
                        $map=$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues;
                    }
                    if($_POST['levelsize']==='8'){
                        $size=8;
                        $horizontalValues = "0/0/0/0/0/0/0/0";
                        $verticalValues = "0/0/0/0/0/0/0/0";
                        $map=$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues;
                    }
                    if($_POST['levelsize']==='10'){
                        $size=10;
                        $horizontalValues = "0/0/0/0/0/0/0/0/0/0";
                        $verticalValues = "0/0/0/0/0/0/0/0/0/0";
                        $map=$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues;
                    }
                    if($_POST['levelsize']==='15'){
                        $size=15;
                        $horizontalValues = "0/0/0/0/0/0/0/0/0/0/0/0/0/0/0";
                        $verticalValues = "0/0/0/0/0/0/0/0/0/0/0/0/0/0/0";
                        $map=$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues."!".$horizontalValues;
                    }
                }
                $pos = 0;

            echo"<tr><th id='ThVide'></th>";
            for($i = 0; $i < $size; $i++){
                echo"<th id='thcol".($i+1)."' class='thgame'><h2>".$verticalValues[2 * $i]."</h2></th>";
                
            }
            echo"</tr>";
            for($i = 0; $i < $size; $i++){
                echo"<tr><th id='thln".($i+1)."' class='thgame'><h2>".$horizontalValues[2 * $i]."</h2></th>";
                for($j = 0; $j < $size; $j++){
                    echo"<td class='tdgame'><button class='button ln".($i+1)." col".($j+1)."' id='".($size*$i + $j)."' onclick=changeImage(".($size*$i + $j).")></button></td>";
                }
                echo"</tr>";
            }
            ?>
            
        </table>
    </div>
    <!--Boutons permettant à l'utilisateur d'agir sur la grille-->
    <div id="controlbuttons">
        <button id="clearbutton" onclick=resetgridcreateversion()>
            Reset
        </button>
        
        
            <input type='submit' name='submit' value='Send' id='donebutton'></input>
            <?php
            $_SESSION['sizelevel']=$size;
            
            ?>


            
            <!--Définition des valeurs horizontales et verticales-->
            <script>
                
                /*
                //Valeurs horizontales
                if(size!=null && size>0){
                    var valhoriz1=document.querySelector("#thcol1");
                    var valhoriz2=document.querySelector("#thcol2");
                    var valhoriz3=document.querySelector("#thcol3");
                    var valhoriz4=document.querySelector("#thcol4");
                    var valhoriz5=document.querySelector("#thcol5");
                    var valhoriz6=document.querySelector("#thcol6");
                }
                if(size!=null && size>6){
                    var valhoriz7=document.querySelector("#thcol7");
                    var valhoriz8=document.querySelector("#thcol8");
                }
                if(size!=null && size>8){
                    var valhoriz9=document.querySelector("#thcol9");
                    var valhoriz10=document.querySelector("#thcol10");
                }
                if(size!=null && size>10){
                    var valhoriz11=document.querySelector("#thcol11");
                    var valhoriz12=document.querySelector("#thcol12");
                    var valhoriz13=document.querySelector("#thcol13");
                    var valhoriz14=document.querySelector("#thcol14");
                    var valhoriz15=document.querySelector("#thcol15");
                }
                if(size!=null && size>0){
                    var valvert1=document.querySelector("#thln1");
                    var valvert2=document.querySelector("#thln2");
                    var valvert3=document.querySelector("#thln3");
                    var valvert4=document.querySelector("#thln4");
                    var valvert5=document.querySelector("#thln5");
                    var valvert6=document.querySelector("#thln6");
                }
                if(size!=null && size>6){
                    var valvert7=document.querySelector("#thln7");
                    var valvert8=document.querySelector("#thln8");
                }
                if(size!=null && size>8){
                    var valvert9=document.querySelector("#thln9");
                    var valvert10=document.querySelector("#thln10");
                }
                if(size!=null && size>10){
                    var valvert11=document.querySelector("#thln11");
                    var valvert12=document.querySelector("#thln12");
                    var valvert13=document.querySelector("#thln13");
                    var valvert14=document.querySelector("#thln14");
                    var valvert15=document.querySelector("#thln15");
                }
                */
                
                

            </script>

            <?php
                // Récupération des données JSON envoyées par fetch
                $inputJSON = file_get_contents('php://input');
                $input = json_decode($inputJSON, true);

            ?>
                                

    </div>
    

    <script>
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

        // fonciton qui verifie que le bon nombre de chaques types de abteaux est présent
        function verifBoats(){
            var nbBoats = 0;
            for(var i = 0; i < size; i++){
                for(var j = 0; j < size - 4; j++){
                    if(tab[j + size * i] == 6 && tab[j + size * i + 1] == 3 && tab[j + size * i + 2] == 3 && tab[j + size * i + 3] == 3 && tab[j + size * i + 4] == 7)
                        nbBoats++;
                }
            }
            
            for(var i = 0; i < size - 4; i++){
                for(var j = 0; j < size; j++){
                    if(tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 3 && tab[j + size * (i + 2)] == 3 && tab[j + size * (i + 3)] == 3 && tab[j + size * (i + 4)] == 4)
                        nbBoats++;
                }
            }
            if(nbBoats != Boat5)
                return(0);
            nbBoats = 0;

            for(var i = 0; i < size; i++){
                for(var j = 0; j < size - 3; j++){
                    if(tab[j + size * i] == 6 && tab[j + size * i + 1] == 3 && tab[j + size * i + 2] == 3 && tab[j + size * i + 3] == 7)
                        nbBoats++;
                }
            }
            
            for(var i = 0; i < size - 3; i++){
                for(var j = 0; j < size; j++){
                    if(tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 3 && tab[j + size * (i + 2)] == 3 && tab[j + size * (i + 3)] == 4)
                        nbBoats++;
                }
            }
            if(nbBoats != Boat4)
                return(0);
            nbBoats = 0;

            for(var i = 0; i < size; i++){
                for(var j = 0; j < size - 2; j++){
                    if(tab[j + size * i] == 6 && tab[j + size * i + 1] == 3 && tab[j + size * i + 2] == 7)
                        nbBoats++;
                }
            }
            
            for(var i = 0; i < size - 2; i++){
                for(var j = 0; j < size; j++){
                    if(tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 3 && tab[j + size * (i + 2)] == 4)
                        nbBoats++;
                }
            }
            if(nbBoats != Boat3)
                return(0);
            nbBoats = 0;

            for(var i = 0; i < size; i++){
                for(var j = 0; j < size - 1; j++){
                    if(tab[j + size * i] == 6 && tab[j + size * i + 1] == 7)
                        nbBoats++;
                }
            }
            
            for(var i = 0; i < size - 1; i++){
                for(var j = 0; j < size; j++){
                    if(tab[j + size * i] == 5 && tab[j + size * (i + 1)] == 4)
                        nbBoats++;
                }
            }
            if(nbBoats != Boat2)
                return(0);
            nbBoats = 0;

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
            resetgrid();
        }

        //Fonction permettant de nettoyer la grille afin de repartir à 0
        function resetgrid(){
            setMap();
            setImage(); 
        }

        function resetgridcreateversion(){
            setMap();
            setImage();
            self. location=self. location;
            valthln1=0;
            valthln2=0;
            valthln3=0;
            valthln4=0;
            valthln5=0;
            valthcol1=0;
            valthcol2=0;
            valthcol3=0;
            valthcol4=0;
            valthcol5=0;

            thln1.innerHTML=`<h2>${valthln1}</h2>`;
            thln2.innerHTML=`<h2>${valthln2}</h2>`;
            thln3.innerHTML=`<h2>${valthln3}</h2>`;
            thln4.innerHTML=`<h2>${valthln4}</h2>`;
            thln5.innerHTML=`<h2>${valthln5}</h2>`;
            thcol1.innerHTML=`<h2>${valthcol1}</h2>`;
            thcol2.innerHTML=`<h2>${valthcol2}</h2>`;
            thcol3.innerHTML=`<h2>${valthcol3}</h2>`;
            thcol4.innerHTML=`<h2>${valthcol4}</h2>`;
            thcol5.innerHTML=`<h2>${valthcol5}</h2>`;

        }



    </script>
    <?php
    };
    ?>
</body>
<?php
    require("../pageparts/footer.php");
?>

</html>
