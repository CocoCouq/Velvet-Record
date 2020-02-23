<?php  
    $requete = 'SELECT * FROM artist';
    $result = $db->query($requete);
    $row_artiste = $result->fetchAll();
    $result->closeCursor();
?>


