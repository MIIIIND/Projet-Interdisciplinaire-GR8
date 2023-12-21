<!doctype html>
<html lang="fr">
<meta charset="UTF-8">
  <link rel="stylesheet" href="/Projet-Interdisciplinaire-GR8/views/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
  <title>Isims Parc | Gestion magasin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
  <body>
  <?php include '_header.html' ;?>
  <main> 	
	<ul>
		<li><a href="/Projet-Interdisciplinaire-GR8/c-gestion_articles.php">Gestion des article et des types</a></li>
		<li><a href="/Projet-Interdisciplinaire-GR8/c-gestion_comandes.php">Gestion des commande</a></li>
		<li><a href="c-gestion_commentaires.php">Gestion des commentaire</a></li>
	</ul>
	<div class="center_hor">
		<form method="post">
			<label>Heure d ouverture<br>
				<input type="time" name="H_ouv" id="H_ouv"><br>
			</label>
			<label>Heure de fermeture<br>
				<input type="time" name="H_fer" id="H_fer"><br>
			</label>
			<input type="submit" name="Envoi" value="Envoi" >
		</form>
	</div>
  </main>
  <?php require '_footer.html'; ?>
  </body>
</html>