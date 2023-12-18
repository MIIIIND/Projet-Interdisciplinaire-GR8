<?php
require 'Modele.php';

$req_log = $bd->query('SELECT * from user');
$req_log->setFetchMode(PDO::FETCH_OBJ);
session_start();
if (isset($_POST['connexion'])){
  $Id = trim($_POST['Id']);
  $Mpd = trim($_POST['Mpd']);

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
            <label for="Id">Identifiant :<br>
            <input type="text" name="Id" id="Id">
            </label>
            <label for="Mdp">Mot de passe :<br>
            <input type="password" name="Mpd" id="Mpd">
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
  </body>
  <footer>
  <?php require 'footer.php'; ?>
  </footer>
</html>