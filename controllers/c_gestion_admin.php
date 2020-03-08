<?php 
    require_once '../models/connexion.php';
    session_start();
    if($_SESSION['auth'] == 'OK' && $_SESSION['role'] == 'Administrateur')
    {
        // Suppression utilisateur
        if(isset($_POST['delete_user']))
        {
            $input = htmlspecialchars($_POST['input_admin']);
            $user = trim($input);
            if(!empty($_POST['input_admin']) && $user != 'Admin' && $user != 'couq@icloud.com')
            {
                $requete = 'DELETE FROM user WHERE user_nk_name =:input OR user_email =:input';
                $result = $db->prepare($requete);
                $result->bindValue(':input', $user);
                $result->execute();
                $result->closeCursor();
                header('location:../views/admin/vue_index_admin.php');
            }
            else if($user == 'Admin' || $user == 'couq@icloud.com')
            {
                echo 'IMPOSSIBLE DE SUPPRIMER LE CREATEUR';
                header('refresh:3;url=../views/admin/vue_gestion_admin.php');
            }
            else
            {
                echo 'Vous devez renseignez un utilisateur';
                header('refresh:3;url=../views/admin/vue_gestion_admin.php');
            }
        }
        // VERIFICATION DE L'UTILISATEUR
        else if(isset($_POST['verif_user']))
        {
            $input = htmlspecialchars($_POST['input_admin']);
            $user = trim($input);
            if(!empty($_POST['input_admin']))
            {
                $requete = 'UPDATE user SET user_confirm = true WHERE user_nk_name =:input OR user_email =:input';
                $result = $db->prepare($requete);
                $result->bindValue(':input', $user);
                $result->execute();
                $result->closeCursor();
                header('location:../views/admin/vue_index_admin.php');
            }
            else 
            {
                echo 'Vous devez renseignez le champs';
                header('refresh:3;url=../views/admin/vue_gestion_admin.php');
            }
        }
        // Role administrateur
        else if(isset($_POST['role_user']))
        {
            $input = htmlspecialchars($_POST['input_admin']);
            $user = trim($input);
            if(!empty($_POST['input_admin']))
            {
                $requete = 'UPDATE user SET user_role_id = 1 WHERE user_nk_name =:input OR user_email =:input';
                $result = $db->prepare($requete);
                $result->bindValue(':input', $user);
                $result->execute();
                $result->closeCursor();
                header('location:../views/admin/vue_index_admin.php');
            }
            else 
            {
                echo 'Vous devez renseignez le champs';
                header('refresh:3;url=../views/admin/vue_gestion_admin.php');
            }
        }
        else
        {
            header('location:../views/admin/vue_index_admin.php');
        }
    }
    else 
    {
        header('location:../index.php');
    }
?>