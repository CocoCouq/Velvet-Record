<?php include '../common/header.php' ?>

<main>
    <form class="container" action="vue_recap_ajout_cd.php" method="post" enctype="multipart/form-data">
        <div class="input-field">
            <input name="Titre" id="upTitre" type="text" class="validate" value="">
            <label for="upTitre">Titre</label>
        </div>
        <div>
            <div class="input-field">
                <select id="selectArtiste" name="Artist">
                    <option value="0" disabled selected>Choisissez</option>
                    <?php 
                        include '../../controllers/c_detail_artist.php'; 
                        foreach ($row_artiste as $line) {
                    ?>
                    <option value="<?= $line->artist_id ?>"><?= $line->artist_name ?></option>
                    <?php } ?>
                </select>
                <label for="selectArtist">Artiste</label>
            </div>
        </div>
        <div class="input-field">
            <input name="Annee" id="upAnnee" type="text" class="validate" value="">
            <label for="upAnnee">Année</label>
        </div>
        <div class="input-field">
            <input name="Genre" id="upGenre" type="text" class="validate" value="">
            <label for="upGenre">Genre</label>
        </div>
        <div class="input-field">
            <input name="Label" id="upLabel" type="text" class="validate" value="">
            <label for="upLabel">label</label>
        </div>
        <div class="input-field">
            <input name="Prix" id="upPrix" type="text" class="validate" value="">
            <label for="upPrix">Prix</label>
        </div>
    <!--Faire l'ajout de photo-->
        <div class="row">
            <div class="file-field input-field col l4 offset-l4 m6 offset-m3 s8 offset-s2">
                <div class="btn blue">
                    <span>Image</span>
                    <input id="file_pict" type="file" name="imagePochette">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
        </div>
        <div class="row" id="divImage_ajout">
            <img class="col m2 offset-m5 s4 offset-s4" id="id_image_load" src="../../assets/img/ajout_image.png" alt="Image">
        </div>
        <div class="row">
            <button class="btn waves-effect waves-light col" type="submit" name="modifier_self">Ajouter
                <i class="material-icons right">add</i>
            </button>
            <div class="col">
                <input id="returnBtn" class="btn red" type="button" value="Retour" name="Retour">
            </div>
        </div>
    </form>
</main>

<?php include '../common/footer.php' ?>
