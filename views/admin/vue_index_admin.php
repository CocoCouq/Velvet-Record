<?php include '../common/header.php' ?>
<?php include '../../controllers/c_index_admin.php' ?>
<?php 
    session_start();
    if($_SESSION['auth'] == 'OK' && $_SESSION['role'] == 'Administrateur')
    {
?>
<h1 class="center-align">ESPACE ADMINISTRATEUR</h1>
<main class="blue-grey lighten-4 z-depth-3">
    <section class="row">
        <article class="col s6 offset-s1">
            <h2 class="center-align flow-text">Informations Utilisateurs</h2>
            <div class="divider"></div>
            <table class="striped responsive-table centered">
                <thead>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Validé</th>
                    <th>Role</th>
                </thead>
                <tbody>
                <?php 
                    foreach ($tableau as $row) { ?>
                        <tr>
                            <td><?= $row->user_name ?></td>
                            <td><?= $row->user_fst_name ?></td>
                            <td><?= $row->user_nk_name ?></td>
                            <td><?= $row->user_email ?></td>
                            <td><?= $row->user_confirm ? 'OK' : 'A valider' ?></td>
                            <td><?= $row->role_name ?></td>
                        </tr>
                <?php 
                    } ?>
                </tbody>
            </table> 
        </article>
        <aside class="col s4">
            <h2 class="flow-text center-align">Espace Gestion</h2>
            <div class="divider"></div>
            <div>
                <article>
                <h3 class="center-align flow-text">Utilisateurs</h3>
                <p class="center-align section">
                    <a class="btn" href="vue_gestion_admin.php" title="gestion">Gestion</a>
                </p>
                <p class="divider"></p>
                </article>
                <article>
                    <h3 class="center-align flow-text">Statistiques</h3>
                    <table>
                        <tr>
                            <th>Nombre de visites</th>
                            <td><?= aff_visite('../../assets/img/visite.txt') ?></td>
                        </tr>
                        <tr>
                            <th>Nombre d'Utilisateurs</th>
                            <td><?= count_role($db, 2) ?></td>
                        </tr>
                        <tr>
                            <th>Nombre d'administrateurs</th>
                            <td><?= count_role($db, 1) ?></td>
                        </tr>
                    </table>
                </article>
            </div>
        </aside>
    </section>
</main>
<?php
    }
    else 
    {
        header('location:../../index.php');
    }
?>
<?php include '../common/footer.php' ?>
