<?php
    // Liste des utilisateurs : En priorité, les utlisateurs, ensuite admins
    $requete = 'SELECT * FROM user JOIN role ON user_role_id = role_id ORDER BY user_role_id DESC, user_id DESC';
    $result = $db->prepare($requete);
    $result->execute();
    $tableau = $result->fetchAll();
    $result->closeCursor();
    
    // Count Admin/Users
    function count_role($pdo, $role)
    {
        $requete = 'SELECT user_id FROM user WHERE user_role_id = '.$role;
        $result = $pdo->prepare($requete);
        $result->execute();
        $tab = $result->fetchAll();
        $result->closeCursor();
        return count($tab);
    }
    
    function aff_visite($file)
    {
        $file_open = fopen($file, 'r');
        $nbr = fgets($file_open);
        fclose($file_open);
        return $nbr;
    }
?>
