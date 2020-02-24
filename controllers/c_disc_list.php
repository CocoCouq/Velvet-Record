<?php 

    $requete = 'SELECT * FROM disc JOIN artist ON artist.artist_id = disc.artist_id';
    $result = $db->query($requete);
    $table = $result->fetchAll();
    $result->closeCursor();
    $count_disque = count($table);
    
?>
