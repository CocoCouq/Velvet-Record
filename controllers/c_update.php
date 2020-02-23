<?php  
// Récupération des valeurs
$array_value = array(
    ':idDisc' => htmlspecialchars($_POST['hiddenDisc']),
    ':titre' => htmlspecialchars($_POST['Titre']),
    ':label' => htmlspecialchars($_POST['Label']),
    ':genre' => htmlspecialchars($_POST['Genre']),
    ':annee' => htmlspecialchars($_POST['Annee']),
    ':prix' => htmlspecialchars($_POST['Prix']),
    ':artist' => htmlspecialchars($_POST['Artist'])
);

$requete = 'UPDATE disc SET disc_title =:titre, disc_label=:label, disc_genre=:genre, disc_year=:annee, disc_price=:prix, artist_id=:artist WHERE disc_id =:idDisc';

$result = $db->prepare($requete);
$result->execute($array_value);
$result->closeCursor();
?>
<?php

$requete = 'SELECT * FROM artist WHERE artist_id=:artist';
$result = $db->prepare($requete);
$result->bindValue(':artist', $array_value[':artist']);
$result->execute();
$row_artist = $result->fetch();
$result->closeCursor();

?> 
