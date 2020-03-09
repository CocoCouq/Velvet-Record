<?php

    $message = 
'<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>INSCRIPTION RECORD</title>
</head>
<body class="blue-grey lighten-1">
    <header>
        <h1 class="center-align card-panel blue-grey lighten-4">Validation d\'Email</h1>
        <section>
            <article class="card-panel blue-grey lighten-4">
                <h2 class="flow-text center-align">Bienvenue sur Velvet Record'.$array_user['first_name'].'</h2>
                <p class="center-align">Afin de vérifier votre identité merci de cliquer sur le bouton suivant :</p>
            </article>
        </section>
    </header>
    
    <main class="row">
        <section class="center-align blue-grey lighten-4 col l4 offset-l4 m6 offset-m3 s8 offset-s2 z-depth-1 section">
            <h3 class="flow-text blue-text">Modifier le mot de passe</h3>
            <article class="section">
                <a class="btn blue section" href="http://localhost:8888/Zone/Record/views/users/vue_modif_pwd.php?id='. urlencode($tab->user_nk_name).'&key='.urlencode(bin2hex($key)).'">Cliquez ici</a>
            </article>
        </section>
    </main>
    
    <footer class="page-footer blue-grey lighten-4">
        <section class="center-align">
            <h4>Rejoignez-nous sur <a href="http://localhost:8888/Zone/Record/index.php">www.velvet-record.com</a></h4>
            <article>
                <p class="divider"></p>
                <p><a href="#">se désinscrire</a></p>
                <p class="flow-text"><a href="https://fr.wikihow.com/remplir-un-ch%C3%A8que">FAIRE UN DON</a></p>
            </article>
        </section>
        <section class="footer-copyright">
            <article class="container">
                <p>© 2020 Velvet Record</p>
            </article>
        </section>
    </footer>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</html>';

?>

