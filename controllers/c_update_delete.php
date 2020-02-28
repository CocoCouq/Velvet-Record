<?php 
    // Suppression d'un disque 
    function delete_disc($pdo)
    {
        $id_disc = sanitize_int($_POST['hiddenDisc']);

        $requete = 'DELETE FROM disc WHERE disc_id =:id_disc';
        $result = $pdo->prepare($requete);
        $result->bindValue(':id_disc', $id_disc);
        $result->execute();
        $result->closeCursor();
        // Redirection vers la liste des cd
        header('location:vue_cd.php');
    }
    
    // Update de la photo
    function update_pict($pdo)
    {
        $disc = sanitize_int($_POST['hiddenDisc']);
        
        // Recupération du disque du titre
        $requete = 'SELECT disc_title FROM disc WHERE disc_id=:discID';
        $result = $pdo->prepare($requete);
        $result->bindValue(':discID', $disc);
        $result->execute();
        $title = $result->fetch();
        $result->closeCursor();
        //Stockage du titre
        $title_final = $title->disc_title;
        
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
                if($size < 200000)
                {
                    // Mise en transaction pour s'assurer des l'upload avant le changement de nom 
                    try
                    {
                        // START TRANSACTION 
                        $trans = $pdo->prepare('START TRANSACTION');
                        $trans->execute();
                        $trans->closeCursor();


                        // Alors Upload du fichier 
                        move_uploaded_file($_FILES['imagePochette']['tmp_name'], $destination); 

                        // Changement du nom dans la base de donnée
                        $requete = 'UPDATE disc SET disc_picture =:nom_picture WHERE disc_id=:idDisc';
                        $result = $pdo->prepare($requete);
                        $result->bindValue(':nom_picture', $name_final);
                        $result->bindValue(':idDisc', $disc);
                        $result->execute();
                        $result->closeCursor();

                        // Affichage du résultat ?>
                        <h1 class="center-align flow-text">Téléchargement réussi</h1>
                        <h2 class="center-align"><?= $title_final ?></h2>
                        <p class="center-align">Nouvelle pochette :</p>
                        <div class="center-align"><img src="../../assets/img/<?= $name_final ?>" alt="Nouvelle image"></div><?php

                        // Commit 
                        $trans = $pdo->prepare('COMMIT');
                        $trans->execute();
                        $trans->closeCursor();
                        header('Refresh: 3; URL=vue_cd.php');
                    }
                    catch (Exception $e)
                    {
                        // RollBack
                        $trans = $pdo->prepare('ROLLBACK');
                        $trans->execute();
                        $trans->closeCursor();
                        echo 'Erreur pendant le chargemnt de la photo : '.$e->getMessage();
                    }
                }
                else
                {
                    echo 'Taille trop grande';
                    exit;
                }
            } 
            else // Si le type n'est pas autorisé
            {
               echo "Type de fichier non autorisé";  
               exit;
            }
        }
        else
        {
            echo 'Fichier trop grand ou non présent';
            exit;
        }
    }
    
    // Informations sur les disques
    function fetch_info_disc($pdo)
    {
        $disc = sanitize_int($_POST['hiddenDisc']);

        $requete = 'SELECT * FROM disc JOIN artist ON artist.artist_id = disc.artist_id WHERE disc_id = :disc';
        $result = $pdo->prepare($requete);
        $result->bindValue(':disc', $disc);
        $result->execute();
        $row = $result->fetch();
        $result->closeCursor();
        return $row;
    }
    
    // UPDATE 
    function update_disc($pdo)
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

        // UPDATE du disc 
        $requete = 'UPDATE disc SET disc_title =:titre, disc_label=:label, disc_genre=:genre, disc_year=:annee, disc_price=:prix, artist_id=:artist WHERE disc_id =:idDisc';

        $result = $pdo->prepare($requete);
        $result->execute($array_value);
        $result->closeCursor();

        // Selection de la table artist à retourner 
        $requete = 'SELECT * FROM artist WHERE artist_id=:artist';
        $result = $pdo->prepare($requete);
        $result->bindValue(':artist', $array_value[':artist']);
        $result->execute();
        $row_artist = $result->fetch();
        $result->closeCursor();

        return $row_artist;
    }

?>
