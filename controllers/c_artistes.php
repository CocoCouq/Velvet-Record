<?php
// Selection des artistes pas ordre Alphabétique 
    function art_ord_name($pdo)
    {
        $requete = $pdo->query("SELECT * FROM artist ORDER BY artist_name");
        $tableau_artiste = $requete->fetchAll();
        $requete->closeCursor();
        return $tableau_artiste;
    }
    
// Suppression de l'artiste en transaction   
    function del_art($pdo)
    {
        $idArt = sanitize_int($_POST['hiddenID']);
        
        try 
        {
            // Début de la transaction
            $transac = $pdo->prepare('START TRANSACTION');
            $transac->execute();
            $transac->closeCursor();
            
            // Suppression des CD-ROM de l'artiste
            $requete_cd = 'DELETE FROM disc WHERE artist_id =:idArtist';
            $result_cd = $pdo->prepare($requete_cd);
            $result_cd->bindValue(':idArtist', $idArt);
            $result_cd->execute();
            $result_cd->closeCursor();
            
            // Suppression de l'artiste 
            $requete_artist = 'DELETE FROM artist WHERE artist_id=:idArtist';
            $result_artist = $pdo->prepare($requete_artist);
            $result_artist->bindValue(':idArtist', $idArt);
            $result_artist->execute();
            $result_artist->closeCursor();
            
            // Commit si pas d'erreur avant (Donc pas d'exception)
            $transac = $pdo->prepare('COMMIT');
            $transac->execute();
            $transac->closeCursor();
        }
        catch (Exception $e)
        {
            // Si exception alors RollBack
            $transac = $pdo->prepare('ROLLBACK');
            $transac->execute();
            $transac->closeCursor();
            echo 'Artiste non supprimé : '.$e->getMessage();
        }
    }
    
    /* Si utilisation de delete_cascade_artist.sql, remplacer la requete par : 
        'DELETE FROM artist WHERE artist_id =:idArtist' */
?>