<?php 
require_once 'Modele.php';
$DB = new bd();

try {
    $shops = $DB->getAllShops();
    require 'VueAccueil.php';
}
catch (Exception $e){
    $MessageError = $e->getMessage();
    require 'VueError.php';
}

?>