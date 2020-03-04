<?php include '../common/header.php' ?>
<?php include '../../controllers/c_login.php' ?>

<?php 
    if($_SESSION['auth'] != 'OK')
    {
?>

<main class="row section">
    
  <?php  session_start() ?>

    <h1 class="center-align">Connexion</h1>
    <!--FORM A COMPLETER-->
    <div class="card-panel col l6 offset-l3 m8 offset-m2 s10 offset-s1 blue-grey lighten-5">
        <span class="flow-text center-align col s12 red-text"><?= $_SESSION['erreurlogin'] ?></span>
        <form class="container section" action="../../controllers/c_login_script.php" method="post">
            <section class="section">
                <div class="input-field">
                    <input name="login_input" placeholder="ou email" id="login_input" type="text" class="validate">
                    <label for="login_input">Identifiant</label>
                </div>
                <div class="input-field">
                    <input name="password" id="login_password" type="password" class="validate">
                    <label for="login_password">Mot de passe</label>
                </div>
                <div class="center-align">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Se connecter
                        <i class="material-icons right">perm_identity</i>
                    </button>
                </div>
            </section>
        </form>
        <div class="col s12 center-align">
            <a class="col s12" href="vue_new_user.php" title="S'inscrire">Créer un compte</a>
            <div class="divider col s2 offset-s5"></div>
            <a class="col s12" href="#" title="Oublie de mot de passe">Mot de passe oublié</a>
        </div>
    </div>
</main>

<?php 
    }
    else
    {
        $row = user_infos($db); ?>
        <h1 class="center-align">Espace Personnel</h1>
        <section class="center-align container">
            <h2 class="card-panel"><?= $row->user_nk_name ?></h2> 
            <h3 class="card-panel red white-text <?= ($_SESSION['role'] == 'Non vérifiés') ? '' : 'hide' ?>">
                Vérifiez votre email
            </h3>
            <article class="card-panel">
                <p class="flow-text"><ins>Nom</ins> : <?= $row->user_name ?></p>
                <p class="flow-text"><ins>Prénom</ins> : <?= $row->user_fst_name ?></p>
                <p class="flow-text"><ins>e-mail</ins> : <?= $row->user_email ?></p>
            </article>
        </section>
        <form class="section center-align" action="../../controllers/c_login_script.php" method="post">
            <input type="hidden" name="password" value="disconnect_user">
            <button class="btn waves-effect waves-light" type="submit" name="action">Se déconnecter
                <i class="material-icons right">close</i>
            </button>
        </form> <?php
    }
?>
<?php include '../common/footer.php' ?>