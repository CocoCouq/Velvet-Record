<?php

    if(isset($_POST['submit_inscription']))
    {
        // REGEX
        $filtre_name = '/^[A-Zéèêëîïíôöòóœàáâäæç\-]+$/i';
        $filtre_mail = '/(^[\w\.-]+@[\w\.-]+\.[\w]{2,4})$/';
        $filtre_nkname = '/(^[\wéèêëûüîïôàçæœ\-\.\_\+\=\'\*]*$)/';
        
        // Recupération des erreurs
    // NAME
        if(!empty($_POST['name']))
        {
            if(!preg_match($filtre_name, $_POST['name']))
            {
                $tabErreur['name'] = 'Vous utilisez des caractères interdits';
            }
        }
        else 
        {
            $tabErreur['name'] = 'Renseignez le champs';
        }
    // FIRST NAME
        if(!empty($_POST['first_name']))
        {
            if(!preg_match($filtre_name, $_POST['first_name']))
            {
                $tabErreur['first_name'] = 'Vous utilisez des caractères interdits';
            }
        }
        else 
        {
            $tabErreur['first_name'] = 'Renseignez le champs';
        }
    // EMAIL
        if(!empty($_POST['mail']))
        {
            if(!preg_match($filtre_mail, $_POST['mail']))
            {
                $tabErreur['mail'] = 'Vous utilisez des caractères interdits';
            }
        }
        else 
        {
            $tabErreur['mail'] = 'Renseignez le champs';
        }
    // NICKNAME
        if(!empty($_POST['nickname']))
        {
            if(!preg_match($filtre_nkname, $_POST['nickname']))
            {
                $tabErreur['nickname'] = 'Vous utilisez des caractères interdits';
            }
        }
        else 
        {
            $tabErreur['nickname'] = 'Renseignez le champs';
        }
    // MOT DE PASSE
        if(!empty($_POST['pwd_one']) && !empty($_POST['pwd_conf']))
        {
            if($_POST['pwd_one'] == $_POST['pwd_conf'])
            {
                if(!complex_password($_POST['pwd_one']))
                {
                    $tabErreur['pwd'] = 'Au moins 8 caractères dont une majuscule, une minuscule et un nombre';
                }
            }
            else
            {
                $tabErreur['pwd'] = 'Les mots de passe ne correspondent pas';
            }
        }
        else 
        {
            $tabErreur['pwd'] = 'Renseignez le champs';
        }
    // Accepte form
        if($_POST['acc_form'] != '1')
        {
            $tabErreur['acc_form'] = 'Acceptez le traitement du formulaire';
        }
        
        // Hashage du mot de passe 
        $hash = password_hash($_POST['pwd_one'], PASSWORD_DEFAULT);
        //VERIFICATION du hashage
        $hash_bool = password_verify($_POST['pwd_one'], $hash);
//        var_dump($hash);
        
        
        // S'il n'y a pas d'erreur 
        if(count($tabErreur) == 0 && $hash_bool)
        {
            // Déclaration du tableau des valeurs
            $array_user = array(
                ':name' => sanitize_str($_POST['name']),
                ':first_name' => sanitize_str($_POST['first_name']),
                ':mail' => sanitize_str($_POST['mail']),
                ':nickname' => sanitize_str($_POST['nickname']),
                ':pwd' => $hash
            );
            
            // Requete d'ajout d'utilisateur
            $requete = 'INSERT INTO user(user_name, user_fst_name, user_nk_name, user_email, user_pwd, user_role_id) VALUE (:name, :first_name, :nickname, :mail, :pwd, 2)';
            
            $result = $db->prepare($requete);
            $result->execute($array_user);
            $result->closeCursor();
            
            header('location:../../index.php');
        }
    }

?>
