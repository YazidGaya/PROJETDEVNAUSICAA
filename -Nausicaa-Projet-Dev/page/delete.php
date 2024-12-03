<?php

	//Ce fichier permet de supprimmer un utilisateur de la base de données

    if(!isset($_SESSION['authentified']) || $_SESSION["authentified"] != true || $_SESSION["admin"] == 0){ // si l'utilisateur n'est pas authentifié ou n'est pas admin
        header("Location:index.php");
    }

	if(isset($_GET["id"]) && isset($_GET["type"])){
		try{
			require("database.php"); 
			if($_GET["type"] == "user"){

				$reqPrep="DELETE FROM users WHERE id = :id";

				$id = $_GET['id']; //on recupere l identifiant passe dans l url
				$req = $conn->prepare($reqPrep);//Préparer la requete
				$req->execute(array(
					':id' => $id
				));
			}
			else{
				if($_GET["type"] == "map"){
					$reqPrep="DELETE FROM maps WHERE id = :id";

					$id = $_GET['id']; //on recupere l identifiant passe dans l url
					$req = $conn->prepare($reqPrep);//Préparer la requete
					$req->execute(array(
						':id' => $id
				));
				}
			}
			
			header("Location:gestion.php");
		}                 
		catch(Exception $e){
			die("Erreur : " . $e->getMessage());
        }
	}

?>