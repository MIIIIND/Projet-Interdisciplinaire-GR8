<?php 
require_once 'Modele.php';
$DB = new bd();

function login() {
    global $DB;
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $user = $DB->getUser($login, $password);
    if ($user->first_name == 'Admin'){
        $_SESSION['admin']='True';
        header('Location:VueAcceuil.php');
    }
    else{
        $_SESSION['admin']='False';
        header('Location:Vuelog.php');
    }
    exit();

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