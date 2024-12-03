<?php	
	
	//Connexion à la base de données

	$servername = 'localhost';
	$dbname = 'nausicaa';
	$username = 'root';
	$password = 'root';
	
	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {
		echo "La connexion a échoué : " . $e->getMessage();
	}
?>