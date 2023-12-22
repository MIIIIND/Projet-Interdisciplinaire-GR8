<?php
date_default_timezone_set('Europe/Brussels');
$hote = 'localhost';
$nomBD = 'isim_parc';
$user = 'root';
$mdp = '';

try {
    $bd = new PDO('mysql:host=' . $hote . ';dbname=' . $nomBD, $user, $mdp);
    $bd->exec("SET NAMES 'utf8'");
} catch (Exception $e) {
    echo "Erreur de connexion à la BD : $e";
    exit();
}

session_start();

require 'models/m-Order.php';
require 'models/m-User.php';
$USER = new user();
$ORDER = new Order();

$shop_id = $_SESSION['shop_id'];

$cater = $bd->prepare("SELECT o.order_id, o.quantity, o.date, o.state_Fk, os.state_name, u.user_id, u.first_name, u.second_name, u.bill, c.name AS cottage_name, p.Souvenir_name, p.price FROM `order` AS o JOIN `order_state` AS os ON os.order_state_id = o.state_Fk JOIN `user` AS u ON o.client_user_id_Fk = u.user_id JOIN `cottage` AS c ON u.stays_at_Fk = c.cottage_id JOIN `product` AS p ON o.product_Fk = p.product_id WHERE shop_id_Fk=?;");
$cater->execute(array($shop_id));

if (isset($_POST['facturer'])) {
    $USER->updateBill($_POST['price'], $_POST['user_id']);
    header('Location: gestion_comandes.php');
    exit();
}

require 'views/v-gestion_comandes.php';
?>