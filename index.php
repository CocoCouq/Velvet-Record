<?php include 'models/connexion.php' ?>
<?php include 'controllers/c_index.php' ?>

<?php 
    session_start();
    if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 'OK')
    {
        header('location:views/users/vue_login.php');
        exit;
    }
?>

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
        <div class="col l4 offset-l5 m5 offset-m2 s5 offset-s1">
            <div class="row">
                <blockquote id="slogan" cite="Oxmo Puccino" class="col s12">"Le talent, c'est l'audace que les autres n'ont pas."</blockquote>
                <small class="col l5 offset-l6 m6 offset-m7 s7 offset-s6">Oxmo Puccino</small>
            </div>
        </div>
        <div id="roleDisp" class="z-depth-2 blue-grey lighten-5">
            <?= $_SESSION['role'] ?>
        </div>
    </header>
<!-- NAVBAR -->
    <section class="section">
        <nav class="blue-grey lighten-4 z-depth-2">
            <div class="nav-wrapper row">
                <a href="#" class="brand-logo black-text col l3 offset-l1 hide-on-med-and-down" title="Accueil">Accueil</a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger black-text" title="Menu"><i class="material-icons">dehaze</i></a>
                <ul class="right hide-on-med-and-down col l3">
                    <li><a class="black-text" href="views/users/vue_artistes.php" title="Artistes">Artistes</a></li>
                    <li><a class="black-text" href="views/users/vue_cd.php" title="CD-ROM">CD-ROM</a></li>
                    <li class="z-depth-1"><a class="black-text" href="views/users/vue_login.php"><i class="material-icons">perm_identity</i></a></li>
                </ul>
            </div>
        </nav>
        <!-- Side Nav -->
        <div aria-label="mobile-demo" role="navigation">
            <ul class="sidenav blue-grey lighten-4" id="mobile-demo">
                <li><a class="black-text" href="views/users/vue_login.php"><i class="material-icons">perm_identity</i>Identification</a></li>
                <li class="divider teal"></li>
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
        <h1 class="center-align">Bienvenue <?= $_SESSION['login'] ?></h1>
        <section class="blue-grey lighten-4 z-depth-2">
            <h2 class="flow-text center-align section">Velvet Records</h2>
            <article class="row section">
                <p class="col s10 offset-s1">Velvet Record vous souhaite la bienvenue sur son site.</p>
                <p class="col s10 offset-s1">Vous trouverez un large choix d'artistes, de CD-ROM pour passer des moments chaleureux au coin du feu. Nous vous remercions de porter votre interet sur notre site et nous vous souhaitons une bonne visite sur Velvet Record.</p>
                <b class="col s4 offset-s8">L'équipe Velvet Record</b>
            </article>
        </section>
<!-- Nouveautés -->       
        <section class="blue-grey lighten-4 z-depth-2 hide-on-med-and-down">
            <h3 class="center-align section">Nouveautés</h3>
            <article class="row">
                <!--Ajouter 3 cd et 3 artistes--> 
                <?php foreach ($tableau as $new) { ?>
                    <div class="cardCD col l4 section">
                        <div class="card blue-grey darken-4">
                            <div class="card-content white-text">
                                <span class="card-title titleDisc center-align z-depth-4 section blue-grey"><?= $new->disc_title ?></span>
                                <h4 class="artistCDcard center-align light-blue-text"><?= $new->artist_name ?></h4>
                                <article class="center-align">
                                    <p class="flow-text">Genre</p>
                                    <p class="genreDisc"><?= $new->disc_genre ?></p>
                                </article>
                                    <article class="row valign-wrapper">
                                        <img class="responsive-img col l6 offset-l3" src="assets/img/<?= $new->disc_picture ?>" alt="ImagesDisques" title="images cd-rom">
                                    </article>
                                <article class="col s4 offset-s4 center-align">
                                    <p class="divider section blue-grey darken-4"></p>
                                    <div class="articlePrix blue-grey lighten-4 black-text z-depth-3">
                                        <p class="flow-text z-depth-1">Prix</p>
                                        <p><?= $new->disc_price ?>€</p>
                                    </div>
                                </article>
                            </div>
                            <div class="card-action">
                                <form class="row" action="views/users/vue_details_cd.php" method="get">
                                    <input type="hidden" value="<?= $new->disc_id ?>" name="disc_id">
                                    <input class="waves-effect waves-light btn col s4 offset-s4" type="submit" value="Voir">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </article>
        </section>
    </main>
<!-- FOOTER -->
    <footer>
        <nav class="blue-grey lighten-4 z-depth-2 hide-on-med-and-down" aria-label="navFooter">
            <ul class="row center-align">
                <li class="col s4">
                    <a class="black-text" href="" title="Mentions">Mentions légales</a>
                </li>
                <li class="col s4">
                    <a class="black-text" href="" title="Horaires">Horaires</a>
                </li>
                <li class="col s4">
                    <a class="black-text" href="" title="Plan">Plan du site</a>
                </li>
            </ul>
        </nav>
    </footer>
</body>
<script src="assets/js/materialize.js"></script>
<script src="assets/js/index.js"></script>
</html>