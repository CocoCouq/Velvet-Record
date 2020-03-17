<?php
    include '../../controllers/lib/library.php';
    require_once '../../models/m_users.php';

    function user_infos()
    {
        $id = sanitize_int($_SESSION['user_id']);
        $user = new User();
        $row = $user->user_details($id);
        
        return $row;
    }
?>