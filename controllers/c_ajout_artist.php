<?php 
    $name = htmlspecialchars($_POST['Artist']);
    
    $requete = "INSERT INTO artist(artist_name) VALUE (:name)";
    $result = $db->prepare($requete);
    $result->bindValue(':name', $name);
    $result->execute();
?>
