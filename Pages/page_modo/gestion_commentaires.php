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

$cater = $bd->query("SELECT comment.content, comment.score,comment.comment_id ,comment.author_user_id_Fk, user.first_name, user.second_name FROM comment JOIN user ON comment.author_user_id_Fk = user.user_id WHERE comment.target_shop_Fk = 0;");
$cater->execute();


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
	<a href="modo.php"><img src="img/flecherouge.png" alt="revenir en arrière"></a>
	<?php
	while ($data = $cater->fetch()) {
    echo '<p>', $data['first_name'], '</p><p>', $data['second_name'], '</p><p>', $data['content'], '</p><p>', $data['score'], '/5 </p>
    <form method="post">
		<input type="hidden" name="user_id" value="' . $data['author_user_id_Fk'] . '">
        <input type="submit" name="bloquer" value="bloquer">
    </form>
    <form method="post">
		<input type="hidden" name="comment_id" value="' . $data['comment_id'] . '">
        <input type="submit" name="supprimer" value="supprimer">
    </form>';

    if (isset($_POST['bloquer'])) {
    $user_id = $_POST['user_id'];

    // Supprimer d'abord les commentaires associés à l'utilisateur
    $requeteDeleteCommentaires = $bd->prepare("DELETE FROM comment WHERE author_user_id_Fk = ?");
    $requeteDeleteCommentaires->bindParam(1, $user_id, PDO::PARAM_INT);
    $requeteDeleteCommentaires->execute();
    $requeteDeleteCommentaires->closeCursor();

    // Ensuite, supprimer l'utilisateur
    $requete = $bd->prepare("DELETE FROM user WHERE user_id = ?");
    $requete->bindParam(1, $user_id, PDO::PARAM_INT);
    $requete->execute();
    $requete->closeCursor();
    header("Location: modo_ges_com.php");
    exit();
	}
	 if (isset($_POST['supprimer'])) {
    $commend_id = $_POST['comment_id'];

    $requeteDeleteCommentaires = $bd->prepare("DELETE FROM comment WHERE comment_id = ?");
    $requeteDeleteCommentaires->bindParam(1, $commend_id, PDO::PARAM_INT);
    $requeteDeleteCommentaires->execute();
    $requeteDeleteCommentaires->closeCursor();
    header("Location: modo_ges_com.php");
    exit();
	}
}

?>
		
  </main>
  <?php require 'footer.php'; ?>
  </body>
  
</html>