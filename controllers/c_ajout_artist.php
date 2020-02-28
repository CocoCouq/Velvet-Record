<?php 
    $name = sanitize_str($_POST['Artist']);
    
    // Insertion d'un artiste et redirection 
    $requete = "INSERT INTO artist(artist_name) VALUE (:name)";
    $result = $db->prepare($requete);
    $result->bindValue(':name', $name);
    $result->execute();
    header('location:vue_artistes.php');
?>
