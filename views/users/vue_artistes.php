<?php include '../common/header.php' ?>
<?php include '../../controllers/c_artistes.php' ?>

<?php 
    if(isset($_POST['delete_artist']))
    {
        del_art($db); ?>
        <p class="center-align flow-text red-text ">Artiste supprimé</p> <?php
    }
    $tableau = art_ord_name($db);
?>



<main>
    <h1 class="center-align">Artistes</h1>
    <div id="ajoutBtnArtist" class="btn">
        <a class="white-text" href="vue_ajout_artist.php" title="Ajouter un artiste">Ajouter</a>
    </div>
    <section class="row">
        <?php 
            foreach ($tableau as $result) { 
                $nameArt = $result->artist_name;
                $idArt = $result->artist_id;
        ?>
                  
            <div class="col s12 m6 l4">
              <div class="card blue-grey darken-4">
                <div class="card-content white-text">
                  <span class="card-title center-align"><?= $nameArt ?></span>
                </div>
                <div class="card-action center-align">
                    <div class="row">
                        <section class="col l4 offset-l2 m6 offset-m1 s5 offset-s1">
                            <form action="vue_details.php" method="get">
                                <input type="hidden" name="hiddenID" value="<?= $idArt ?>">
                                <input type="hidden" name="hiddenName" value="<?= $nameArt ?>">
                                <input class="waves-effect waves-light btn" type="submit" value="CD-ROM">
                            </form>
                        </section>
                        <aside class="col l2 offset-l2 m4 offset-m1 s2 offset-s2">
                            <form action="<?php print $_SERVER['PHP_SELF'] ?>" method="post"> 
                                <input type="hidden" value="<?= $idArt ?>" name="hiddenID">
                                <a class="btnEnvoie waves-effect waves-light btn modal-trigger red" href="#modal<?= $idArt ?>"><i class="material-icons right">delete</i></a>
                                <div id="modal<?= $idArt ?>" class="modal">
                                    <div class="modal-content">
                                        <h4 class="section">Supprimer <?= $nameArt ?></h4>
                                        <p>La suppression de l'artiste entrainera celle de tous ses CD-ROM</p>
                                        <p class="red-text">Cette action est irréversible</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="#!" class="modal-close waves-effect waves-green btn blue">Annuler</a>
                                        <button class="btnEnvoie btn waves-effect waves-light red" type="submit" name="delete_artist" title="Supprimer">
                                            <i class="material-icons right">delete</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </aside>
                    </div>
                </div>
              </div>
            </div>
        <?php } ?>
    </section>
</main>

<?php include '../common/footer.php' ?>
