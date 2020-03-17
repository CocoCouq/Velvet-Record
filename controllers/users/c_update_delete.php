<?php 
    include '../../controllers/lib/library.php';
    require_once '../../models/m_disc.php';
    require_once '../../models/m_artist.php';
    
// Declaration d'un tableau d'erreur
    $tabErreur = [];

// Suppression d'un disque 
    function delete_disc()
    {
        $id = sanitize_int($_POST['hiddenDisc']);

        $disc = new Disc();
        $disc->del_disc($id);
        // Redirection vers la liste des cd
        header('location:vue_cd.php');
    }
//////////////////////////////////////////////////////////////////////////////////
                            /* FORMULAIRE UPDATE PHOTO */
 
    // Update de la photo
    function update_pict()
    {
        // True si pas d'erreur (valeur a retourner pour affichage du bouton retour)
        $valide = true;
        
        $id = sanitize_int($_POST['hiddenDisc']);
        
        $disc = new Disc();
        
        // Recupération du disque du titre
        $row = $disc->disc_infos($id);
        //Stockage du titre
        $title_final = $row->disc_title;
        
        // Recupération de la taille
        $size = $_FILES['imagePochette']['size'];
        
        
        if(!empty($_FILES['imagePochette']['name']) && $_FILES['imagePochette']['size'] > 0)
        {
            // Tableau des extensions autorisés
            $aExt = array('gif', 'jpeg', 'jpg', 'png', 'tif', 'tiff');
            
            // Recupération de l'extension
            $info = new SplFileInfo($_FILES['imagePochette']['name']);
            $extension = $info->getExtension();
              
            
            // Tableau des MIME TYPE autorisés 
            $aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");
            
            // Recupération du MIME TYPE dans le tableau $mimetype
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mimetype = finfo_file($finfo, $_FILES["imagePochette"]["tmp_name"]);
            finfo_close($finfo);
            
            
            // Si le MIME TYPE et l'estension sont dans les tableaux autorisés
            if (in_array($mimetype, $aMimeTypes) && in_array($extension, $aExt))
            {   
                // Nom et destination final
                $title_final = str_replace(' ', '_', $title_final);
                $name_final = $title_final.".".$extension;
                $destination = '../../assets/img/'.$name_final;


                // 2Mo
                if($size < 2000000)
                {
                    $disc = new Disc();
                    $disc->update_pict($id, $destination, $name_final);
                }
                else
                { ?>
                    <h1 class="center-align flow-text red-text">Image trop grande</h1><?php
                    $valide = false;
                }
            } 
            else // Si le type n'est pas autorisé
            { ?>
               <h1 class="center-align flow-text red-text">Type de fichier non autorisé</h1><?php
               $valide = false;
            }
        }
        else
        { ?>
            <h1 class="center-align flow-text red-text">Fichier trop grand ou non présent</h1><?php 
            $valide = false;
        }
        // Bouton retour (presence)
        return $valide;
    }
    
/////////////////////////////////////////////////////////////////////////////////
        // Informations sur les disques
    function fetch_info_disc()
    {
        $id = sanitize_int($_POST['hiddenDisc']);
        
        $disc = new Disc();
        $row = $disc->disc_infos($id);
        
        return $row;
    }
//////////////////////////////////////////////////////////////////////////////////
                            /* FORMULAIRE UPDATE */     

        // REGEX 
        $filtreText = '/(^[\wéèêëûüîïôàçæœ\(\)\&\s\-\.\,\_\+\=\/\%€@\'\"\*\\`\!\?\;\[\]]*$)/i';
        $filtrePrix = '/(^[0-9]{1,4}\.[0-9]{2}$)/';
        $filtreYear = '/(^(19|20){1}[0-9]{2}$)/';
             
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

        }
 
    // UPDATE 
    function update_disc()
    {
        // Récupération des valeurs dans un tableau
        $array_value = array(
            ':idDisc' => sanitize_int($_POST['hiddenDisc']),
            ':titre' => sanitize_str($_POST['Titre']),
            ':label' => sanitize_str($_POST['Label']),
            ':genre' => sanitize_str($_POST['Genre']),
            ':annee' => sanitize_int($_POST['Annee']),
            ':prix' => sanitize_float($_POST['Prix']),
            ':artist' => sanitize_str($_POST['Artist'])
        );
        
        $disc = new Disc();
        
        // UPDATE du disc 
        $disc->up_disc($array_value);

        // Selection de la table artist à retourner 
        $artist = new Artist();
        $row_artist = $artist->infos_artist($array_value[':artist']);

        return $row_artist;
    }
    
    /////////////////////////////////////////////////////////////////////////////
    
    // Artistes INFOS
    function artist_detail()
    {
        $artist = new Artist();
        $table = $artist->details_artist();

        return $table;
    }

?>
