<?php 
    // Recuperation des valeurs 
    $id = sanitize_int($_GET['disc_id']);
    // Je récupére le nom de l'artiste dans l'url 
    $artist = htmlspecialchars($_GET['artist_name']);
    
    // Je reccupère simplement la table disc
    $requete = 'SELECT * FROM disc WHERE artist_id = :disc';
    $result = $db->prepare($requete);
    $result->bindValue(':disc', $id);
    $result->execute();
    $row = $result->fetchAll();
    $result->closeCursor();
    $count_disque = count($row);
    
?>