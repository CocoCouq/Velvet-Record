<?php  
    include '../../controllers/lib/library.php';
    require_once '../../models/m_disc.php';
    
    $id = sanitize_int($_GET['disc_id']);
    
    $disc = new Disc();
    $row = $disc->disc_infos($id);
?>
