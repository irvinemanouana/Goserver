<?php
class DbConnect {
 
    
 
    function __construct() {        
    }
 
    
    function connect() {
        include_once dirname(__FILE__) . '/config.php';
        
        $connexion = new PDO('mysql:host=localhost;dbname=godb;charset=utf8', 'root', '');  
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connexion;
    }
 
}