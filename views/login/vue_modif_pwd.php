<?php include '../../controllers/login/c_modif_pwd.php' ?>
<?php include '../common/header.php' ?>

<?php 
    if(isset($_POST['modif_pass']))
    {
        $erreur = change_pwd();
        if($erreur == '')
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
            header('location:vue_login.php');
        }
        else 
        { ?>
            <div class="row">
                <input id="returnBtn" class="col offset-s1 btn" type="button" value="Retour" name="Retour">
            </div><?php
            echo $erreur;
        }
    }
    else
    {
        if($bool_verif)
        { ?>
            <h1 class="center-align flow-text">Changement de mot de passe</h1>
            <main class="container section">
                <form class="center-align row" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
                    <div class="col l6 offset-l3 m8 offset-m2 s10 offset-s1">
                        <label for="pwd1">Nouveau mot de passe</label>
                        <input type="password" id="pwd1" name="pwd_one">
                        <label for="pdw2">Confirmez</label>
                        <input type="password" id="pwd2" name="pwd_two">
                        <input type="hidden" name="user_id" value="<?= $_GET['id'] ?>">
                        <span class="red-text"><?= $erreur ?: '' ?></span>
                        <button class="btn waves-effect waves-light" type="submit" name="modif_pass">Modifier
                            <i class="material-icons right">perm_identity</i>
                        </button>
                    </div>
                </form>
            </main> 
<?php
        }
    }
?>

<?php include '../common/footer.php' ?>
