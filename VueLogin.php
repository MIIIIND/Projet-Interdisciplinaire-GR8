<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Style.css">
    <title>IsimsParc | Connexion</title>
  </head>
  <body>
    <div id="log">
        <img src="img/IconLog.png" alt="icon de compte">
        <form method="post" action="index.php">
            <label for="login">Identifiant :<br>
            <input type="text" name="login" id="login">
            </label>
            <label for="password">Mot de passe :<br>
            <input type="password" name="password" id="password">
            </label>
            <p><input type="submit" name="connexion" value="connexion">
        </form>
    </div>
    <?php
    require '_footer.php'; ?>
    </body>  
</html>