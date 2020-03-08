<?php include '../common/header.php' ?>
<?php 
    session_start();
    if($_SESSION['auth'] == 'OK' && $_SESSION['role'] == 'Administrateur')
    {
?>

<h1 class="center-align">Administration</h1>
<form class="container section" action="../../controllers/c_gestion_admin.php" method="post">
    <label class="flow-text" for="input_admin">
    <input type="text" id="input_admin" name="input_admin" placeholder="Pseudo ou adresse email de l'utilisateur">
    </label>
    <div class="section center-align">
        <button class="btn waves-effect waves-light" type="submit" name="verif_user">Email OK
            <i class="material-icons right">mail</i>
        </button>
        <button class="btn waves-effect waves-light blue" type="submit" name="role_user">Promouvoir
            <i class="material-icons right">rowing</i>
        </button>
        <button class="btn waves-effect waves-light red" type="submit" name="delete_user">Supprimer
            <i class="material-icons right">delete</i>
        </button>
    </div>
</form>
<?php
    }
    else 
    {
        header('location:../../index.php');
    }
?>
<?php include '../common/footer.php' ?>
