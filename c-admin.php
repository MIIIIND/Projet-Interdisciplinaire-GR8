<?php
require 'models/m-Model.php';
$BD = new DB ();
$bd = $BD->getDB();
require 'views/admin_stat.php';

?>
