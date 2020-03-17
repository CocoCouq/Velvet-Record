<?php 
    include '../../controllers/lib/library.php';
    require_once '../../models/m_disc.php';
    
    $disc = new Disc();
    $table = $disc->disc_details();
    $count_disque = count($table);
?>
