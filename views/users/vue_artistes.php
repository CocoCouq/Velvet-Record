<?php include '../common/header.php' ?>
<?php include '../../controllers/c_artistes.php' ?>

<main>
    <h1 class="center-align">Artistes</h1>
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
                </div>
              </div>
            </div>
        <?php } ?>
    </section>
</main>

<?php include '../common/footer.php' ?>
