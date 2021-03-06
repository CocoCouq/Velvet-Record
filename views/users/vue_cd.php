<?php include '../../controllers/users/c_cd.php' ?>
<?php include '../common/header.php' ?>

<main>
    <h1 class="center-align">CD-ROM (<?= $count_disque ?>)</h1>
    <div id="ajoutBtnArtist" class="btn">
        <a class="white-text" href="vue_ajout_cd.php" title="Ajouter un artiste">Ajouter</a>
    </div>
    <section class="row">
        <?php foreach ($table as $cd) {  ?>
            <div class="cardCD col s10 offset-s1 m8 offset-m2 l6 offset-l3 section">
              <div class="card blue-grey darken-4">
                <div class="card-content white-text">
                  <span class="card-title titleDisc center-align z-depth-4 section blue-grey"><?= $cd->disc_title ?></span>
                  <h2 class="artistCDcard center-align light-blue-text truncate"><?= $cd->artist_name ?></h2>
                  <div class="row">
                        <article class="center-align section">
                            <p class="flow-text">Genre</p>
                            <p class="genreDisc"><?= $cd->disc_genre ?></p>
                        </article>
                        <div class="row valign-wrapper">
                        <article class="col s7">
                            <div class="row">
                                <p class="flow-text col s10 offset-s1">Année</p>
                                <p class="center-align col s12"><?= $cd->disc_year ?></p>
                                <p class="dividerArtLab divider col s10 offset-s1"></p>
                                <p class="flow-text col s10 offset-s1">Label</p>
                                <p class="center-align col s12"><?= $cd->disc_label ?></p>
                            </div>
                        </article>
                        <article class="col s5">
                            <img class="imagesPoch responsive-img" src="../../assets/img/<?= $cd->disc_picture ?>" alt="ImagesDisques" title="images cd-rom">
                        </article>
                    </div>
                      <article class="col s4 offset-s4 center-align">
                        <p class="divider section blue-grey darken-4"></p>
                        <div class="articlePrix blue-grey lighten-4 black-text z-depth-3">
                            <p class="flow-text z-depth-1">Prix</p>
                            <p><?= $cd->disc_price ?>€</p>
                        </div>
                      </article>
                  </div>
                </div>
                <div class="card-action center-align">
                    <form action="vue_details_cd.php" method="get">
                        <input type="hidden" value="<?= $cd->disc_id ?>" name="disc_id">
                        <input class="waves-effect waves-light btn" type="submit" value="Détails">
                    </form>
                </div>
              </div>
            </div>
        <?php } ?>
    </section>
</main>


<?php include '../common/footer.php' ?>