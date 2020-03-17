<?php
    include '../../controllers/lib/library.php';
    require_once '../../models/m_users.php';

    if(isset($_POST['send_pwd_lost']))
    {
        if(!empty($_POST['user_input']))
        {
            $user = new User();
            
            $user_name = htmlspecialchars($_POST['user_input']);
            $tab = $user->user_infos($user_name);
           
            if(count($tab) == 1)
            {
                // Creation d'une nouvelle key 
                $time = new DateTime();

                $key = random_bytes(10);
                $key2 = random_bytes(10);
                $key_insert = bin2hex($key).$time->getTimestamp().bin2hex($key2);
                
                $user->change_key($user_name, $key_insert);
                
                // Envoie du mail 
                $aHeaders = array('MIME-Version' => '1.0',
                            'Content-Type' => 'text/html; charset=utf-8',
                            'From' => 'Velvet Record <mr.couq@gmail.com>',
                            'Reply-To' => 'Corentin COUQ <couq@icloud.com>',
                            'X-Mailer' => 'PHP/' . phpversion()
                        ); 
                // include du mail en html
                include_once 'mails/mail_lost.php';
                mail($tab->user_email, 'Velvet record - Mot de passe oublié', $message, $aHeaders);
                header('refresh:3;url=vue_login.php');

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
