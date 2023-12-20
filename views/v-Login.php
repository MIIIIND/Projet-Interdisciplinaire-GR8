<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="views/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <title>Isims Parc | Connexion</title>
</head>
<body>
  <?php require '_header.html'; ?>
  <div class="center">
    <h2>Connectez-vous pour accéder à l'application</h2>
    <div class="login">
        <img src="img/IconLog.png" alt="icon de compte">
        <form method="post" action="index.php">
            <p><label for="login">Identifiant<br>
            <input type="text" name="login" id="login">
            </label>
            <p><label for="password">Mot de passe<br>
            <input type="password" name="password" id="password">
            </label>
            <p><input type="submit" name="connexion" value="connexion">
        </form>
    </div>
    <p>Si vous ne disposez pas de compte, contacter l'administrateur.</p>
  </div>
  <?php require '_footer.html'; ?>
</body>  
</html>