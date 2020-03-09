<?php

    if(isset($_POST['send_pwd_lost']))
    {
        if(!empty($_POST['user_input']))
        {
            $user = htmlspecialchars($_POST['user_input']);
            $requete = 'SELECT * FROM user WHERE user_nk_name =:input OR user_email =:input';
            $result = $db->prepare($requete);
            $result->bindValue(':input', $user);
            $result->execute();
            $tab = $result->fetch();
            $result->closeCursor();
            if(count($tab) == 1)
            {
                // Creation d'une nouvelle key 
                $key = random_bytes(10);
                $key_insert = password_hash(bin2hex($key), PASSWORD_ARGON2ID);
                $bool_key = password_verify(bin2hex($key), $key_insert);
                if($bool_key)
                {
                    $requete = 'UPDATE user SET user_key =:key WHERE user_nk_name =:id OR user_email =:id';
                    $result = $db->prepare($requete);
                    $result->bindValue(':key', $key_insert);
                    $result->bindValue(':id', $user);
                    $result->execute();
                    $result->closeCursor();
                    // Envoie du mail 
                    $aHeaders = array('MIME-Version' => '1.0',
                                'Content-Type' => 'text/html; charset=utf-8',
                                'From' => 'Velvet Record <mr.couq@gmail.com>',
                                'Reply-To' => 'Corentin COUQ <couq@icloud.com>',
                                'X-Mailer' => 'PHP/' . phpversion()
                             ); 
                    // include du mail en html
                    include_once '../../controllers/lib/mail_lost.php';
                    mail($tab->user_email, 'Velvet record - Mot de passe oublié', $message, $aHeaders);
                    header('refresh:3;url=vue_login.php');
                }
                else 
                {
                    $erreur = 'Erreur de génération de clef';
                }

            }
            else
            {
                $erreur = 'L\'utilisateur n\'existe pas';
            }
        }
        else 
        {
            $erreur = 'Renseignez le champs avec votre email ou votre Pseudo';
        }
    }

?>
