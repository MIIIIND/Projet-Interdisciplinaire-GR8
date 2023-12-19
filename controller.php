<?php 
require_once 'Modele.php';
$DB = new bd();

function login() {
    global $DB;
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $user = $DB->getUser($login, $password);
    switch ($user->role_Fk) {
        case '1':
            $_SESSION['role']='Admin';
            break;
        case '2':
            $_SESSION['role']='Modo';
            break;
        default:
            $_SESSION['role']='Client';
            break;
    }
}

try {
    $shops = $DB->getAllShops();
    require 'VueAccueil.php';
}
catch (Exception $e){
    $MessageError = $e->getMessage();
    require 'VueError.php';
}

?>