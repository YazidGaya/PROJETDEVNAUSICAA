<?php
    session_start();

    require('database.php');

    $size=$_SESSION['sizelevel'];
    $horizontalValues=$_GET['horizontalValues'];
    $verticalValues=$_GET['verticalValues'];

    $difficulty=1;/////////////////////////////////////////A modifier
    $field="";

    if($size===6){
        $field="0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0!0/0/0/0/0/0";
    }
    if($size===8){
        $field="0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0";
    }
    if($size===10){
        $field="0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0";
    }
    if($size===15){
        $field="0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0!0/0/0/0/0/0/0/0/0/0/0/0/0/0/0";
    }
    
    $author="test";
    $BestTime;
    $BestTimeAuthor;
    $PlayedTime=-1;
    $Nboat1=0;
    $Nboat2=0;
    $Nboat3=0;
    $Nboat4=0;
    $Nboat5=0;


    $req=$conn->prepare("INSERT INTO maps(Difficulty,size,HorizontalValues,VerticalValues,Field,author,BestTime,BestTimeAuthor,PlayedTime,NBoat1,NBoat2,NBoat3,NBoat4,NBoat5) VALUES (:diff, :taille, :hV, :vV, :field, :author, :BestTime,:BestTimeAuthor,:PlayedTime,:NBoat1,:NBoat2,:NBoat3,:NBoat4,:NBoat5)");
    $req->execute(array(':diff'=>$difficulty,':taille'=>$size,':hV'=>$horizontalValues,':vV'=>$verticalValues,':field'=>$field,':author'=>$author,':BestTime'=>0,':BestTimeAuthor'=>0,':PlayedTime'=>$PlayedTime,':NBoat1'=>$Nboat1,':NBoat2'=>$Nboat2,':NBoat3'=>$Nboat3,':NBoat4'=>$Nboat4,':NBoat5'=>$Nboat5));
    


    header('Location:create.php');
    
?>


