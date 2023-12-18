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
        <form method="post" action="VueLog.php">
            <label for="Id">Identifiant :<br>
            <input type="text" value="Nom">
            </label>
            <label for="Mdp">Mot de passe :<br>
            <input type="text" value="*******">
            </label>
            <p><input type="submit" name="connexion" value="Connexion">
        </form>
    </div>
  </body>
  <footer>
  <?php require 'footer.php'; ?>
  </footer>
</html>