<?php include '../common/header.php' ?>
<?php include '../../controllers/c_update_delete.php'; ?>


<?php 
// Si bouton delete 
    if(isset($_POST['delete']))
    {
        delete_disc($db); 
    }
// Sinon si bouton modification d'image
    else if (isset($_POST['ajout_photo']))
    {
        update_pict($db);
    }
// Sinon si Modification
    else if (isset ($_POST['edit']))
    {    
        $row = fetch_info_disc($db); ?>
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
                        <option value="<?= $row->artist_id ?>"><?= $row->artist_name ?></option>
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
                <i class="material-icons right">edit</i>
            </button>
            <div class="section">
                <input id="returnBtn" class="btn" type="button" value="Retour" name="Retour">
            </div>
        </form>
        <!--Faire l'ajout de photo-->
        <form class="row" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?= $row->disc_id ?>" name="hiddenDisc">
            <div class="file-field input-field col l4 offset-l4 m6 offset-m3 s8 offset-s2">
                <div class="btn blue">
                    <span>Image</span>
                    <input id="file_pict" type="file" name="imagePochette">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <div class="col s8 offset-s2 center-align">
                <button class="btn waves-effect waves-light blue" type="submit" name="ajout_photo">Valider
                    <i class="material-icons right">add</i>
                </button>
            </div>
        </form>
        <div class="row">
            <img id="id_image_load" src="../../assets/img/<?= $row->disc_picture ?>" alt="Pochette" class="col m4 offset-m4 s6 offset-s3 responsive-img" title="image pochette">
        </div>
    </main>
        
<?php 
    } // fin de else if update
// AFFICHAGE DES MODIFICATIONS
    else if(isset ($_POST['modifier_self']))
    {
        $row_artist = update_disc($db);
        $row_cd = fetch_info_disc($db);?>
        <h1 class="center-align">Modifications</h1>
        <section class="container center-align blue-grey lighten-4 z-depth-3">
            <h2 class="center-align"><?= $row_cd->disc_title ?></h2>
            <h3 class="center-align"><?= $row_artist->artist_name ?></h3>
            <article class="center-align">
                <p>Année : <?= $row_cd->disc_year ?></p>
                <p>Genre : <?= $row_cd->disc_genre ?></p>
                <p>Label : <?= $row_cd->disc_label ?></p>
                <p>Prix : <?= $row_cd->disc_price ?></p>
            </article>
        </section>
        <?php
    }
    else 
    {
        echo 'Erreur durant la modification';
    }
?>
        
<?php include '../common/footer.php' ?>
