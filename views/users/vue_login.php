<?php include '../common/header.php' ?>
<?php include '../../controllers/c_login.php' ?>

<?php 
    if($_SESSION['auth'] != 'OK' && $_SESSION['auth'] != 'verif_mail')
    {
?>
<?php session_start() ?>

<main class="row section">

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
            <a class="col s12" href="vue_pwd_lost.php" title="Oublie de mot de passe">Mot de passe oublié</a>
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
            <h3 class="card-panel red white-text <?= ($_SESSION['auth'] == 'verif_mail') ? '' : 'hide' ?>">
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
        </form> 
        <form class="center-align section" action="../../controllers/c_ciao.php" method="post">
            <input type="hidden" value="<?= $row->user_id ?>" name="user_id">
            <!-- Modal Trigger -->
            <a class="waves-effect waves-light btn modal-trigger red" href="#modal1">Supprimer mon compte</a>
            <!-- Modal Structure -->
            <div id="modal1" class="modal">
                <div class="modal-content">
                    <h4 class="red section z-depth-3 white-text">Tu es sûr de ton choix ?</h4>
                    <p class="flow-text">Toutes tes informations seront supprimées</p>
                    <p>Cette décision n'est pas à prendre à la légère.</p>
                    <button class="btn waves-effect waves-light red" type="submit" name="ciao_send">Je suis sûr
                        <i class="material-icons right">directions_run</i>
                    </button>
                    <button class="btn waves-effect waves-light" type="submit" name="ciao_again_send">J'hésite
                        <i class="material-icons right">directions_walk</i>
                    </button>
                    <a class="btn waves-effect waves-light blue modal-close" href="">J'abandonne
                        <i class="material-icons right">hotel</i>
                    </a>
                </div>
            </div>
        </form>   
            
            <?php
    }
?>
<?php include '../common/footer.php' ?>