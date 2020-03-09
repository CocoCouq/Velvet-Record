<?php 

    if(!empty($_GET['id']) && !empty($_GET['key']))
    {
        $user = urldecode($_GET['id']);
        $key = urldecode($_GET['key']);
        
        $requete = 'SELECT * FROM user WHERE user_nk_name =:user';
        $result = $db->prepare($requete);
        $result->bindValue(':user', $user);
        $result->execute();
        $row = $result->fetch();
        $result->closeCursor();
        $key_db = $row->user_key;
        $bool_verif = password_verify($key, $row->user_key) ? true : false;
    }
    
    function change_pwd($pdo)
    {
        if($_POST['pwd_one'] != $_POST['pwd_two'])
        {
            $erreur = 'Vos mots de passe ne correspondent pas';
        }
        else
        {
            $password = $_POST['pwd_one'];
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $bool_hash = password_verify($password, $password_hash);
            
            $bool_complex = complex_password($password);
            
            if($bool_complex)
            {
                if($bool_hash)
                {
                    $requete = 'UPDATE user SET user_pwd =:pwd';
                    $result = $pdo->prepare($requete);
                    $result->bindValue(':pwd', $password_hash);
                    $result->execute();
                    $result->closeCursor();
                    $erreur = '';
                }
                else
                {
                    $erreur = 'Probleme d\'insertion de mot de Passe';
                }
            }
            else
            {
                $erreur = 'Mot de passe pas assez complexe';
            }
        }
        return $erreur;
           
    }

?>
