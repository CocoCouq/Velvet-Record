<?php  
    // Recupération des artistes pour les options du select 
    $requete = 'SELECT * FROM artist ORDER BY artist_name';
    $result = $db->prepare($requete);
    $result->execute();
    $row_artiste = $result->fetchAll();
    $result->closeCursor();
?>
