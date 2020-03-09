<?php
    include_once '../models/connexion.php';
    $send_button = isset($_POST['ciao_send']) ? true : false;
    if(isset($_POST['ciao_send']) || isset($_POST['ciao_again_send']))
    {
        if(!empty($_POST['user_id']))
        {
            $user_id = htmlspecialchars(intval($_POST['user_id']));
            $requete = 'DELETE FROM user WHERE user_id =:user';
            $result = $db->prepare($requete);
            $result->bindValue(':user', $user_id);
            $result->execute();
            $result->closeCursor();
            if($send_button)
            {
                header('location:../views/admin/ciao.php?rep=1');
            }
            else
            {
                header('location:../views/admin/ciao.php?rep=2');
            }
        }
        else 
        {
            header('location:../index.php');
        }
        
    }
    else
    {
        header('location:../index.php');
    }
    
    
    
?>