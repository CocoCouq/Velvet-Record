<?php  
$disc = htmlspecialchars($_POST['hiddenDisc']);
$requete = 'SELECT disc_title FROM disc WHERE disc_id=:discID';
$result = $db->prepare($requete);
$result->bindValue(':discID', $disc);
$result->execute();
$title = $result->fetch();
$result->closeCursor();
$title_final = $title->disc_title;
$type_ini = $_FILES['imagePochette']['type'];
$index_slash = strpos($type_ini, '/') + 1;
$extension = substr($type_ini, $index_slash);
$name_final = $title_final.".".$extension;

$requete = 'UPDATE disc SET disc_picture =:nom_picture WHERE disc_id=:idDisc';
$result = $db->prepare($requete);
$result->bindValue(':nom_picture', $name_final);
$result->bindValue(':idDisc', $disc);
$result->execute();
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
        move_uploaded_file($_FILES['imagePochette']['tmp_name'], $destination); ?>
        <p class="center-align flow-text">Téléchargement réussi</p>
        <p class="center-align red-text">Redirection dans 5 secondes</p><?php
        header('Refresh: 4; URL=vue_cd.php');
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
