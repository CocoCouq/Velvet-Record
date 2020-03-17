<?php include '../../controllers/users/c_ajout_cd.php' ?>
<?php include '../common/header.php' ?>

<?php 
    if(isset($_POST['modifier_self']) && count($tabErreur) == 0)
    {  ?>
        <main>
            <div class="row section valign-wrapper">
                <p class="col offset-s1 flow-text white-text">Ajouter un autre</p>
                <a href="vue_ajout_cd.php" class="btn-floating btn-large waves-effect waves-light col" title="Ajouter un autre"><i class="material-icons">add</i></a>

                <p class="col offset-s1 flow-text white-text">Retour aux CD</p>
                <a href="vue_cd.php" class="btn-floating btn-large waves-effect waves-light col" title="Ajouter un autre"><i class="material-icons">undo</i></a>
            </div>
            <h1 class="center-align">CD-ROM ajouté</h1>
            <table class="container striped centered section">
                <thead>
                    <tr>
                        <th class="flow-text">Artiste</th>
                        <th class="flow-text"><?= $array_ajout[':titre'] ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Genre</td>
                        <td><?= $array_ajout[':genre'] ?></td>
                    </tr>
                    <tr>
                        <td>Label</td>
                        <td><?= $array_ajout[':label'] ?></td>
                    </tr>
                    <tr>
                        <td>Année</td>
                        <td><?= $array_ajout[':annee'] ?></td>
                    </tr>
                    <tr>
                        <td>Prix</td>
                        <td><?= $array_ajout[':prix'] ?>€</td>
                    </tr>
                </tbody>
            </table>
            <div class="center-align">
                <img src="../../assets/img/<?= $array_ajout[':picture'] ?>" alt="Image Ajouté">
            </div>
        </main>

  <?php } 
        else 
        { ?>


                <!-- ********** FORMULAIRE D'AJOUT ********** -->
<main>
    <form class="container" action="<?php print $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div class="input-field">
            <input name="Titre" id="upTitre" type="text" class="validate" value="">
            <label for="upTitre">Titre</label>
            <span class="red-text" id="errAddTitle"><?= $tabErreur['title'] ?: '' ?></span>
        </div>
        <div>
            <div class="input-field">
<!--SELECT-->
                <select id="selectArtiste" name="Artist">
                    <option value="0" disabled selected>Choisissez</option>
                    
                    <?php 
                        $row_artiste = list_artist();
                        foreach ($row_artiste as $line) { ?>
                    <option value="<?= $line->artist_id ?>"><?= $line->artist_name ?></option>
                    <?php } ?>
                    
                </select>
                <label for="selectArtist">Artiste</label>
            </div>
            <span class="red-text" id="errAddArt"><?= $tabErreur['artist'] ?: '' ?></span>
        </div>
        <div class="input-field">
            <input name="Annee" id="upAnnee" type="text" class="validate" value="">
            <label for="upAnnee">Année</label>
            <span class="red-text" id="errAddYear"><?= $tabErreur['year'] ?: '' ?></span>
        </div>
        <div class="input-field">
            <input name="Genre" id="upGenre" type="text" class="validate" value="">
            <label for="upGenre">Genre</label>
            <span class="red-text" id="errAddGenre"><?= $tabErreur['genre'] ?: '' ?></span>
        </div>
        <div class="input-field">
            <input name="Label" id="upLabel" type="text" class="validate" value="">
            <label for="upLabel">label</label>
            <span class="red-text" id="errAddLabel"><?= $tabErreur['label'] ?: '' ?></span>
        </div>
        <div class="input-field">
            <input name="Prix" id="upPrix" type="text" class="validate" value="">
            <label for="upPrix">Prix</label>
            <span class="red-text" id="errAddPrice"><?= $tabErreur['prix'] ?: '' ?></span>
        </div>
    <!--Faire l'ajout de photo-->
        <div class="row">
            <div class="file-field input-field col l4 offset-l4 m6 offset-m3 s8 offset-s2">
                <div class="btn blue">
                    <span>Image</span>
                    <input id="file_pict" type="file" name="imagePochette">
                </div>
                <div class="file-path-wrapper">
                    <input id="valuePict" name="valuePict" class="file-path validate" type="text">
                </div>
            </div>
            <span class="red-text col l8 offset-l4 m9 offset-m3 s10 offset-s2" id="errAddPict"><?= $tabErreur['photo'] ?: '' ?></span>
        </div>
        <div class="row" id="divImage_ajout">
            <img class="col m2 offset-m5 s4 offset-s4" id="id_image_load" src="../../assets/img/ajout_image.png" alt="Image">
        </div>
        <div class="row">
            <button id="add_cd" class="btn waves-effect waves-light col" type="submit" name="modifier_self">Ajouter
                <i class="material-icons right">add</i>
            </button>
            <div class="col">
                <input id="returnBtn" class="btn red" type="button" value="Retour" name="Retour">
            </div>
        </div>
    </form>
</main>
  <?php } ?>
                
<?php include '../common/footer.php' ?>
