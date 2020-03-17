<?php
function connexion()
{
    try 
    {        
        $db = new PDO('mysql:host=localhost;charset=utf8;dbname=record', 'root', 'root');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        
    } catch (Exception $e) {
        
        echo "Erreur : " . $e->getMessage() . "<br>";
        echo "N° : " . $e->getCode();
        die("Fin du script");
    } 
    return $db;
}
?>