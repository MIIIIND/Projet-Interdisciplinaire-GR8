<?php 
require_once 'Modele.php';

try {
    $shops = getshops();
    require 'VueAccueil.php';
}
catch (Exception $e){
    $MessageError = $e->getMessage();
    require 'VueError.php';
}
?>