<?php  
    $idArt = htmlspecialchars($_POST['idArtist']);
    
    $requete_disc = 'DELETE FROM disc WHERE artist_id =:idArtist';
    $result_disc = $db->prepare($requete_disc);
    $result_disc->bindValue(':idArtist', $idArt);
    $result_disc->execute();
    $result_disc->closeCursor();
    
    $requete_artist = 'DELETE FROM artist WHERE artist_id =:idArtist';
    $result_artist = $db->prepare($requete_artist);
    $result_artist->bindValue(':idArtist', $idArt);
    $result_artist->execute();
    $result_artist->closeCursor();
?>
