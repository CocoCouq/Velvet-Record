<?php
    include '../../controllers/lib/library.php';
    require_once '../../models/m_admin.php';
    
    // Liste des utilisateurs : En priorité, les utlisateurs, ensuite admins
    $admin = new Admin();
    $tableau = $admin->select_all_users();
    
    // Count Admin/Users
    function count_role($role)
    {
        $admin = new Admin();
        return $admin->count_users($role);
    }
    
    function aff_visite($file)
    {
        $file_open = fopen($file, 'r');
        $nbr = fgets($file_open);
        fclose($file_open);
        return $nbr;
    }
?>
