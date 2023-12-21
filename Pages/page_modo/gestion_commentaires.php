<?php
date_default_timezone_set('Europe/Brussels');
$hote = 'localhost';
$nomBD = 'isim_parc';
$user = 'root';
$mdp = '';

try {
    $bd = new PDO('mysql:host=' . $hote . ';dbname=' . $nomBD, $user, $mdp);
    $bd->exec("SET NAMES 'utf8'");
} catch (Exception $e) {
    echo "Erreur de connexion à la BD : $e";
    exit();
}

$shop_id = 4;

$cater = $bd->prepare("SELECT comment.content, comment.score,comment.comment_id ,comment.author_user_id_Fk, user.first_name, user.second_name FROM comment JOIN user ON comment.author_user_id_Fk = user.user_id WHERE comment.target_shop_Fk=?;");
$cater->execute(array($shop_id));

if (isset($_POST['supprimer'])) {
  $commend_id = $_POST['comment_id'];
  $requeteDeleteCommentaires = $bd->prepare("DELETE FROM comment WHERE comment_id = ?");
  $requeteDeleteCommentaires->execute(array((int) $commend_id));
  header("Location: gestion_commentaires.php");
  exit();
}


?>

<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Style.css">
  <title>IsimsParc</title>
</head>
<body>
  <?php require '_header.html' ;?>
  <main> 	
	<a href="modo.php">Retour</a>
	<?php
	while ($data = $cater->fetch()) {
    echo '<p>', $data['first_name']. ' '. $data['second_name']. ' : '.$data['score'], '/5', '</p><p>', $data['content'], '</p>
    <form method="post">
		<input type="hidden" name="comment_id" value="' . $data['comment_id'] . '">
        <input type="submit" name="supprimer" value="supprimer">
    </form>';
	}
?>		
  </main>
  <?php require '_footer.html'; ?>
</body>
</html>