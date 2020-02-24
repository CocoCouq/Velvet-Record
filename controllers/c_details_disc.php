<?php  

    $disc = htmlspecialchars($_REQUEST['hiddenDisc']);
    
    $requete = 'SELECT * FROM disc JOIN artist ON artist.artist_id = disc.artist_id WHERE disc_id = :disc';
    $result = $db->prepare($requete);
    $result->bindValue(':disc', $disc);
    $result->execute();
    $row = $result->fetch();
    $result->closeCursor();
?>
