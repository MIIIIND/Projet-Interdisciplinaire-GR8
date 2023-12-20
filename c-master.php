<?php
function deconnexion(){
    if ( isset($_POST['deconnexion']) ) {
        session_destroy() ;		//on détruit la session
        header('Location:index.php');	//on redirige
    }
}

session_start();

deconnexion();
switch ($_SESSION['role']) {
    case 'Admin':
        require 'c-admin.php';
        break;
    case 'Modo':
        require 'c-modo.php';
        break;
    case 'Client':
        require 'c-client.php';
        break;
}

?>