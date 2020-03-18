<?php 
    include '../../controllers/lib/library.php';
    require_once '../../models/m_artist.php';
    
// REGEX 
    $filtre_artist = '/^[\wéèêëûüîïôàçæœ\(\)\&\s\-\.\,\_\+\=\/\%€@\'\"\*\\`\!\?\;\[\]]*$/i';

    if(isset($_POST['ajout_artist']))
    { 
        if(!empty($_POST['Artist']))
        {
            // Insertion d'un artiste et redirection 
            if(preg_match($filtre_artist, $_POST['Artist']))
            {
                $name = sanitize_str($_POST['Artist']);
                
                $artist = new Artist();
                $artist->add_artist($name);
                
                header('location:vue_artistes.php');
            }
            else 
            {
                $err_art = 'Vous utilisez des caratères interdits';
            }
        }
        else 
        {
            $err_art = 'Remplissez le champs';
        }
    }
?>
