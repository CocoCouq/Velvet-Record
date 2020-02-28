<?php include '../common/header.php' ?>
<?php include '../../controllers/c_details.php' ?>

<h1 class="center-align"><?= $artist ?> (<?= $count_disque ?>)</h1>   
<main>
    <section class="row">
        
        <?php foreach ($row as $cd) { ?>
        
            <div class="col l4 m6 s12">
              <div class="card blue-grey darken-4">
                <div class="card-content white-text">
                  <span class="card-title titleDisc center-align z-depth-4 section blue-grey"><?= $cd->disc_title ?></span>
                  <div class="row">
                      <article class="center-align section">
                        <p class="flow-text">Genre</p>
                        <p class="genreDisc"><?= $cd->disc_genre ?></p>
                    </article>
                    <div class="row valign-wrapper">
                        <article class="col s6">
                            <div class="row">
                                <p class="flow-text col s10 offset-s1">Année</p>
                                <p class="center-align"><?= $cd->disc_year ?></p>
                                <p class="dividerArtLab divider col s10 offset-s1"></p>
                                <p class="flow-text col s10 offset-s1">Label</p>
                                <p class="center-align"><?= $cd->disc_label ?></p>
                            </div>
                        </article>
                        <article class="col s6">
                            <img class="responsive-img" src="../../assets/img/<?= $cd->disc_picture ?>" alt="ImagesDisques" title="images cd-rom">
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
<!-- Détails -->
                    <form action="vue_details_cd.php" method="get">
                        <input type="hidden" value="<?= $artist ?>" name="artist_name">
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
