<?php 
    $requete = $db->query("SELECT * FROM artist ORDER BY artist_name");
    $tableau = $requete->fetchAll();
    $requete->closeCursor(); 
?>
