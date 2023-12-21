<?php
require 'c-deconnect.php';
require 'models/m-Model.php';
session_start();
$BD = new DB();
$bd = $BD->getDB();
require 'views/user.php';
deconnexion();

?>