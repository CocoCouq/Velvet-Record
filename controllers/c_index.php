<?php
    $requete = 'SELECT * FROM disc JOIN artist ON disc.artist_id = artist.artist_id ORDER BY disc_id DESC LIMIT 3';
    $result = $db->prepare($requete);
    $result->execute();
    $tableau = $result->fetchAll();
    $result->closeCursor();
    
    
?>
