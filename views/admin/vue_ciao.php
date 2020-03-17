<?php include '../common/header.php' ?>

<?php 
    if($_GET['rep'] == '1' || $_GET['rep'] == '2') 
    {
        unset($_SESSION['login']);
        unset($_SESSION['auth']);
        unset($_SESSION['role']);
        unset($_SESSION['user_id']);
        unset($_SESSION['erreurlogin']);

        if(ini_get("session.use_cookies"))
        {
            setcookie(session_name(), '', time()-84600);
        }
        session_destroy();
        
        if($_GET['rep'] == '1')
        { ?>
            <h1 class="center-align">Suppression de compte</h1>
            <main class="center-align">
                <p class="flow-text">Toutes vos informations ont étaient supprimées de notre base de donnée</p>
            </main> <?php
            header('Refresh: 5; URL=../login/vue_login.php');
        }
        else 
        { ?>
            <h1 class="center-align">Suppression de compte</h1>
            <main class="center-align">
                <p class="flow-text">Dans la vie, faut faire des choix</p>
                <p class="red-text">Si tu hésites on choisira toujours pour toi</p>
            </main> <?php
            header('Refresh: 8; URL=../login/vue_login.php');
        }
    }
        
       
?>

<?php include '../common/footer.php' ?>
