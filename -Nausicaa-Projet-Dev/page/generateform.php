<?php
session_start();
require('../connexion.php');

if(isset($_POST['submit'])) {
    if(!empty($_POST['size']) && !empty($_POST['difficulty'])) {
        $size = $_POST['size'];
        $difficulty = $_POST['difficulty'];

        
        while(!isset($res) || empty($res) || $res == 0){
            $command = "..\\cFiles\\generateur\\générateur.exe $size $difficulty";
            $solution = shell_exec($command);
            if($size == 6){
                $nb1 = 3;
                $nb2 = 2;
                $nb3 = 1;
                $nb4 = 0;
                $nb5 = 0;
            }else if($size == 8){
                $nb5 = 0;
                $nb4 = 1;
                $nb3 = 2;
                $nb2 = 3;
                $nb1 = 3;
            }else if($size == 10){
                $nb5 = 0;
                $nb4 = 1;
                $nb3 = 2;
                $nb2 = 3;
                $nb1 = 4;
            }else if($size == 15){
                $nb5 = 1;
                $nb4 = 2;
                $nb3 = 3;
                $nb2 = 4;
                $nb1 = 5;
            }

            $parts = explode('#', $solution);
            $field = $parts[0];
            $hValues = $parts[1];
            $vValues = $parts[2];

            $commands = "..\cFiles\solveur\solveur.exe $size $hValues $vValues $field $nb1 $nb2 $nb3 $nb4 $nb5";
            $res = shell_exec("$commands");
        }
        



        // Inserting data into the database
        $reqprep = "INSERT INTO maps (Difficulty, Size, HorizontalValues, VerticalValues, Field, Author,BestTime,BestTimeAuthor,PlayedTime,NBoat1,NBoat2,NBoat3,NBoat4,Nboat5) 
                    VALUES (:difficulty, :size, :hvalues, :vvalues, :field, 'Auto',0,'Null',0,:nb1,:nb2,:nb3,:nb4,:nb5)";
        $req = $conn->prepare($reqprep);






        $req->execute(array(
            ':difficulty' => $difficulty,
            ':size' => $size,
            ':hvalues' => $hValues,
            ':vvalues' => $vValues,
            ':field' => $field,
            ':nb1'=> $nb1,
            ':nb2'=> $nb2,
            ':nb3'=> $nb3,
            ':nb4'=> $nb4,
            ':nb5'=> $nb5,

        ));

        // Retrieving the inserted map's ID
        $mapId = $conn->lastInsertId();

        $_SESSION['mapId'] = $mapId;

        // Redirect to game.php
        header("Location: game.php");
    }
}
?>


