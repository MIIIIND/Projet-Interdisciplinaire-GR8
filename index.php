<?php
require 'controller.php';

if (empty($_SESSION)) {
    require 'VueLog.php';
    login();
}
else {
    require 'VueAccueil.php';
}


?>