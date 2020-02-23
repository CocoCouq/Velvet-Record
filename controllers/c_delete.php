<?php 
    $id_disc = htmlspecialchars($_POST['hiddenDisc']);
        
    $requete = 'DELETE FROM disc WHERE disc_id =:id_disc';
    $result = $db->prepare($requete);
    $result->bindValue(':id_disc', $id_disc);
    $result->execute();
    $result->closeCursor();
?>
