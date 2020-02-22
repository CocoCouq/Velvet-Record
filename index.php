<?php include 'models/connexion.php' ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/materialize.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>RECORD</title>
</head>
<body class="blue-grey darken-1">
    <header class="section row z-depth-2 valign-wrapper blue-grey lighten-4">
        <div class="col l1 offset-l1 m2 offset-m1 s3 offset-s1">
            <img class="responsive-img" src="assets/img/logo_record.png" title="Logo" alt="Logo Record">
        </div>
        <div class="col l4 offset-l5 m6 offset-m3 s8 offset-s1">
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
                <a href="#" class="brand-logo black-text col l3 offset-l1 hide-on-med-and-down" title="Accueil">Accueil</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text" title="Menu"><i class="material-icons">dehaze</i></a>
                <ul class="right hide-on-med-and-down col l4">
                    <li><a class=" black-text" href="views/users/vue_artistes.php" title="Artistes">Artistes</a></li>
                    <li><a class=" black-text" href="views/users/vue_cd.php" title="CD-ROM">CD-ROM</a></li>
                </ul>
            </div>
        </nav>
        <!-- Side Nav -->
        <div aria-label="mobile-demo" role="navigation">
            <ul class="sidenav blue-grey lighten-4" id="mobile-demo">
                <li><a href="#" title="Accueil">Accueil</a></li>
                <li><a href="views/users/vue_artistes.php" title="Artistes">Artistes</a></li>
                <li><a href="views/users/vue_cd.php" title="CD-ROM">CD-ROM</a></li>
                <li class="divider section teal"></li>
                <!-- Footer à partir de m size -->
                <li><a href="#" title="Mentions">Mentions Légales</a></li>
                <li><a href="#" title="Horaires">Horaires</a></li>
                <li><a href="#" title="Plan">Plan du site</a></li>
            </ul>
        </div>
    </section>
<!-- Main -->
    <main>
        <h1 class="center-align">Bienvenue</h1>
        <section class="blue-grey lighten-4 z-depth-2">
            <h2 class="flow-text center-align section">Velvet Records</h2>
            <article class="row section">
                <p class="col s10 offset-s1">Velvet Record vous souhaite la bienvenue sur son site.</p>
                <p class="col s10 offset-s1">Vous trouverez un large choix d'artistes, de CD-ROM pour passer des moments chaleureux au coin du feu. Nous vous remercions de porter votre interet sur notre site et nous vous souhaitons une bonne visite sur Velvet Record.</p>
                <b class="col s4 offset-s8">L'équipe Velvet Record</b>
            </article>
        </section>
        <section class="blue-grey lighten-4 z-depth-2">
            <h2 class="flow-text center-align section">Nos coups de coeurs</h2>
            <article class="row">
                <!--Ajouter 3 cd et 3 artistes--> 
                <p class="col s4 offset-s4 center-align">A venir</p>
            </article>
        </section>
    </main>
<!-- FOOTER -->
    <footer>
        <nav class="blue-grey lighten-4 z-depth-2 row hide-on-med-and-down" aria-label="navFooter">
            <ul class="col offset-s4">
                <li>
                    <a class="black-text" href="#" title="Mentions">Mentions légales</a>
                </li>
                <li>
                    <a class="black-text" href="#" title="Horaires">Horaires</a>
                </li>
                <li>
                    <a class="black-text" href="#" title="Plan">Plan du site</a>
                </li>
            </ul>
        </nav>
    </footer>
</body>
<script src="assets/js/materialize.js"></script>
<script src="assets/js/index.js"></script>
</html>