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
	$caterar = $bd->prepare("SELECT * FROM product;");
	$caterar->execute();
	$caterar2 = $bd->prepare("SELECT * FROM product;");
	$caterar2->execute();

	$caterty = $bd->prepare("SELECT * FROM product_type;");
	$caterty->execute();
	$caterty2 = $bd->prepare("SELECT * FROM product_type;");
	$caterty2->execute();
	$caterty3 = $bd->prepare("SELECT * FROM product_type;");
	$caterty3->execute();

	if (isset($_POST['Envoyer'])) {
    $cater = $bd->prepare("UPDATE product SET Souvenir_name = :nom_mod, price = :pric_mod, type_Fk = :type_mod, description = :descript_mod WHERE Souvenir_name = :Nom_a_trouv");
    $cater->bindValue(':nom_mod', $_POST['nom_mod']);
    $cater->bindValue(':pric_mod', $_POST['pric_mod']);
    $cater->bindValue(':type_mod', $_POST['type_mod']);
    $cater->bindValue(':descript_mod', $_POST['descript_mod']);
    $cater->bindValue(':Nom_a_trouv', $_POST['Nom_a_trouv']);
    $cater->execute();
    header('Location: modo.php');
    exit();
	}
	if (isset($_POST['Envoyer1'])) {
    $cater2 = $bd->prepare("INSERT INTO product (Souvenir_name, price, type_Fk, description) 
                       VALUES (:souvenirName, :price, :typeFk, :description)");
	$cater2->bindParam(':souvenirName', $_POST['nom_aj'], PDO::PARAM_STR);
	$cater2->bindParam(':price', $_POST['pri_aj'], PDO::PARAM_STR);
	$cater2->bindParam(':typeFk', $_POST['type_aj'], PDO::PARAM_INT);
	$cater2->bindParam(':description', $_POST['desc_aj'], PDO::PARAM_STR);
	$cater2->execute();
    header('Location: modo.php');
    exit();
	}
	if (isset($_POST['Envoyer2'])) {
    $cater3 = $bd->prepare("DELETE FROM product WHERE Souvenir_name = :Souvenir_name");
    $cater3->bindParam(":Souvenir_name", $_POST['Nom_sup'], PDO::PARAM_INT);
    $cater3->execute();
    header('Location: modo.php');
    exit();
	}
	if (isset($_POST['Envoyer3'])) {
    $cater3 = $bd->prepare("INSERT INTO product_type (type_name) VALUES (:type_name)");
	$cater3->bindParam(':type_name', $_POST['type_ajou'], PDO::PARAM_STR);
	$cater3->execute();
    header('Location: modo.php');
    exit();
	}
	if (isset($_POST['Envoyer4'])) {
    $cater4 = $bd->prepare("DELETE FROM product_type WHERE product_type_id = :product_type_id");
    $cater4->bindParam(":product_type_id", $_POST['type_sup'], PDO::PARAM_INT);
    $cater4->execute();
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
	 <form method="post">
        <h1>Modifier article</h1>
        <label><h2>Nom</h2>
            <select name="Nom_a_trouv">
                <?php while ($data = $caterar->fetch()) : ?>
                    <option value="<?= $data["Souvenir_name"] ?>"><?= $data["Souvenir_name"] ?></option>
                <?php endwhile; ?>
            </select><br>
        </label>
        <label>nom
            <input type="text" name="nom_mod"><br>
        </label>
        <label>prix
            <input type="text" name="pric_mod"><br>
        </label>
        <label>type
            <select name="type_mod">
                <?php while ($data = $caterty->fetch()) : ?>
                    <option value="<?= $data["product_type_id"] ?>"><?= $data["type_name"] ?></option>
                <?php endwhile; ?>
            </select><br>
        </label>
        <label>Description
            <input type="text" name="descript_mod"><br>
        </label>
        <input type="submit" name="Envoyer" value="Envoyer">
    </form>
	
		<form method="post">
		<h1>Ajouter article</h1>
			<label>nom
			<input type="text" name="nom_aj" id=""><br>
			</label>
			<label>prix
			<input type="text" name="pri_aj" id=""><br>
			</label>
			<label>type
			<select name="type_aj">
				<?php while ($data = $caterty2->fetch()) : ?>
                    <option value="<?= $data["product_type_id"] ?>"><?= $data["type_name"] ?></option>
                <?php endwhile; ?>
			</select><br>
			<label>descrition
			<input type="text" name="desc_aj" id=""><br>
			</label>
			<input type="submit" name="Envoyer1" value="Envoyer" >
		</form>
		
		<form method="post">
		<h1>Suprimer article</h1>
			<label>nom
			<select name="Nom_sup">
                <?php while ($data = $caterar2->fetch()) : ?>
                    <option value="<?= $data["Souvenir_name"] ?>"><?= $data["Souvenir_name"] ?></option>
                <?php endwhile; ?>
			</select>
			<input type="submit" name="Envoyer2" value="Envoyer" >
		</form>
		
		<form method="post">
		<h1>Ajouter type</h1>
			<label>type
			<input type="text" name="type_ajou" id="">
			</label>
			<input type="submit" name="Envoyer3" value="Envoyer" >
		</form>
		
		<form method="post">
		<h1>Suprimer type</h1>
			<label>type
			<select name="type_sup">
				<?php while ($data = $caterty3->fetch()) : ?>
                    <option value="<?= $data["product_type_id"] ?>"><?= $data["type_name"] ?></option>
                <?php endwhile; ?>
			</select>
			<input type="submit" name="Envoyer4" value="Envoyer" >
		</form>
  </main>
  <?php require 'footer.php'; ?>
  </body>
  
</html>