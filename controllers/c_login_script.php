<?php 
require_once '../models/connexion.php';

$login = $_POST['login_input'];
$pwd = $_POST['password'];

$requete = 'SELECT * FROM user JOIN role ON user.user_role_id = role.role_id WHERE user_nk_name =:login OR user_email =:login';
$result = $db->prepare($requete);
$result->bindValue(':login', $login);
$result->execute();
$row = $result->fetch();
$result->closeCursor();

// Verification de la connexion et ouverture de la session
if(password_verify($pwd, $row->user_pwd) && $pwd != 'disconnect_user')
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
    $_SESSION['erreurlogin'] = 'Indentifiants erronés';

}
header('location:../index.php');
?>
