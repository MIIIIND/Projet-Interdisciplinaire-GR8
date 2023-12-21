<?php
require 'c-deconnect.php';
require 'models/m-Model.php';
session_start();
$BD = new DB();
$bd = $BD->getDB();
if ( isset($_POST['getCommande']) ) {
    require 'views/Client_commande.php';
}
else if( isset($_POST['getMag']) ) {
    header('location:shop_client_view.php');
}else{require 'views/user.php';} 

deconnexion();

?>