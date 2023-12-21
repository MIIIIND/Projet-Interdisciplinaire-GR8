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
        header('Location:c-admin.php');
        break;
    case 'Modo':
        header('Location:c-modo.php');
        break;
    case 'Client':
        header('Location:c-client.php');
        break;
}

?>