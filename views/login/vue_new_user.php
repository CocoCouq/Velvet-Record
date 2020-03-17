<?php include '../../controllers/login/c_new_user.php' ?>
<?php include '../common/header.php' ?>


<h1 class="center-align">Inscription</h1>
<main>
    <form id="form_new_user" class="container blue-grey darken-3 row z-depth-2" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="input-field col s5">
            <input id="nameUser" type="text" class="validate" name="name">
            <label for="nameUser">Nom</label>
            <span id="errNewName" class="red-text"><?= $tabErreur['name'] ?: '' ?>
        </div>
        <div class="input-field col s5 offset-s2">
            <input id="fisrtNameUser" type="text" class="validate" name="first_name">
            <label for="fisrtNameUser">Prénom</label>
            <span id="errNewFtName" class="red-text"><?= $tabErreur['first_name'] ?: '' ?></span>
        </div>
        <div class="input-field col s6 offset-s3">
            <input id="mailUser" type="text" class="validate" name="mail">
            <label for="mailUser">E-mail</label>
            <span id="errNewMail" class="red-text"><?= $tabErreur['mail'] ?: '' ?>
        </div>
        <div class="col l6 offset-l3 m8 offset-m2 s10 offset-s1 card-panel blue-grey lighten-5">
            <section class="row">
                <div class="input-field col s10 offset-s1">
                    <input id="nickName" type="text" class="validate" name="nickname">
                    <label for="nickName">Nom d'utilisateur</label>
                    <span id="errNkName" class="red-text"><?= $tabErreur['nickname'] ?: '' ?>
                </div>
                <div class="input-field col s8 offset-s2">
                    <input id="mdp_one" type="password" class="validate pwd_user" name="pwd_one">
                    <label for="mdp_one">Mot de passe</label>
                    <span id="errNewPwd" class="red-text"><?= $tabErreur['pwd'] ?: '' ?>
                </div>
                <div class="input-field col s8 offset-s2">
                    <input id="mdp_conf" type="password" class="validate pwd_user" name="pwd_conf">
                    <label for="mdp_conf">Confirmer</label>
                </div>
            </section>
        </div>
        <section class="row">
        <div class="switch col s12 center-align">            
            <label for="accept">
                <input id="accept" type="checkbox" name="acc_form" value="1">
                <span class="lever"></span>
                J'accepte le traitement du formulaire 
            </label>
        </div>
        <span id="errAccept" class="red-text col s12 center-align"><?= $tabErreur['acc_form'] ?: '' ?></span>
        </section>
        <div class="col s12 center-align">
            <button id="submit_newUser" class="btn waves-effect waves-light" type="submit" name="submit_inscription">S'inscrire
                <i class="material-icons right">check</i>
            </button>
        </div>
    </form>
</main>


<?php include '../common/footer.php' ?>
