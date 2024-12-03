<!DOCTYPE html>
<html>
<head>
    <title>Battleships</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/style_stats.css">
    <script src="script.js" defer></script>
</head>
<?php
    //Barre de navigation
    require("../pageparts/nav.php");
    try{
        require("../connexion.php"); //on utilise le script de connexion              
        $reqPrep = "SELECT Time1,Time1Player,Time2,Time2Player,Time3,Time3Player FROM leaderboard WHERE Difficulty = 1";
        $req = $conn->prepare($reqPrep);//on prépare la requête
        $req->execute();//on éxecute

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC);

        $reqPrep2 = "SELECT Time1,Time1Player,Time2,Time2Player,Time3,Time3Player FROM leaderboard WHERE Difficulty = 2";
        $req2 = $conn->prepare($reqPrep2);//on prépare la requête
        $req2->execute();//on éxecute

        $resultat2 = $req2->fetchAll(PDO::FETCH_ASSOC);

        $reqPrep3 = "SELECT Time1,Time1Player,Time2,Time2Player,Time3,Time3Player FROM leaderboard WHERE Difficulty = 3";
        $req3 = $conn->prepare($reqPrep3);//on prépare la requête
        $req3->execute();//on éxecute

        $resultat3 = $req3->fetchAll(PDO::FETCH_ASSOC);

        $reqPrep4 = "SELECT NumberOfMaps,NumberOfPlayers,NumberOfPlayedGames,NumberGamesWon,TotalTimePlayed FROM statistics";
        $req4 = $conn->prepare($reqPrep4);
        $req4->execute();
        $resultat4 = $req4->fetchAll(PDO::FETCH_ASSOC);
        if(isset($_SESSION['id'])){
            $id = $_SESSION['id'];
            $reqPrep5 = "SELECT GamesWon,Admin FROM users WHERE Id = $id";
            $req5 = $conn->prepare($reqPrep5);//on prépare la requête
            $req5->execute();//on éxecute
            $resultat5 = $req5->fetchAll(PDO::FETCH_ASSOC);
    
            $reqPrep6 = "SELECT MapId,BestTime FROM mapsplayed WHERE PlayerId = $id";
            $req6 = $conn->prepare($reqPrep6);//on prépare la requête
            $req6->execute();//on éxecute
            $resultat6 = $req6->fetchAll(PDO::FETCH_ASSOC);
        }
        

    }                 
    catch(Exception $e){
        die("Erreur : " . $e->getMessage());
    }

    $reqPrep7 = "SELECT id FROM users";
    $req7 = $conn->prepare($reqPrep7);//on prépare la requête
    $req7->execute();//on éxecute
    $resultat7 = $req7->fetchAll(PDO::FETCH_ASSOC);
    $nbUsers = count($resultat7);

    $reqPrep8 = "SELECT id FROM maps";
    $req8 = $conn->prepare($reqPrep8);//on prépare la requête
    $req8->execute();//on éxecute
    $resultat8 = $req8->fetchAll(PDO::FETCH_ASSOC);
    $nbMap = count($resultat8);
?>
<body>
<h2> STATISTICS </h2>

<section id="section_stats">
    <table id = "leaderboard" class = "tableau">
        <tr>
        <th colspan=3>Easy</th></tr>
        <tr>
        <td>1st</td>
        <td>
        <?php
        $h = intdiv($resultat[0]["Time1"], 3600);
        $mn = intdiv(($resultat[0]["Time1"] % 3600), 60);
        $s = ($resultat[0]["Time1"] % 3600) % 60;
        echo $h."h ".$mn."mn ".$s."s"
        ?>
        </td>
        <td><?php
        echo $resultat[0]["Time1Player"];
        ?></td>
        </tr> 
        <tr>
        <td>2nd</td>
        <td><?php
        $h = intdiv($resultat[0]["Time2"], 3600);
        $mn = intdiv(($resultat[0]["Time2"] % 3600), 60);
        $s = ($resultat[0]["Time2"] % 3600) % 60;
        echo $h."h ".$mn."mn ".$s."s"
        ?></td>
        <td><?php
        echo $resultat[0]["Time2Player"];
        ?></td>
        </tr>
        <tr>
        <td>3rd</td>
        <td><?php
        $h = intdiv($resultat[0]["Time3"], 3600);
        $mn = intdiv(($resultat[0]["Time3"] % 3600), 60);
        $s = ($resultat[0]["Time3"] % 3600) % 60;
        echo $h."h ".$mn."mn ".$s."s"
        ?></td>
        <td><?php
        echo $resultat[0]["Time3Player"];
        ?></td>
        </tr>
        <tr>
        <th colspan=3>Medium</th></tr>
        <tr>
        <td>1st</td>
        <td>
        <?php
        $h = intdiv($resultat2[0]["Time1"], 3600);
        $mn = intdiv(($resultat2[0]["Time1"] % 3600), 60);
        $s = ($resultat2[0]["Time1"] % 3600) % 60;
        echo $h."h ".$mn."mn ".$s."s"
        ?>
        </td>
        <td><?php
        echo $resultat2[0]["Time1Player"];
        ?></td>
        </tr> 
        <tr>
        <td>2nd</td>
        <td><?php
        $h = intdiv($resultat2[0]["Time2"], 3600);
        $mn = intdiv(($resultat2[0]["Time2"] % 3600), 60);
        $s = ($resultat2[0]["Time2"] % 3600) % 60;
        echo $h."h ".$mn."mn ".$s."s"
        ?></td>
        <td><?php
        echo $resultat2[0]["Time2Player"];
        ?></td>
        </tr>
        <tr>
        <td>3rd</td>
        <td><?php
        $h = intdiv($resultat2[0]["Time3"], 3600);
        $mn = intdiv(($resultat2[0]["Time3"] % 3600), 60);
        $s = ($resultat2[0]["Time3"] % 3600) % 60;
        echo $h."h ".$mn."mn ".$s."s"
        ?></td>
        <td><?php
        echo $resultat2[0]["Time3Player"];
        ?></td>
