<?php
    include '../../controllers/lib/library.php';
    require_once '../../models/m_users.php';
    
    // Pour savoir si l'utiliseur veut supprimer son compte
    $send_button = isset($_POST['ciao_send']) ? true : false;
    if(isset($_POST['ciao_send']) || isset($_POST['ciao_again_send']))
    {
        if(!empty($_POST['user_id']))
        {
            $user = new User();
            $user_id = sanitize_int($_POST['user_id']);
            
            $user->delete_user($user_id);
            // Pour la blague
            if($send_button)
            {
                header('location:../../views/admin/vue_ciao.php?rep=1');
            } // Clique sur j'hésite
            else
            {
                header('location:../../views/admin/vue_ciao.php?rep=2');
            }
        } // Si champs vide 
        else 
        {
            header('location:../../index.php');
        }
    } // Si pas de 'submit'
    else
    {
        header('location:../../index.php');
    }
    
?>