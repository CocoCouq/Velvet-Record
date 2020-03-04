<?php

    function sanitize_int ($input)
    {
        // Supprime les caractères spéciaux
        $result = htmlspecialchars($input);
        // Vérifie qu'il s'agit d'un INT
        $result = filter_var($result, FILTER_VALIDATE_INT);
        // Par exemple pour l'année
        $result = trim($result);
        // Retourne la valeur nettoyée si c'est un int
        return $result;
    }
    
    function sanitize_float ($input)
    {
        $result = htmlspecialchars($input);
        $result = filter_var($result, FILTER_VALIDATE_FLOAT);
        $result = trim($result);
        return $result;
    }
    
    function sanitize_str ($input)
    {
        $result = htmlspecialchars($input);
        // Supprime les espaces en fin de valeur
        $result = trim($result);
        return $result;
    }
    
    // Verification de la complexité du mdp 
    function complex_password($str)
    {
        $len = strlen($str);
        $compt = preg_match('/\d/', $str) + preg_match('/[A-Z]/', $str) + preg_match('/[a-z]/', $str);
        $res = $compt == 3 ? true : false;
        $res = $len < 8 ? false : true;
        
        return $res;
    }
    
    // Session d'autorisation 
    function session_auth($location)
    {
        session_start();
        if(!isset($_SESSION['auth']) || $_SESSION['auth'] != 'OK')
        {
            header('location:'.$location);
            exit;
        } 
    }

?>
