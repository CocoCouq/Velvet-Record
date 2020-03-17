<?php
    include 'controllers/lib/library.php';
    require_once 'models/m_disc.php';
    
    $disc = new Disc();
    $tableau = $disc->disc_last();
?>
