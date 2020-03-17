<?php
    include '../../controllers/lib/library.php';
    require_once '../../models/m_artist.php';
    
// Selection des artistes pas ordre Alphabétique 
    function art_ord_name()
    {
        $artist = new Artist();
        $table = $artist->details_artist();
        return $table;
    }
    
// Suppression de l'artiste en transaction   
    function del_art()
    {
        $idArt = sanitize_int($_POST['hiddenID']);
        
        $artist = new Artist();
        $artist->del_artist($idArt);
    }

?>