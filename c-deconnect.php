<?php 
function deconnexion(){
    if ( isset($_POST['deconnexion']) ) {
        session_destroy() ;		//on détruit la session
        header('Location:index.php');	//on redirige
    }
}
?>