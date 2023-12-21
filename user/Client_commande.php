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

$cater = $bd->prepare("SELECT
    o.order_id,
    o.quantity,
    o.date,
    o.state_Fk,
    u.user_id,
    u.first_name,
    u.second_name,
    u.bill,
    c.name AS cottage_name,
    p.Souvenir_name,
    p.price
FROM
    `order` o
JOIN
    `user` u ON o.client_user_id_Fk = u.user_id
JOIN
    `cottage` c ON u.stays_at_Fk = c.cottage_id
JOIN
    `product` p ON o.product_Fk = p.product_id;");
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
<?php include 'header.php'; ?>
<main class="">
    <a href=""><p>commande</p></a>
	<a href=""><p>article</p></a>
    <?php
    while ($data = $cater->fetch()) :
        ?>
            <p><?= $data["Souvenir_name"] ?></p>
			
			<?php if (  $data["state_Fk"] == 1 ):?>
				<img src="img/rond_plein.png" alt="Commande reçu">
			<?php else : ?>
				<img src="img/rond_vide.png" alt="Commande pas reçu">
			<?php endif; ?>
				<p>Commande reçu</p>
			
			<?php if (  $data["state_Fk"] == 2 ):?>
				<img src="img/rond_plein.png" alt="Commande prête">
			<?php else : ?>
				<img src="img/rond_vide.png" alt="Commande pas prête">
			<?php endif; ?>
				<p>Commande prête</p>
				
			<?php if (  $data["state_Fk"] == 3 ):?>
				<img src="img/rond_plein.png" alt="Commande en livraison">
			<?php else : ?>
				<img src="img/rond_vide.png" alt="Commande pas en livraison">
			<?php endif; ?>
				<p>Commande en livraison</p>
				
			<?php if (  $data["state_Fk"] == 4 ):?>
				<img src="img/rond_plein.png" alt="Commande livrer">
			<?php else : ?>
				<img src="img/rond_vide.png" alt="Commande pas livrer">
			<?php endif; ?>
				<p>Commande livrer</p>
				
			
        <?php
    endwhile;
    ?>
</main>
<?php require 'footer.php'; ?>
</body>
</html>