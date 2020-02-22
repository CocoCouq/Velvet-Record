<?php include '../common/header.php' ?>
<?php include '../../controllers/c_details_disc.php' ?>

<?php 
    $artist = htmlspecialchars($_GET['hiddenArtiste']); 
?>

<main>
    <div class="row">
        <input class="col offset-s1 btn" type="button" value="Retour" name="Retour">
    </div>
    <h1 class="center-align"><?= $row->disc_title ?></h1>
    <h2 id="titleArtLarg" class="center-align flow-text hide-on-med-and-down"><?= $artist ?></h2>
    <div class="row">
        <section class="col s5 offset-s1">
        <table class="highlight centered blue-grey lighten-4 z-depth-3">  
            <tbody>
                <tr>
                    <th class="center-align">Année</th>
                    <td><?= $row->disc_year ?></td>
                </tr>
                <tr>
                    <th class="center-align">Genre</th>
                    <td><?= $row->disc_genre ?></td>
                </tr>
                <tr>
                    <th class="center-align">Label</th>
                    <td><?= $row->disc_label ?></td>
                </tr>
                <tr>
                    <th class="center-align">Prix</th>
                    <td><?= $row->disc_price ?></td>
                </tr>
            </tbody>
        </table>
            <div class="row section">
                <div class="col s3 offset-s1">
                    <form class="section" action="vue_update.php" method="post">
                        <button class="btnEnvoie btn waves-effect waves-light section" type="submit" name="action">Modifier
                            <i class="material-icons right">edit</i>
                        </button>
                    </form>
                    <form action="vue_delete.php">
                        <button class="btnEnvoie btn waves-effect waves-light red" type="submit" name="action">Supprimer
                            <i class="material-icons right">delete</i>
                        </button>
                    </form>
                </div>
            </div>
        </section>
        <section class="col s4 offset-s1">
            <h2 id="titlArt" class="center-align hide-on-large-only"><?= $artist ?></h2>
            <article>
                <img class="responsive-img z-depth-3" src="../../assets/img/<?= $row->disc_picture ?>" alt="Image">
            </article>
            <h3 class="flow-text center-align hide-on-large-only">Pochette</h3>
        </section>
    </div>
</main>


<?php include '../common/footer.php' ?>
