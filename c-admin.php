<?php
require 'models/m-Model.php';
session_start();
$BD = new DB();
$bd = $BD->getDB();
require 'views/admin_stat.php';

?>
