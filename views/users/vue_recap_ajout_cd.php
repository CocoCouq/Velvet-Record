<?php include '../common/header.php' ?>
<?php include '../../controllers/c_ajout_cd.php' ?>

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

<?php include '../common/footer.php' ?>
