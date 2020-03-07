<?php 
    // Liste des artistes pour le select 
    function list_artist($pdo)
    {
        // Recupération des artistes pour les options du select 
        $requete = 'SELECT * FROM artist ORDER BY artist_name';
        $result = $pdo->prepare($requete);
        $result->execute();
        $row_artiste = $result->fetchAll();
        $result->closeCursor();
        return $row_artiste;
    }
    
//////////////////////////////////////////////////////////////////////////////////
                        /* TRAITEMENT FORMULAIRE */    
    
    
    // Declaration d'un tableau d'erreur
    $tabErreur = [];

    // REGEX 
    $filtreText = '/(^[\wéèêëûüîïôàçæœ\(\)\&\s\-\.\,\_\+\=\/\%€@\'\"\*\\`\!\?\;\[\]]*$)/i';
    $filtrePrix = '/(^[0-9]{1,4}\.[0-9]{2}$)/';
    $filtreYear = '/(^(19|20){1}[0-9]{2}$)/';
    $filtrePict = '/(.(\.\w{1,5})?\.(png|tif|gif|jpg|jpeg|tiff))/';

    // Si le bouton submit de 'modifier' est envoyé
    if(isset($_POST['modifier_self']))
    {
    // Verification des champs et récupération des erreurs
        // Titre
        if(!empty($_POST['Titre']))
        {
            if(!preg_match($filtreText, $_POST['Titre']))
            {
                $tabErreur['title'] = 'Vous utilisez des caractères interdits';
            }
        }
        else 
        {
            $tabErreur['title'] = 'Renseignez le champs';
        }

        // Genre
        if(!empty($_POST['Genre']))
        {
            if(!preg_match($filtreText, $_POST['Genre']))
            {
                $tabErreur['genre'] = 'Vous utilisez des caractères interdits';
            }
        }
        else 
        {
            $tabErreur['genre'] = 'Renseignez le champs';
        }

        // Label 
        if(!empty($_POST['Label']))
        {
            if(!preg_match($filtreText, $_POST['Label']))
            {
                $tabErreur['label'] = 'Vous utilisez des caractères interdits';
            }
        }
        else 
        {
            $tabErreur['label'] = 'Renseignez le champs';
        }

        // Prix 
        if(!empty($_POST['Prix']))
        {
            if(!preg_match($filtrePrix, $_POST['Prix']))
            {
                $tabErreur['prix'] = 'Vous utilisez des caractères interdits';
            }
        }
        else 
        {
            $tabErreur['prix'] = 'Renseignez le champs';
        }

        // Année
        if(!empty($_POST['Annee']))
        {
            if(!preg_match($filtreYear, $_POST['Annee']))
            {
                $tabErreur['year'] = 'Vous utilisez des caractères interdits';
            }
        }
        else 
        {
            $tabErreur['year'] = 'Renseignez le champs';
        }

        // Artiste
        if($_POST['Artist'] == null)
        {
            $tabErreur['artist'] = 'Renseignez le champs';
        }
        
        // Photo
        if(!empty($_POST['valuePict']))
        {
            if(!preg_match($filtrePict, $_POST['valuePict']))
            {
                $tabErreur['photo'] = 'Vous utilisez des caractères interdits';
            }
        }
        else 
        {
            $tabErreur['photo'] = 'Renseignez le champs';
        }

        // Verfication qu'aucune erreur n'est présente
        if(count($tabErreur) == 0)
        {

            // Recuperation du nom de photo
            $title_final = sanitize_str($_POST['Titre']);
            $info = new SplFileInfo($_FILES['imagePochette']['name']);
            $extension = $info->getExtension();
            $name_final = $title_final.".".$extension;

            // Recuperation des valeurs & nettoyage 
            $array_ajout = array(
                ':titre' => $title_final,
                ':label' => sanitize_str($_POST['Label']),
                ':genre' => sanitize_str($_POST['Genre']),
                ':annee' => sanitize_int($_POST['Annee']),
                ':prix' => sanitize_float($_POST['Prix']),
                ':artist' => sanitize_str($_POST['Artist']),
                ':picture' => $name_final
            );



    /* PHOTO */
            // Recupération de la taille
            $size = $_FILES['imagePochette']['size'];

            // Tableau des extensions autorisés
            $aExt = array('gif', 'jpeg', 'jpg', 'png', 'tif', 'tiff');

            // Tableau des MIME TYPE autorisés 
            $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

            // Recupération du MIME TYPE dans le tableau $mimetype
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimetype = finfo_file($finfo, $_FILES["imagePochette"]["tmp_name"]);
            finfo_close($finfo);


            // Si le MIME TYPE et l'extension sont dans les tableaux autorisés
            if (in_array($mimetype, $aMimeTypes) && in_array($extension, $aExt))
            {   
                $destination = '../../assets/img/'.$name_final;


                // 2Mo
                if($size < 2000000)
                {
                    // Mise en transaction
                    try
                    {
                        // START TRANSACTION 
                        $trans = $db->prepare('START TRANSACTION');
                        $trans->execute();
                        $trans->closeCursor();

                        // Alors Upload du fichier 
                        move_uploaded_file($_FILES['imagePochette']['tmp_name'], $destination); 

     // Insertion des valeurs dans la table
                        $requete = 'INSERT INTO disc(disc_title, disc_label, disc_genre, disc_year, disc_price, artist_id, disc_picture) VALUE (:titre, :label, :genre, :annee, :prix, :artist, :picture)';
                        $result = $db->prepare($requete);
                        $result->execute($array_ajout);
                        $result->closeCursor();

                        // Commit 
                        $trans = $db->prepare('COMMIT');
                        $trans->execute();
                        $trans->closeCursor();
                    }
                    catch (Exception $e)
                    {
                        // RollBack
                        $trans = $db->prepare('ROLLBACK');
                        $trans->execute();
                        $trans->closeCursor();
                        echo 'Erreur pendant le chargement du formulaire : '.$e->getMessage();
                    }
                }
                else
                { ?>
                    <h1 class="center-align flow-text">Taille de l'image trop grande</h1><?php
                    exit;
                }
            } 
            else // Si le type n'est pas autorisé
            { ?>
                <h1 class="center-align flow-text">La format de l'image n'est pas autorisé</h1><?php 
                exit;
            }
        }
    }

?>
