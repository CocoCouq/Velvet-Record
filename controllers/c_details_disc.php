<?php  
    $disc = htmlspecialchars($_GET['hiddenDisc']);
    
    $requete = 'SELECT * FROM disc WHERE disc_id = :disc';
    $result = $db->prepare($requete);
    $result->bindValue(':disc', $disc);
    $result->execute();
    $row = $result->fetch();
    $result->closeCursor();
?>
