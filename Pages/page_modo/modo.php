<?php 
	date_default_timezone_set('Europe/Brussels');
	$hote='localhost';
	$nomBD='isim_parc';
	$user='root';
	$mdp=''; 
	try {
	$bd=new PDO('mysql:host='.$hote.';dbname='.$nomBD, $user, $mdp);
	$bd->exec("SET NAMES 'utf8'");
	}
	catch (Exception $e) {
	echo "Erreur de connexion à la BD : $e";
	exit();
	}
	if (isset($_POST['Envoi'])) {
	$cater = $bd->prepare("UPDATE shop SET opens_at = :open_at WHERE manager_user_id_Fk=:manager_user_id_Fk;");
	$cater->bindValue(':open_at',$_POST['H_ouv']);
	$cater->bindValue(':manager_user_id_Fk',1);
	$cater->execute();
	$cater2 = $bd->prepare("UPDATE shop SET closes_at = :closes_at WHERE manager_user_id_Fk=:manager_user_id_Fk");
	$cater2->bindValue(':closes_at',$_POST['H_fer']);
	$cater2->bindValue(':manager_user_id_Fk',1);
	$cater2->execute();
	header('Location: modo.php');
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
  <?php include '_header.html' ;?>
  <main> 	
	<ul>
		<li><a href="gestion_articles.php">Gestion des article et des types</a></li>
		<li><a href="gestion_comandes.php">Gestion des commande</a></li>
		<li><a href="gestion_commentaires.php">Gestion des commentaire</a></li>
		<div id="popup" class="popup">
			<div class="popup-content">
				<a href="#" class="close" id="closePopup"><img src="img/flecherouge.png" alt="revenir en arrière"></a>
				<?php
				echo'<form method="post">
				<label>Heure d ouverture<br>
				<input type="time" name="H_ouv" id="H_ouv"><br>
				</label>
				<label>Heure de fermeture<br>
				<input type="time" name="H_fer" id="H_fer"><br>
				</label>
				<input type="submit" name="Envoi" value="Envoi" >
				</form>';
				?>
			</div>
		</div>
		<!-- 
		<li><a href="#popup_chat" id="openPopup_chat">Chat</a></li>
		<div id="popup_chat" class="popup">
			<div class="popup-content_chat">
				<a href="#" class="close_chat" id="closePopup_chat"><img src="img/flecherouge.png" alt="revenir en arrière"></a>
				<div class="chat-content">
            <div class="message">Bienvenue dans le chat !</div>
				</div>
			</div>
		</div>
		-->
	</ul>
  </main>
  <?php require 'footer.php'; ?>
  </body>
  
</html>