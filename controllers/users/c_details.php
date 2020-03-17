<?php 
    include '../../controllers/lib/library.php';
    require_once '../../models/m_disc.php';

    // Recuperation des valeurs 
    $id = sanitize_int($_GET['disc_id']);
    // Je récupére le nom de l'artiste dans l'url 
    $artist = htmlspecialchars($_GET['artist_name']);
    
    // Je reccupère simplement la table disc
    $disc = new Disc();
    $row = $disc->disc_artist($id);
    $count_disque = count($row);
    
?>