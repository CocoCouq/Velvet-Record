<?php 
    $requete = $db->query("SELECT * FROM artist");
    $tableau = $requete->fetchAll();
    $requete->closeCursor(); 
?>
