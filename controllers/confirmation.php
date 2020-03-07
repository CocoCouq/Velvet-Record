<?php
    include_once '../models/connexion.php';
    $id = urldecode($_GET['id']);
    $key = urldecode($_GET['key']);
    
    $requete = 'SELECT user_id, user_key, user_confirm FROM user WHERE user_nk_name =:pseudo';
    $result = $db->prepare($requete);
    $result->bindValue(':pseudo', $id);
    $result->execute();
    $row = $result->fetch();
    $result->closeCursor();
    
    $valid_key = (intval($row->user_key) == intval($key)) ? true : false;
    
    if($valid_key)
    {
        $requete = 'UPDATE user SET user_confirm = true WHERE user_id =:user_id';
        $result = $db->prepare($requete);
        $result->bindValue(':user_id', $row->user_id);
        $result->execute();
        $result->closeCursor();
        session_start();
        $_SESSION['auth'] = 'OK';
        header('location:../index.php');
    }
?>
