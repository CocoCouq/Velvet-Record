<?php
// Selection des artistes pas ordre Alphabétique 
    function art_ord_name($pdo)
    {
        $requete = $pdo->query("SELECT * FROM artist ORDER BY artist_name");
        $tableau = $requete->fetchAll();
        $requete->closeCursor();
        return $tableau;
    }
    
    
    function del_art($pdo)
    {
        $idArt = htmlspecialchars($_POST['hiddenID']);

        $requete_artist = 'DELETE disc, artist FROM disc LEFT JOIN artist ON artist.`artist_id` = disc.`artist_id` WHERE disc.artist_id =:idArtist';
        $result_artist = $pdo->prepare($requete_artist);
        $result_artist->bindValue(':idArtist', $idArt);
        $result_artist->execute();
        $result_artist->closeCursor();
    }
    
    /* Si utilisation de delete_cascade_artist.sql, remplacer la requete par : 
        'DELETE FROM artist WHERE artist_id =:idArtist' */
?>