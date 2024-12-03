<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Battleships</title>
    <link rel="stylesheet" href="../style/style.css">
	<link rel="stylesheet" href="../style/style_stats.css">
</head>



<body>
	<?php
		require("../pageparts/nav.php");
		if($_SESSION["authentified"] != true || $_SESSION["admin"] == 0){ // si l'utilisateur n'est pas authentifié ou n'est pas admin
			header("Location:index.php");
		}
		?>
				
            <h2>Comptes</h2>

            <?php
				
			$reqPrep="SELECT Id, Email, Username, Admin FROM users";//La requete SQL SELECT
			$req = $conn->prepare($reqPrep);//Préparer la requete
            $req->execute();//Executer la requete
				
			$resultat = $req->fetchAll(PDO::FETCH_ASSOC);//récupérer le résultat
				
			//Affichage sous forme d'un tableau
			echo "<table>
			<tr>
			<th>Id</th>
			<th>Email</th>
			<th>Username</th>
			<th>Admin</th>
			<th colspan=2>Actions</th>
			</tr>";
			$id = 0;
			$nb = 0;
			foreach ($resultat as $ligne){
				echo "<tr>";
				foreach ($ligne as $element => $valeur){
                    if($element == "Admin"){
                        if($valeur == 1)
                        echo "<td>yes</td>";
                    else echo "<td>no</td>";
                    }
					else echo "<td>$valeur</td>";
					if($nb == 0){
						$id = $valeur;
					}
					$nb++;
				}
				$nb = 0;
							
				if($valeur == 0 )
                    echo "<td><a href='edit.php?id=$id&admin=no'>Promote</a></td>";
                else
                    echo "<td><a href='edit.php?id=$id&admin=yes'>Demote</a></td>";
				echo "<td><a href='delete.php?id=$id&type=user'>Delete</a></td>";
				echo "</tr>";
			}
			echo "</table>";
			?>
				
            <h2>Maps</h2>

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
			<th>Delete</th>
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

				echo "<td><a href='delete.php?id=$id&type=map'>Delete</a></td>";
				echo "</tr>";
			}
			echo "</table>";
				
			$conn= NULL;// On ferme la connexion	?>
</body>
<?php
    require("../pageparts/footer.php");
?>

</html>