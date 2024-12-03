<?php
	if($_SESSION["authentified"] != true || $_SESSION["admin"] == 0){ // si l'utilisateur n'est pas authentifié ou n'est pas admin
        header("Location:index.php");
    }
	if(isset($_GET["id"]) && isset($_GET["admin"])){
		try{
			require("database.php"); 

			$val = 0;
			if($_GET["admin"] == "no")
				$val = 1;
			$id = $_GET['id']; //on recupere l identifiant passe dans l url
			$reqPrep="UPDATE users SET admin = :val WHERE id = :id";//La requete SQL DELETES
			$req = $conn->prepare($reqPrep);//Préparer la requete
			$req->execute(array(
				':val' => $val,
				':id' => $id
			));
			
			header("Location:gestion.php");
		}                 
		catch(Exception $e){
			die("Erreur : " . $e->getMessage());
        }
	}
