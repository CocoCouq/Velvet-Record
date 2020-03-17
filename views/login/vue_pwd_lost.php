<?php include '../../controllers/login/c_pwd_lost.php' ?>
<?php include '../common/header.php' ?>

<h1 class="center-align">Mot de passe oublié</h1>
<main class="center-align section">
    <section class="blue-grey darken-3 container section z-depth-2">
        <h2 class="center-align flow-text white-text">Envoie d'un lien</h2>
        <form class="row" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
            <label class="col l6 offset-l3 m8 offset-m2 s10 offset-s1" for="user_identi">
                <input type="text" placeholder="Email ou Pseudo" id="user_identi" name="user_input">
            </label>
            <div class="col s12">
                <button class="btn waves-effect waves-light" type="submit" name="send_pwd_lost">Envoyer
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </form>
    </section>
</main>

<?php include '../common/footer.php' ?>