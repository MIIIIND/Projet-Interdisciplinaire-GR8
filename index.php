<?php
require 'controller.php';
session_start();   

if (!isset($_POST['role'])) {
    login();

}

?>
