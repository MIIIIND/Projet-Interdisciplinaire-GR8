<?php
require 'controller.php';
session_start();   


if (!isset($_SESSION['login'])) {
    require 'VueLogin.php';
}
else if ( isset($_POST['connexion']) ) {
    login();

}
else if ( isset($_POST['deconnexion']) ) {
	session_destroy() ;		//on détruit la session
	header('Location:index.php');	//on redirige
}

?>
