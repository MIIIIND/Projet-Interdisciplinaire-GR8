<?php
require 'Modele.php';

session_start();
if (isset($_POST['connexion'])){
  $login = trim($_POST['login']);
  $password = trim($_POST['password']);

  while ($result=$req_log->fetch() ) {
    if ( $Id==$result->login and $Mpd==$result->password) {
      if ($result->first_name == 'Admin'){
        $_SESSION['admin']='True';
        header('Location:VueAcceuil.php');
        }
      else{
        $_SESSION['admin']='False';
        header('Location:Vuelog.php');
      }
      exit();
      }
    }
    $req_log->closeCursor();
}
else if ( isset($_POST['deconnexion']) ) {
  session_destroy() ; //on détruit la session
  header('Location:index.php');
  }
?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Style.css">
    <title>IsimsParc</title>
  </head>
  <body>
    <div id="log">
        <img src="img/IconLog.png" alt="icon de compte">
        <?php
          if ( empty($_SESSION) ) { // utilisateur non connecté
        ?>
        <form method="post" action="VueLog.php">
            <label for="login">Identifiant :<br>
            <input type="text" name="login" id="login">
            </label>
            <label for="password">Mot de passe :<br>
            <input type="password" name="password" id="password">
            </label>
            <p><input type="submit" name="connexion" value="Connexion">
        </form>
    </div>
    <?php
    }
    else { // utilisateur connecté
    if ($_SESSION['admin']=='True'){
        echo 'bonjour connard',$_SESSION['nom'];
    }
    ?>
    <form method="post">
    <p><input type="submit" name="deconnexion" value="Déconnexion">
    </form>
    <?php
      }
    ?>
    <?php require 'footer.php'; ?>
    </body>  
</html>