<?php
require 'models/m-Shop.php';
require 'models/m-Order.php';
$shop = new Shop();
# $user_id = $_SESSION['user_id'];

if (isset($_POST['set_schedules'])) {
    $shop->setSchedules($_POST['H_ouv'], $_POST['H_fer'], $user_id);
}


require 'views/modo.php';
?>