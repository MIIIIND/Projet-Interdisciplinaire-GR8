<?php
require 'c-login.php';
session_start();  

logout();
if (isset($_SESSION['role'])) {
    switch ($_SESSION['role']) {
        case 'Admin':
            header('Location:c-admin.php');
            break;
        case 'Modo':
            header('Location:c-modo.php');
            break;
        case 'Client':
            header('Location:c-client.php');
            break;
    }
} else {
    login();
}

?>