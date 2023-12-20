<?php
require 'models/m-Shop.php';
$shop = new Shop();

if (isset($_POST['set_schedules'])) {
    $shop->setSchedules($_POST['H_ouv'], $_POST['H_fer'], $user_id);

}

require 'views/v-Magasin.php';
?>