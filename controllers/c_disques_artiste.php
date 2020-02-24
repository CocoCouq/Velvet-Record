<?php 
    $artist = htmlspecialchars($_GET['hiddenName']);
    $id = htmlspecialchars($_GET['hiddenID']);
    
    $requete = 'SELECT * FROM disc WHERE artist_id = :idDisc';
    $result = $db->prepare($requete);
    $result->bindValue(':idDisc', $id);
    $result->execute();
    $row = $result->fetchAll();
    $count_disque = count($row);
    $result->closeCursor();
    
?>
