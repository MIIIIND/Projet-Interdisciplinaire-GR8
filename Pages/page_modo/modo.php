<?php 
require 'm-Shop.php';
$SHOP = new Shop();
session_start();

$_SESSION['user_id'] = 2;
$shop_id = $SHOP->getShopFromOwner($_SESSION['user_id'])->fetch()->shop_id;
$_SESSION['shop_id'] = $shop_id;

if (isset($_POST['Envoi'])) {
	$SHOP->setSchedules($_POST['H_ouv'], $_POST['H_fer'], $shop_id);
	header('Location: modo.php');
	exit();
}
?><!doctype html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Style.css">
    <title>Isims Parc | Gestion magasin</title>
  </head>
  <body>
  <?php include '_header.html' ;?>
  <main> 	
	<ul>
		<li><a href="gestion_articles.php">Gestion des article et des types</a></li>
		<li><a href="gestion_comandes.php">Gestion des commande</a></li>
		<li><a href="gestion_commentaires.php">Gestion des commentaire</a></li>
	</ul>
	<div>
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