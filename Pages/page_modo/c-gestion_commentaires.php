<?php
require 'm-Comment.php';
$COMMENT= new Comment();

$shop_id = $_SESSION['shop_id'] = 4;

$cater=$COMMENT->getShopComments($shop_id);

if (isset($_POST['supprimer'])) {
  $COMMENT->delComment($_POST['comment_id']);
  header("Location: c-gestion_commentaires.php");
  exit();
}
require 'v-gestion_commentaires.php';
?>