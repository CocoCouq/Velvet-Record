<?php include '../common/header.php' ?>
<?php include '../../controllers/c_modif_pwd.php' ?>

<?php 
    if(isset($_POST['modif_pass']))
    {
        $erreur = change_pwd($db);
        if($erreur == '')
        {
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
                        <input type="hidden" name="user_id" value="<?= $row->user_id ?>">
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