</tr>
<tr>
        <th colspan=3>Hard</th></tr>
        <tr>
        <td>1st</td>
        <td>
        <?php
        $h = intdiv($resultat3[0]["Time1"], 3600);
        $mn = intdiv(($resultat3[0]["Time1"] % 3600), 60);
        $s = ($resultat3[0]["Time1"] % 3600) % 60;
        echo $h."h ".$mn."mn ".$s."s"
        ?>
        </td>
        <td><?php
        echo $resultat3[0]["Time1Player"];
        ?></td>
        </tr> 
        <tr>
        <td>2nd</td>
        <td><?php
        $h = intdiv($resultat3[0]["Time2"], 3600);
        $mn = intdiv(($resultat3[0]["Time2"] % 3600), 60);
        $s = ($resultat3[0]["Time2"] % 3600) % 60;
        echo $h."h ".$mn."mn ".$s."s"
        ?></td>
        <td><?php
        echo $resultat3[0]["Time2Player"];
        ?></td>
        </tr>
        <tr>
        <td>3rd</td>
        <td><?php
        $h = intdiv($resultat3[0]["Time3"], 3600);
        $mn = intdiv(($resultat3[0]["Time3"] % 3600), 60);
        $s = ($resultat3[0]["Time3"] % 3600) % 60;
        echo $h."h ".$mn."mn ".$s."s"
        ?></td>
        <td><?php
        echo $resultat3[0]["Time3Player"];
        ?></td>
</tr>
    </table>

    <?php
    if(!isset($_SESSION['id'])){
        echo "<h3> Please login to access your stats.</h3>";
    }else{
    ?>
    <table id = "user_stats" class = "tableau">
        <tr>
        <th colspan=2> User Stats</th>
        <tr>
        <tr>
        <td>Games Won
        </td>
        <td>
        <?php
        echo $resultat5[0]['GamesWon']?>
        </td>
        </tr> 
        </td> 
        </tr> 
        <tr>
        <th>Map Id</th>
        <th>High Score </th></tr>
        <?php
        for($i = 0; $i < count($resultat6); $i++){
            $h = intdiv($resultat6[$i]["BestTime"], 3600);
            $mn = intdiv(($resultat6[$i]["BestTime"] % 3600), 60);
            $s = ($resultat6[$i]["BestTime"] % 3600) % 60;
            echo "<tr> <td>".$resultat6[$i]['MapId']."</td><td>".$h."h ".$mn."mn ".$s."s"."</td></tr>";
        }}
        ?>

    </table>
    <table id="global_stats" class = "tableau">
    <?php
        //On essaie d'obtenir le nombre de niveaux du jeu
        $req=$conn->prepare("SELECT * FROM maps");
        $req->execute();
        $resultmaps=$req->fetchAll(PDO::FETCH_ASSOC);

        
        foreach($resultmaps as $cle){
            
        }


    ?>
    <tr>
        <th colspan=2> Global Stats</th>
        <tr>
        <tr><td>Maps</td>
        <td>
        <?php echo $nbMap?>
        </td></tr> 
        <tr><td>Players</td>
        <td> <?php echo $nbUsers?>
        </td></tr> 
        <tr><td>Played Games</td>
        <td><?php echo $resultat4[0]["NumberOfPlayedGames"]?>
        </td></tr> 
        <tr><td>Won Games</td>
        <td><?php echo $resultat4[0]["NumberGamesWon"]?>
        </td></tr> 
        <tr><td>Total Played Time</td>
        <td><?php 
        $h = intdiv($resultat4[0]["TotalTimePlayed"], 3600);
        $mn = intdiv(($resultat4[0]["TotalTimePlayed"] % 3600), 60);
        $s = ($resultat4[0]["TotalTimePlayed"] % 3600) % 60;
        echo $h."h ".$mn."mn ".$s."s"
        ?>
        </td></tr> 
</table>
</section>
<?php
				
                $reqPrep="SELECT Id, Difficulty, Size, BestTime, BestTimeAuthor, PlayedTime FROM maps";//La requete SQL SELECT
                $req = $conn->prepare($reqPrep);//Préparer la requete
                $req->execute();//Executer la requete
                    
                $resultat = $req->fetchAll(PDO::FETCH_ASSOC);//récupérer le résultat
                    
                //Affichage sous forme d'un tableau
                echo "<table>
                <tr>
                <th>Id</th>
                <th>Difficulty</th>
                <th>Size</th>
                <th>Best Time</th>
                <th>Best Time Author</th>
                <th>Played Times</th>
                </tr>";
                $id = 0;
                $nb = 0;
                foreach ($resultat as $ligne){
                    echo "<tr>";
                    foreach ($ligne as $element => $valeur){
                        echo "<td>$valeur</td>";
                        if($nb == 0){
                            $id = $valeur;
                        }
                        $nb++;
                    }
                    $nb = 0;
    
                    echo "</tr>";
                }
                echo "</table>";
                ?>


<?php
    require("../pageparts/footer.php");
?>


</body>
