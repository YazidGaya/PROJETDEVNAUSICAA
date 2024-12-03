<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="2;URL=../page/index.php">
    <title>Fail</title>
</head>
<?php
    //Barre de navigation
    require("../pageparts/nav.php");
?>
<body>
    <!--Cette page permet d'afficher un message à l'utilisateur en cas d'une saisie d'informations incorrecte-->
    <div>
        <h1>
            <?php 
            $err = "";
            if(isset($_GET["err"]))
                $err = $_GET["err"];
            if($err == "falsePsdPswd"){
                echo "Incorrect name or password.";
            } else {
                if($err == "pseudoUsed") {
                    echo "this name is already Used, please chose an other.";
                } else {
                    if($err == "falsePswd"){
                        echo "Both passwords are different.";
                    } else {
                        if($err == "disagree")
                            echo "You have to accept the terms & conditions.";
                    }
                }
            }
            
            ?>
        </h1>
    </div>
</body>
<?php
    require("../pageparts/footer.php");
?>
</html>
