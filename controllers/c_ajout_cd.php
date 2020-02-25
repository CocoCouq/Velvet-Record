<?php 

// Recuperation du nom de photo
$title_final = htmlspecialchars($_POST['Titre']);
$type_ini = $_FILES['imagePochette']['type'];
$index_slash = strpos($type_ini, '/') + 1;
$extension = substr($type_ini, $index_slash);
$name_final = $title_final.".".$extension;

// Recuperation des valeurs
$array_ajout = array(
    ':titre' => htmlspecialchars($_POST['Titre']),
    ':label' => htmlspecialchars($_POST['Label']),
    ':genre' => htmlspecialchars($_POST['Genre']),
    ':annee' => htmlspecialchars($_POST['Annee']),
    ':prix' => htmlspecialchars($_POST['Prix']),
    ':artist' => htmlspecialchars($_POST['Artist']),
    ':picture' => $name_final
);



$requete = 'INSERT INTO disc(disc_title, disc_label, disc_genre, disc_year, disc_price, artist_id, disc_picture) VALUE (:titre, :label, :genre, :annee, :prix, :artist, :picture)';
$result = $db->prepare($requete);
$result->execute($array_ajout);
$result->closeCursor();

$destination = '/Applications/MAMP/htdocs/Zone/Record/assets/img/'.$name_final;
$aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");
$size = $_FILES['imagePochette']['size'];

$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimetype = finfo_file($finfo, $_FILES["imagePochette"]["tmp_name"]);
finfo_close($finfo);

if (in_array($mimetype, $aMimeTypes))
{
    if($size < 100000)
    {
        move_uploaded_file($_FILES['imagePochette']['tmp_name'], $destination);
    }
    else
    {
        echo 'Taille trop grande';
    }
} 
else 
{
   // Le type n'est pas autorisé, donc ERREUR
 
   echo "Type de fichier non autorisé";    
   exit;
}

?>