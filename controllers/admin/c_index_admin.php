<?php
    include '../../controllers/lib/library.php';
    require_once '../../models/m_admin.php';
    
    // Liste des utilisateurs 
    $admin = new Admin();
    $tableau = $admin->select_all_users();
    
    // Count Admin/Users
    function count_role($role)
    {
        $admin = new Admin();
        return $admin->count_users($role);
    }
    
    // Récupération du nombre de visites 
    function aff_visite($file)
    {
        // Simplement besoin de lire le fichier
        $file_open = fopen($file, 'r');
        $nbr = fgets($file_open);
        fclose($file_open);
        return $nbr;
    }
?>
