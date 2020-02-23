<?php include '../common/header.php' ?>

<?php 
    $artist = htmlspecialchars($_POST['hiddenArtist']);

    if(isset($_POST['delete']))
    {
        include '../../controllers/c_delete.php'; ?>
        <p id="pDelete" class="fow-text center-align">Disque supprimé</p> 
        <p class="center-align" id="timerDelete">Redirection dans 5 secondes</p><?php
        header('Refresh: 4; URL=../../index.php');
    }
    else if (isset ($_POST['edit']))
    {    
        include '../../controllers/c_details_disc.php';
?>
<h1 class="center-align">Modification</h1> 
<main>
    <form class="container" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="input-field">
            <input name="Titre" id="upTitre" type="text" class="validate" value="<?= $row->disc_title ?>">
            <label for="upTitre">Titre</label>
        </div>
        <div>
            <div class="input-field">
                <select id="selectArtiste" name="Artist">
                    <option value="<?= $row->artist_id ?>"><?= $artist ?></option>
                    <?php 
                        include '../../controllers/c_detail_artist.php'; 
                        foreach ($row_artiste as $line) {
                            if ($line->artist_id != $row->artist_id)
                            {
                    ?>
                    <option value="<?= $line->artist_id ?>"><?= $line->artist_name ?></option>
                    <?php   }
                        } ?>
                </select>
                <label for="selectArtist">Artiste</label>
            </div>
        </div>
        <div class="input-field">
            <input name="Annee" id="upAnnee" type="text" class="validate" value="<?= $row->disc_year ?>">
            <label for="upAnnee">Année</label>
        </div>
        <div class="input-field">
            <input name="Genre" id="upGenre" type="text" class="validate" value="<?= $row->disc_genre ?>">
            <label for="upGenre">Genre</label>
        </div>
        <div class="input-field">
            <input name="Label" id="upLabel" type="text" class="validate" value="<?= $row->disc_label ?>">
            <label for="upLabel">label</label>
        </div>
        <div class="input-field">
            <input name="Prix" id="upPrix" type="text" class="validate" value="<?= $row->disc_price ?>">
            <label for="upPrix">Prix</label>
        </div>
        <input type="hidden" name="hiddenDisc" value="<?= $row->disc_id ?>">
        <button class="btn waves-effect waves-light" type="submit" name="modifier_self">Modifier
            <i class="material-icons right">send</i>
        </button>
        <div class="section">
            <input class="btn" type="button" value="Retour" name="Retour">
        </div>
    </form>
    <!--Faire l'ajout de photo-->
    <form class="row" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="file-field input-field col l4 offset-l4 m6 offset-m3 s8 offset-s2">
            <div class="btn blue">
                <span>Image</span>
                <input type="file">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
            </div>
        </div>
    </form>
    <div class="row">
        <img src="../../assets/img/<?= $row->disc_picture ?>" alt="Pochette" class="col m4 offset-m4 s6 offset-s3 responsive-img" title="image pochette">
    </div>
</main>
        
<?php 
    } // fin de else if update
    else if(isset ($_POST['modifier_self']))
    {
        include '../../controllers/c_update.php'; ?>
        <h1 class="center-align">Modifications</h1>
        <section class="container center-align blue-grey lighten-4 z-depth-3">
            <h2 class="center-align"><?= $array_value[':titre'] ?></h2>
            <h3 class="center-align"><?= $row_artist->artist_name ?></h3>
            <article class="center-align">
                <p>Année : <?= $array_value[':annee'] ?></p>
                <p>Genre : <?= $array_value[':genre'] ?></p>
                <p>Label : <?= $array_value[':label'] ?></p>
                <p>Prix : <?= $array_value[':prix'] ?></p>
            </article>
        </section>
        <?php
    }
    else 
    {
        echo 'Erreur';
    }
?>
        
<?php include '../common/footer.php' ?>
