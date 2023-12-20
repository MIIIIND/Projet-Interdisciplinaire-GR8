<!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Style.css">
    <title>IsimsParc</title>
  </head>
  <body>
  <?php include 'header.php' ;?>
  <main class=""> 	
	<a href="modo.php"><img src="img/flecherouge.png" alt="revenir en arrière"></a>
	<p>nom prenom logement</p>
	<p>article</p>
	<form method="post">
		<input type="submit" name="facturer" value="facturer" >
		<input type="submit" name="defacturer" value="suprimer la facture" >
	</form>
	<form method="post">
		<input type="submit" name="act_com" value="acepter la commande" >
		<label>Commande reçu  
		<input type="radio" name="radio">
		</label>
		<label>Commande prête 
		<input type="radio" name="radio">
		</label>
		<label>Commande  en livraison 
		<input type="radio" name="radio">
		</label>
		<label>Commande livrer   
		<input type="radio" name="radio">
		</label>
	</form>
  </main>
  <?php require 'footer.php'; ?>
  </body>
  
</html>