<?php
require 'c-deconnect.php';
session_start();

deconnexion();
switch ($_SESSION['role']) {
    case 'Admin':
        require 'views/v-Magasin.php';
        break;
    case 'Modo':
        header('Location: controllers/c-modo.php');
        break;
    case 'Client':
        header('Location: controllers/c-client.php');
        break;
}

?>