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
    $_SESSION['auth'] = 'OK';
    $_SESSION['erreurlogin'] = '';
}
else 
{
    session_start();
    unset($_SESSION['login']);
    unset($_SESSION['auth']);
    
    if(ini_get("session.use_cookies"))
    {
        setcookie(session_name(), '', time()-42000);
    }
    session_destroy();
    session_start();
    $_SESSION['erreurlogin'] = 'Indentifiants erronés';

}
header('location:../index.php');
?>
