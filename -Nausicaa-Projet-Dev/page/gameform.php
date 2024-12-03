<?php
session_start();

if($_POST['submit']!=NULL){
    //Récupération du choix pour le chronomètre
    if($_POST['chronochoice']!=NULL){
        if($_POST['chronochoice']==='yes'){
            $_SESSION['chrono']='yes';
        }
        else{
            $_SESSION['chrono']='no';
        }
    }


    //Récupération de la difficulté choisie par l'utilisateur
    if($_POST['difficulty']!=NULL){
        if($_POST['difficulty']==='easy'){
            header("Location:game.php?dif=1");
        }
        if($_POST['difficulty']==='medium'){
            header("Location:game.php?dif=2");
        }
        if($_POST['difficulty']==='hard'){
            header("Location:game.php?dif=3");
        }


    }

}


?>