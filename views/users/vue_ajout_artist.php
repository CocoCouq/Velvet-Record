<?php include '../common/header.php' ?>

<?php 
    
    if (isset($_POST['ajout_artist']))
    {
        include '../../controllers/c_ajout_artist.php'; ?>
        <section>
            <h1 class="center-align"><?= $name ?></h1>
            <article>
                <p class="center-align red-text flow-text">Bien ajouté aux artistes</p>
                <p class="center-align">Redirection dans 5 secondes</p>
            </article>
        </section><?php
    }
    else {
?>


<main>
   
    <form class="container section" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="input-field col s6">
            <input id="Artiste" type="text" class="validate" name="Artist">
            <label for="Artiste">Artiste(s)</label>
        </div>
        <!--Préparation de l'url class(hide)-->
        <div class="input-field col s6 hide">
            <input id="urlArtiste" type="text" class="validate" name="URL">
            <label for="urlArtiste">url</label>
        </div>
        <button class="btn waves-effect waves-light blue" type="submit" name="ajout_artist">Ajouter
            <i class="material-icons right">add</i>
        </button>
    </form>
    
</main>

    <?php } ?>

<?php include '../common/footer.php' ?>
