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

require 'm-Product.php';
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
    <link rel="stylesheet" href="Style.css">
    <title>Isims Parc | Gestion Articles</title>
  </head>
  <body>
  <?php include '_header.html' ;?>
  <main class="modo_art">
	<a href="modo.php">Retour</a>
	<!-- Modifier article -->
	 <form method="post" action="gestion_articles.php">
        <h1>Modifier article</h1>
        <label><h2>Nom</h2>
            <select name="Nom_a_trouv">
                <?php while ($data = $caterar->fetch()) : ?>
                    <option value="<?= $data["Souvenir_name"] ?>"><?= $data["Souvenir_name"] ?></option>
                <?php endwhile; ?>
            </select><br>
        </label>
        <label>nom
            <input type="text" name="nom_mod"><br>
        </label>
        <label>prix
            <input type="text" name="pric_mod"><br>
        </label>
        <label>type
            <select name="type_mod">
                <?php while ($data = $caterty->fetch()) : ?>
                    <option value="<?= $data["product_type_id"] ?>"><?= $data["type_name"] ?></option>
                <?php endwhile; ?>
            </select><br>
        </label>
        <label>Description
            <input type="text" name="descript_mod"><br>
        </label>
        <input type="submit" name="Envoyer" value="Envoyer">
    </form>
	
	<!-- Ajouter article -->
	<form method="post" action="gestion_articles.php">
		<h1>Ajouter article</h1>
		<label>nom
		<input type="text" name="nom_aj" id=""><br>
		</label>
		<label>prix
		<input type="text" name="pri_aj" id=""><br>
		</label>
		<label>type
		<select name="type_aj">
			<?php while ($data = $caterty2->fetch()) : ?>
				<option value="<?= $data["product_type_id"] ?>"><?= $data["type_name"] ?></option>
			<?php endwhile; ?>
		</select><br>
		<label>descrition
		<input type="text" name="desc_aj" id=""><br>
		</label>
		<input type="submit" name="Envoyer1" value="Envoyer" >
	</form>
	
	<!-- Suprimer article -->
	<form method="post" action="gestion_articles.php">
	<h1>Suprimer article</h1>
		<label>nom
		<select name="Nom_sup">
			<?php while ($data = $caterar2->fetch()) : ?>
				<option value="<?= $data["Souvenir_name"] ?>"><?= $data["Souvenir_name"] ?></option>
			<?php endwhile; ?>
		</select>
		<input type="submit" name="Envoyer2" value="Envoyer" >
	</form>
	
	<!-- Ajouter type -->
	<form method="post" action="gestion_articles.php">
	<h1>Ajouter type</h1>
		<label>type
		<input type="text" name="type_ajou" id="">
		</label>
		<input type="submit" name="Envoyer3" value="Envoyer" >
	</form>
	
	<!-- Suprimer type -->
	<form method="post" action="gestion_articles.php">
	<h1>Suprimer type</h1>
		<label>type
		<select name="type_sup">
			<?php while ($data = $caterty3->fetch()) : ?>
				<option value="<?= $data["product_type_id"] ?>"><?= $data["type_name"] ?></option>
			<?php endwhile; ?>
		</select>
		<input type="submit" name="Envoyer4" value="Envoyer" >
	</form>
  </main>
  <?php require '_footer.html'; ?>
  </body>

</html>