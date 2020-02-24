<?php include '../common/header.php' ?>

<?php 
    if(isset($_POST['delete_artist']))
    {
        include '../../controllers/c_delete_artist.php';
        echo 'Supprimé';
    }
    else{
?>

<?php include '../../controllers/c_artistes.php' ?>

<main>
    <h1 class="center-align">Artistes</h1>
    <div id="ajoutBtnArtist" class="btn">
        <a class="white-text" href="vue_ajout_artist.php" title="Ajouter un artiste">Ajouter</a>
    </div>
    <section class="row">
        <?php foreach ($tableau as $result) { ?>
            <div class="col s12 m6">
              <div class="card blue-grey darken-4">
                <div class="card-content white-text">
                  <span class="card-title center-align"><?= $result->artist_name ?></span>
                </div>
                <div class="card-action center-align">
                    <form action="vue_details.php" method="get">
                        <input type="hidden" name="hiddenID" value="<?= $result->artist_id ?>">
                        <input type="hidden" name="hiddenName" value="<?= $result->artist_name ?>">
                        <input class="waves-effect waves-light btn" type="submit" value="CD-ROM">
                    </form>
                    <form action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="hidden" name="idArtist" value="<?= $result->artist_id ?>">
                        <button class="btnEnvoie btn waves-effect waves-light red" type="submit" name="delete_artist" title="Supprimer">
                            <i class="material-icons right">delete</i>
                        </button>
                    </form>
                </div>
              </div>
            </div>
        <?php } ?>
    </section>
</main>

    <?php } ; include '../common/footer.php' ?>
