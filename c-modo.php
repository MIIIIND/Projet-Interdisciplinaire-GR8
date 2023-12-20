<?php
require 'models/m-Shop.php';
require 'models/m-Order.php';
$shop = new Shop();
$order = new Order();
# $user_id = $_SESSION['user_id'];

if (isset($_POST['set_schedules'])) {
    $shop->setSchedules($_POST['H_ouv'], $_POST['H_fer'], $user_id);
}

$action = $_GET['action'];
$action_wl = array('Gestion articles', 'Gestion commentaires', 'Gestion commandes');
if (!in_array($action, $action_wl)) {
    $action = 'Gestion commandes';
}

switch ($action) {
    case 'Gestion articles':
        echo 1;
        break;
    case 'Gestion commentaires':
        echo 2;
        break;
    default:
        $order->getOrders($user_id);
        break;
}

require 'views/v-Magasin.php';
?>