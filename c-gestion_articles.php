<?php 
date_default_timezone_set('Europe/Brussels');
$hote='localhost';
$nomBD='isim_parc';
$user='root';
$mdp=''; 
try {
	$bd=new PDO('mysql:host='.$hote.';dbname='.$nomBD, $user, $mdp);
	$bd->exec("SET NAMES 'utf8'");
}
catch (Exception $e) {
	echo "Erreur de connexion à la BD : $e";
	exit();
}

require 'models/m-Product.php';
$PRODUCT = new Product();
$shop_id = $_SESSION['shop_id'] = 4;

function getProducts() {
	global $bd;
	global $shop_id;
	$products = $bd->prepare("SELECT * FROM product WHERE shop_id_Fk=?;");
	$products->execute(array($shop_id));
	return $products;
}

function getProductTypes() {
	global $bd;
	$productTypes = $bd->prepare("SELECT * FROM product_type;");
	$productTypes->execute();
	return $productTypes;
}

$caterar = getProducts();
$caterar2 = getProducts();

$caterty = getProductTypes();
$caterty2 = getProductTypes();
$caterty3 = getProductTypes();

// Modifier article
if (isset($_POST['Envoyer'])) {
	$PRODUCT->updateProduct($_POST['nom_mod'], $_POST['pric_mod'], $_POST['type_mod'], $_POST['descript_mod'], $_POST['Nom_a_trouv'], $shop_id);
	header('Location:gestion_articles.php');
	exit();
}

// Ajouter article
if (isset($_POST['Envoyer1'])) {
	$PRODUCT->addProduct($_POST['nom_aj'], $_POST['pri_aj'], $_POST['type_aj'], $_POST['desc_aj'], $shop_id);
	header('Location:gestion_articles.php');
	exit();
}

// Supression article
if (isset($_POST['Envoyer2'])) {
	$PRODUCT->delProduct($_POST['Nom_sup'], $shop_id);
	header('Location:gestion_articles.php');
	exit();
}

// Ajout type
if (isset($_POST['Envoyer3'])) {
	$PRODUCT->addType($_POST['type_ajou']);
	header('Location:gestion_articles.php');
	exit();
}

// Supression type
if (isset($_POST['Envoyer4'])) {
	$PRODUCT->delType($_POST['type_sup']);
	header('Location:gestion_articles.php');
	exit();
}
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="UTF-8">
  <link rel="stylesheet" href="/Projet-Interdisciplinaire-GR8/views/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
  <title>Isims Parc | Gestion Articles</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
  <body>
  <?php include 'views/_header.html' ;?>
  <main class="modo_art">
	<ul>
		<li><a href="/Projet-Interdisciplinaire-GR8/c-modo.php">Retour</a></li>
	</ul>
	<div class="big-row">
	<!-- Ajouter article -->
	<div class="small-box">
		<form method="post" action="gestion_articles.php">
			<h3>Ajouter article</h3>
			<label><h4>Nom</h4>
			<input type="text" name="nom_aj" id=""><br>
			</label>
			<label><h4>Prix</h4>
			<input type="text" name="pri_aj" id=""><br>
			</label>
			<label><h4>Type</h4>
			<select name="type_aj">
				<?php while ($data = $caterty2->fetch()) : ?>
					<option value="<?= $data["product_type_id"] ?>"><?= $data["type_name"] ?></option>
				<?php endwhile; ?>
			</select><br>
			<label><h4>Description</h4>
			<input type="text" name="desc_aj" id=""><br>
			</label>
			<input type="submit" name="Envoyer1" value="Envoyer" >
		</form>
	</div>
	
	<!-- Modifier article -->
	<div class="small-box">
		<form method="post" action="c-gestion_articles.php">
			<h3>Modifier article</h3>
			<label><h4>Article</h4>
				<select name="Nom_a_trouv">
					<?php while ($data = $caterar->fetch()) : ?>
						<option value="<?= $data["Souvenir_name"] ?>"><?= $data["Souvenir_name"] ?></option>
					<?php endwhile; ?>
				</select><br>
			</label>
			<label><h4>Nom</h4>
				<input type="text" name="nom_mod"><br>
			</label>
			<label><h4>Prix</h4>
				<input type="text" name="pric_mod"><br>
			</label>
			<label><h4>Type</h4>
				<select name="type_mod">
					<?php while ($data = $caterty->fetch()) : ?>
						<option value="<?= $data["product_type_id"] ?>"><?= $data["type_name"] ?></option>
					<?php endwhile; ?>
				</select><br>
			</label>
			<label><h4>Description</h4>
				<input type="text" name="descript_mod"><br>
			</label>
			<input type="submit" name="Envoyer" value="Envoyer">
		</form>
	</div>
	 
	<!-- Suprimer article -->
	<div class="small-box">
		<form method="post" action="c-gestion_articles.php">
		<h3>Suprimer article</h3>
			<label>
			<select name="Nom_sup">
				<?php while ($data = $caterar2->fetch()) : ?>
					<option value="<?= $data["Souvenir_name"] ?>"><?= $data["Souvenir_name"] ?></option>
				<?php endwhile; ?>
			</select>
			<input type="submit" name="Envoyer2" value="Envoyer" >
		</form>
	</div>
	
	
	<!-- Ajouter type -->
	<div class="small-box">
		<form method="post" action="c-gestion_articles.php">
		<h3>Ajouter type</h3>
			<label>
			<input type="text" name="type_ajou" id="">
			</label>
			<input type="submit" name="Envoyer3" value="Envoyer" >
		</form>
	</div>
	
	
	<!-- Suprimer type -->
	<div class="small-box">
		<form method="post" action="c-gestion_articles.php">
		<h3>Suprimer type</h3>
			<label>
			<select name="type_sup">
				<?php while ($data = $caterty3->fetch()) : ?>
					<option value="<?= $data["product_type_id"] ?>"><?= $data["type_name"] ?></option>
				<?php endwhile; ?>
			</select>
			<input type="submit" name="Envoyer4" value="Envoyer" >
		</form>
	</div>
	
	</div>
  </main>
  <?php require 'views/_footer.html'; ?>
  </body>

</html>