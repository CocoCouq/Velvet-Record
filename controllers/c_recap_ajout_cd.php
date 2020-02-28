<?php 

// Recuperation du nom de photo
$title_final = sanitize_str($_POST['Titre']);
$info = new SplFileInfo($_FILES['imagePochette']['name']);
$extension = $info->getExtension();
$name_final = $title_final.".".$extension;

// Recuperation des valeurs
$array_ajout = array(
    ':titre' => $title_final,
    ':label' => sanitize_str($_POST['Label']),
    ':genre' => sanitize_str($_POST['Genre']),
    ':annee' => sanitize_int($_POST['Annee']),
    ':prix' => sanitize_float($_POST['Prix']),
    ':artist' => sanitize_str($_POST['Artist']),
    ':picture' => $name_final
);
 
  
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
    if($size < 200000)
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
            echo 'Erreur pendant le chargemnt du formulaire : '.$e->getMessage();
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
    

