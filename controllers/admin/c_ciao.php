<?php
    include '../../controllers/lib/library.php';
    require_once '../../models/m_users.php';
    
    $send_button = isset($_POST['ciao_send']) ? true : false;
    if(isset($_POST['ciao_send']) || isset($_POST['ciao_again_send']))
    {
        if(!empty($_POST['user_id']))
        {
            $user = new User();
            $user_id = htmlspecialchars(intval($_POST['user_id']));
            
            $user->delete_user($user_id);
            // Pour la blague
            if($send_button)
            {
                header('location:../../views/admin/vue_ciao.php?rep=1');
            }
            else
            {
                header('location:../../views/admin/vue_ciao.php?rep=2');
            }
        }
        else 
        {
            header('location:../../index.php');
        }
        
    }
    else
    {
        header('location:../../index.php');
    }
    
    
    
?>