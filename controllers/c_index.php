<?php
    include 'controllers/lib/library.php';
    require_once 'models/m_disc.php';
    
    session_auth('views/login/vue_login.php');
    
    $disc = new Disc();
    $tableau = $disc->disc_last();
?>
