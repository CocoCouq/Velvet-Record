<?php 
    include '../../controllers/lib/library.php';
    require_once '../../models/m_users.php';

    $login = sanitize_str($_POST['login_input']);
    $pwd = $_POST['password'];

    $user = new User();
    $row = $user->user_infos($login);

    // Verification de la connexion et ouverture de la session
    if(password_verify($pwd, $row->user_pwd) && !isset($_POST['deconnexion']))
    {   
        session_start();
        $_SESSION['login'] = $row->user_fst_name;
        $_SESSION['role'] = $row->role_name;
        $_SESSION['user_id'] = $row->user_id;
        $_SESSION['auth'] = $row->user_confirm ? 'OK' :'verif_mail';
        $_SESSION['erreurlogin'] = '';
        
        // Ouverture du fichier
        $file = fopen("../assets/img/visite.txt","r+");
        // Lecture
        $cmt = intval(fgets($file)) + 1;
        // Positionnement debut 
        fseek($file,0);
        // Ecriture 
        fputs($file, $cmt);
        fclose($file);
    }
    else 
    {
        session_start();
        unset($_SESSION['login']);
        unset($_SESSION['auth']);
        unset($_SESSION['role']);
        unset($_SESSION['user_id']);
        unset($_SESSION['erreurlogin']);

        if(ini_get("session.use_cookies"))
        {
            setcookie(session_name(), '', time()-84600);
        }
        session_destroy();
        session_start();
        if(!isset($_POST['deconnexion']))
        {
            $_SESSION['erreurlogin'] = 'Indentifiants erronés';
        }

    }
    header('location:../../index.php');
?>
