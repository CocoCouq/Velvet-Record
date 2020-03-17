<?php
    include '../../controllers/lib/library.php';
    require_once '../../models/m_users.php';
    
    $id = urldecode($_GET['id']);
    $key = urldecode($_GET['key']);
    
    $user = new User();
    $row = $user->selct_verif_user($id);
    
    $valid_key = (intval($row->user_key) == intval($key)) ? true : false;
    
    if($valid_key)
    {
        $user->verif_user($row->user_id);
        
        header('location:../../index.php');
    }
?>
