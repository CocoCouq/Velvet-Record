<?php include '../common/header.php' ?>
<?php include '../../controllers/c_ajout_artist.php' ?>


<main>
 
    <form id="formArt" class="container section" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
        <section class="row">
            <div class="input-field">
                <input id="Artist_Add" type="text" class="validate" name="Artist">
                <label for="Artist_Add">Artiste(s)</label>
            </div>
            <span id="erreurArtist" class="missForm red-text"><?= $err_art ?: '' ?></span>
        </section>
        <!--Préparation de l'url class(hide)-->
        <div class="input-field hide">
            <input id="urlArtiste" type="text" class="validate" name="URL">
            <label for="urlArtiste">url</label>
        </div>
        <button id="sendArt" class="btn waves-effect waves-light blue" type="submit" name="ajout_artist">Ajouter
            <i class="material-icons right">add</i>
        </button>
    </form>
    
</main>

<?php include '../common/footer.php' ?>
