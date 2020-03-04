<?php include '../../controllers/lib/library.php' ?>
<?php include '../../models/connexion.php' ?>
<?php 
    session_start();
    if(basename($_SERVER['PHP_SELF']) != 'vue_login.php' && basename($_SERVER['PHP_SELF']) != 'vue_new_user.php')
    {    
        if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 'OK' || ($_SESSION['auth'] == 'OK' && $_SESSION['role'] == 'Non vérifiés'))
        {
            header('location:vue_login.php');
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="../../assets/css/material_icons.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/materialize.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RECORD</title>
</head>
<body class="blue-grey darken-1">
    <header class="section row z-depth-2 valign-wrapper blue-grey lighten-4">
        <div class="col l1 offset-l1 m2 offset-m1 s3 offset-s1">
            <img class="responsive-img" src="../../assets/img/logo_record.png" title="Logo" alt="Logo Record">
        </div>
        <div class="col l4 offset-l5 m5 offset-m2 s6 offset-s1">
            <div class="row">
                <blockquote id="slogan" cite="Oxmo Puccino" class="col s12">"Le talent, c'est l'audace que les autres n'ont pas."</blockquote>
                <small class="col l5 offset-l6 m6 offset-m7 s7 offset-s6">Oxmo Puccino</small>
            </div>
        </div>
    </header>
<!-- NAVBAR -->
    <section class="section">
        <nav class="blue-grey lighten-4 z-depth-2">
            <div class="nav-wrapper row">
                <a href="../../index.php" class="brand-logo black-text col l3 offset-l1 hide-on-med-and-down" title="Accueil">Accueil</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text" title="Menu"><i class="material-icons">dehaze</i></a>
                <ul class="right hide-on-med-and-down col l3">
                    <li><a class=" black-text" href="../users/vue_artistes.php" title="Artistes">Artistes</a></li>
                    <li><a class=" black-text" href="../users/vue_cd.php" title="CD-ROM">CD-ROM</a></li>
                    <li class="z-depth-1"><a class="black-text" href="../users/vue_login.php"><i class="material-icons">perm_identity</i></a></li>
                </ul>
            </div>
        </nav>
        <!-- Side Nav -->
        <div aria-label="mobile-demo" role="navigation">
            <ul class="sidenav blue-grey lighten-4" id="mobile-demo">
                <li><a class="black-text" href="../users/vue_login.php"><i class="material-icons">perm_identity</i>Identification</a></li>
                <li class="divider teal"></li>
                <li><a href="../../index.php" title="Accueil">Accueil</a></li>
                <li><a href="../users/vue_artistes.php" title="Artistes">Artistes</a></li>
                <li><a href="../users/vue_cd.php" title="CD-ROM">CD-ROM</a></li>
                <li class="divider section teal"></li>
                <!-- Footer à partir de m size -->
                <li><a href="#" title="Mentions">Mentions Légales</a></li>
                <li><a href="#" title="Horaires">Horaires</a></li>
                <li><a href="#" title="Plan">Plan du site</a></li>
            </ul>
        </div>
    </section>