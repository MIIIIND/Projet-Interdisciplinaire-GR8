<?php 

// CETTE PAGE N'EST PAS EN MVC, IL FAUT EXPORTER LE SQL !!!!

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
session_start();
require 'models/m-Product.php';
$PRODUCT = new Product();

$shop_id =$_SESSION['shop_id'];

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

require 'views/v-gestion_articles.php';
?>