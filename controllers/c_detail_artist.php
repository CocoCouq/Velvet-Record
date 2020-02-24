<?php  
    $requete = 'SELECT * FROM artist ORDER BY artist_name';
    $result = $db->query($requete);
    $row_artiste = $result->fetchAll();
    $result->closeCursor();
?>


