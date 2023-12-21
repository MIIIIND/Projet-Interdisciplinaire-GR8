<?php
require 'models/m-Model.php';
echo $_SESSION['role'];
echo $_SESSION['user_id'];
$BD = new DB ();
$bd = $BD->getDB();
require 'views/admin_stat.php';

?>
