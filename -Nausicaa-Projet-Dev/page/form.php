<?php
session_start();
// Connexion à la base de données
require("database.php");

function wash($donnees) {
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = strip_tags($donnees);
    return $donnees;
}

function validerEmail($email){
    $pattern = '/^[a-z.-]+@[a-z.]/';
    if(preg_match($pattern, $email))
        return(TRUE);
    return(FALSE);
}

function validerPseudoMdp($pseudoMdp){
    if(strlen($pseudoMdp) <= 40 && strlen($pseudoMdp) >= 3){
        return TRUE;
    }
    return FALSE;
}

if(isset($_POST['Submit'])) {                            //Création d'un compte
    $username = wash($_POST['Username']);

    // Vérifier si le pseudo est déjà utilisé
    $query = $conn->prepare("SELECT COUNT(*) FROM users WHERE Username = :username"); 
    $query->bindParam(':username', $username); 
    $query->execute(); 
    $count = $query->fetchColumn();

    if($count > 0) {
        // Afficher un message d'erreur si le pseudo est déjà utilisé
        header('Location: fail.php?err=pseudoUsed');
    } else {
        // Insérer les données dans la base de données si le pseudo n'est pas déjà utilisé
        $email = wash($_POST['Email']);
        $password = wash($_POST['Password']);
        if(validerPseudoMdp($username) == FALSE || validerPseudoMdp($password) == FALSE || validerEmail($email) == FALSE || $password != wash($_POST['ConfirmPassword'])) {
            header('Location: fail.php?err=falsePsdPswd');
            exit();
        }
        else{
            if($_POST['Agree'] != TRUE){
            header('Location: fail.php?err=disagree');
            exit();
        }
        }

        $sql = $conn->prepare("INSERT INTO `users`(`Username`,`Email`, `Password`) 
                              VALUES (:psd, :mail, :mdp)" );
        $sql->execute(array(
            ':psd' => $username,
            ':mail' => $email,
            ':mdp' => $password
        ));

        $query = $conn->prepare("SELECT NumberOfPlayers FROM statistics"); 
        $query->execute(); 
        $res = $query->fetch();
        $count = $res['NumberOfPlayers'] + 1;
        $query = $conn->prepare("UPDATE `statistics` SET `NumberOfPlayers`= :val"); 
        $query->execute(array(':val' => $count)); 
        header('Location: login.php');
    }
}

if(isset($_POST['Connect'])) {                          //Connexion à un compte
    $username = wash($_POST['Username']);
    $password = wash($_POST['Password']);
 // Vérifier si le pseudo et le mot de passe correspondent et si c'est un compte utilisateur ou admin
 // vérifier la variable admin 1 si c'est un admin 0 si c'est un utilisateur
    $result = $conn->prepare('SELECT * FROM users where Username = ? AND Password = ? ');
    $result->execute(array($username, $password));
    if(validerPseudoMdp($username) == TRUE && validerPseudoMdp($password) == TRUE && $result->rowCount() > 0) {
        $_SESSION['Username'] = $username;
        $_SESSION['Password'] = $password;
        $result = $conn->prepare('SELECT Admin FROM users where Username = ? AND Password = ? ');
        $result->execute(array($username, $password));
        $admin = $result->fetchColumn();
        $result = $conn->prepare('SELECT Id FROM users where Username = ? AND Password = ? ');
        $result->execute(array($username, $password));
        $id = $result->fetchColumn();
        $_SESSION['id'] = $id;
        $_SESSION['admin'] = $admin;
        $_SESSION['authentified'] = true;
        if($_POST['Remember'] == true){
            setcookie("username", $username, time() + 365*24*3600);
            setcookie("password", $password, time() + 365*24*3600);
        }
        header('Location: index.php');
    } else {
        header('Location: fail.php?err=falsePsdPswd');
    }
}
?>