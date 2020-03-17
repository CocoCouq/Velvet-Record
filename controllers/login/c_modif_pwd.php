<?php 
    include '../../controllers/lib/library.php';
    require_once '../../models/m_users.php';

    if(!empty($_GET['id']) && !empty($_GET['key']))
    {
        $user = new User();
        $time = new DateTime();
        
        $id = sanitize_int($_GET['id']);
        $key = urldecode($_GET['key']);
        
        $key_db = $user->select_key($id);
        $bool_verif = ($key == $key_db) ? true : false;
        
        // Recupération du timestamp
        $i = 0;
        $len = strlen($key_db)-40;
        
        $time_key = substr($key_db, 20, $len);
        // Modification dispo pendant 1h
        $bool_verif = ($time->getTimestamp() < ($time_key + 3600)) ? $bool_verif : false;
        
    }
    
    function change_pwd()
    {
        $user = new User();
        if($_POST['pwd_one'] != $_POST['pwd_two'])
        {
            $erreur = 'Vos mots de passe ne correspondent pas';
        }
        else
        {
            if(complex_password($_POST['pwd_one']))
            {   
                $password_hash = password_hash($_POST['pwd_one'], PASSWORD_DEFAULT);
                $array_new_pwd = array(
                        ':pwd' => $password_hash,
                        ':id' => sanitize_int($_POST['user_id'])
                    );
                $user->change_pwd_user($array_new_pwd);
                $erreur = '';
            }
            else
            {
                $erreur = 'Mot de passe pas assez complexe';
            }
        }
        return $erreur;
    }
    
?>
