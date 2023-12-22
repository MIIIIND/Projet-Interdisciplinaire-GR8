<?php 
require 'models/m-Shop.php';
$SHOP = new Shop();
session_start();

$shop_id = $SHOP->getShopFromOwner($_SESSION['user_id'])->fetch()->shop_id;
$_SESSION['shop_id'] = $shop_id;

if (isset($_POST['Envoi'])) {
	$SHOP->setSchedules($_POST['H_ouv'], $_POST['H_fer'], $shop_id);
	header('Location: modo.php');
	exit();
}
require 'views/v-modo.php'
?>