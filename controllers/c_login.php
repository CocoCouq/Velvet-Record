<?php
    function user_infos($pdo)
    {
        $requete = 'SELECT * FROM user WHERE user_id =:user_id';
        $result = $pdo->prepare($requete);
        $result->bindValue(':user_id', $_SESSION['user_id']);
        $result->execute();
        $row = $result->fetch();
        $result->closeCursor();
        return $row;
    }
?>