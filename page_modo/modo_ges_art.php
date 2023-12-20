<?php 
	date_default_timezone_set('Europe/Brussels');
	$hote='localhost';
	$nomBD='testprojetinter';
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
	$cateror = $bd->query("SELECT * FROM product;");
	$cateror->execute();
	if (isset($_POST['Envoyer'])) {
	$cater = $bd->prepare("UPDATE shop SET Souvenir_name price shop_id_Fk image_url type_Fk description WHERE Souvenir_name=:Souvenir_name;");
	$cater->bindValue(':open_at',$_POST['H_ouv']);
	$cater->bindValue(':Souvenir_name',$chanart);
	$cater->execute();
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
  <?php include 'header.php' ;?>
  <main class="modo_art"> 	
	<a href="modo.php"><img src="img/flecherouge.png" alt="revenir en arrière"></a>
	<?php
	
	echo '<form method="post">
		<h1>Modifier article</h1>
			<label><h2>Nom</h2>
			<select name="Nom a trouv">';
			while ($data = $cateror->fetch()) {
			$chanart =	$data["Souvenir_name"]
				echo '<option value="',$data["Souvenir_name"],'">',$data["Souvenir_name"],'</option>';
			}
			echo'</select><br>;
			</label>
			<label>nom
			<input type="text" name="" id=""><br>
			</label>
			<label>prix
			<input type="text" name="" id=""><br>
			</label>
			<label>type
			<select>
			</select><br>
			<label>quantiter
			<input type="text" name="" id=""><br>
			</label>
			<input type="submit" name="Envoyer" value="Envoyer" >
		</form>';
		?>
		<form method="post">
		<h1>Ajouter article</h1>
			</label>
			<label>nom
			<input type="text" name="" id=""><br>
			</label>
			<label>prix
			<input type="text" name="" id=""><br>
			</label>
			<label>type
			<select>
			</select><br>
			<label>quantiter
			<input type="text" name="" id=""><br>
			</label>
			<input type="submit" name="Envoyer" value="Envoyer" >
		</form>
		<form method="post">
		<h1>Suprimer article</h1>
			<label>nom
			<select>
			</select>
			<input type="submit" name="Envoyer" value="Envoyer" >
		</form>
		<form method="post">
		<h1>Ajouter type</h1>
			<label>type
			<select>
			</select>
			<input type="submit" name="Envoyer" value="Envoyer" >
		</form>
		<form method="post">
		<h1>Suprimer type</h1>
			<label>type
			<select>
			</select>
			<input type="submit" name="Envoyer" value="Envoyer" >
		</form>
  </main>
  <?php require 'footer.php'; ?>
  </body>
  
</html>