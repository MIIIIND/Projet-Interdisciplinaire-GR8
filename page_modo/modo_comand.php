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
    <a href="modo.php"><img src="img/flecherouge.png" alt="revenir en arrière"></a>
    <?php
    while ($data = $cater->fetch()) :
        ?>
        <form method="post">
            <input type="hidden" name="order_id" value="<?= $data['order_id'] ?>">
            <p><?= $data["first_name"] . ' ' . $data["second_name"] . ' (' . $data["cottage_name"] . ')' ?></p>
            <p><?= $data["Souvenir_name"] ?></p>
            <?php if ($data['bill'] == NULL or $data['bill'] == 0 or $data['bill'] != $data['price']) : ?>
                <input type="submit" name="facturer" value="facturer">
            <?php else : ?>
                <input type="submit" name="defacturer" value="supprimer la facture">
            <?php endif; ?>
        </form>
        <?php
        if (isset($_POST['facturer']) && isset($_POST['order_id']) && $_POST['order_id'] == $data['order_id']) {
            $suplem = ($data['bill'] == NULL) ? $data['price'] : $data['bill'] + $data['price'];
            $cater2 = $bd->prepare("UPDATE `user` SET bill = :bill WHERE user_id = :user_id");
            $cater2->bindValue(':bill', $suplem);
            $cater2->bindValue(':user_id', $data['user_id']);
            $cater2->execute();
            header('Location: modo_comand.php');
            exit();
        }

        if (isset($_POST['defacturer']) && isset($_POST['order_id']) && $_POST['order_id'] == $data['order_id']) {
            $enlv = ($data['bill'] <= 0 or $data['bill'] == NULL) ? 0 : $data['bill'] - $data['price'];
            $cater3 = $bd->prepare("UPDATE `user` SET bill = :bill WHERE user_id = :user_id");
            $cater3->bindValue(':bill', $enlv);
            $cater3->bindValue(':user_id', $data['user_id']);
            $cater3->execute();
            header('Location: modo_comand.php');
            exit();
        }
        ?>
        <form method="post">
		<?php if (  $data["state_Fk"] < 1  or $data["state_Fk"] > 4 or $data["state_Fk"] == NULL):?>
            <input type="submit" name="act_com" value="acepter la commande">
			<?php 
			if (isset($_POST['act_com'])) {	
				$cater1 = $bd->prepare("UPDATE `order` SET state_Fk = :state_Fk WHERE order_id = :order_id");
                $cater1->bindValue(':state_Fk', 1);
                $cater1->bindValue(':order_id', $data['order_id']);
                $cater1->execute();
                header('Location: modo_comand.php');
                exit();
				}
				?>
			<?php endif; ?>
			<?php if (  $data["state_Fk"] >= 1  && $data["state_Fk"] <= 4):?>
            <label class="dispa">Commande reçu
                <input type="checkbox" name="radio1" <?php if ($data['state_Fk'] == 1) {
                    echo 'checked';
                } ?>>
            </label>
            <label class="dispa">Commande prête
                <input type="checkbox" name="radio2" <?php if ($data['state_Fk'] == 2) {
                    echo 'checked';
                } ?>>
            </label>
            <label class="dispa">Commande en livraison
                <input type="checkbox" name="radio3" <?php if ($data['state_Fk'] == 3) {
                    echo 'checked';
                } ?>>
            </label>
            <label class="dispa">Commande livrer
                <input type="checkbox" name="radio4" <?php if ($data['state_Fk'] == 4) {
                    echo 'checked';
                } ?>>
            </label>
			<input type="submit" name="vali_com" value="avancer l'état de suivi">
			<?php endif; ?>
        </form>
        <?php
        if (isset($_POST['vali_com'])) {
            if (isset($_POST['radio1'])) {
                $cater1 = $bd->prepare("UPDATE `order` SET state_Fk = :state_Fk WHERE order_id = :order_id");
                $cater1->bindValue(':state_Fk', 1);
                $cater1->bindValue(':order_id', $data['order_id']);
                $cater1->execute();
                header('Location: modo_comand.php');
                exit();
            } else if (isset($_POST['radio2'])) {
                $cater1 = $bd->prepare("UPDATE `order` SET state_Fk = :state_Fk WHERE order_id = :order_id");
                $cater1->bindValue(':state_Fk', 2);
                $cater1->bindValue(':order_id', $data['order_id']);
                $cater1->execute();
                header('Location: modo_comand.php');
                exit();
            } else if (isset($_POST['radio3'])) {
                $cater1 = $bd->prepare("UPDATE `order` SET state_Fk = :state_Fk WHERE order_id = :order_id");
                $cater1->bindValue(':state_Fk', 3);
                $cater1->bindValue(':order_id', $data['order_id']);
                $cater1->execute();
                header('Location: modo_comand.php');
                exit();
            } else if (isset($_POST['radio4'])) {
                $cater1 = $bd->prepare("UPDATE `order` SET state_Fk = :state_Fk WHERE order_id = :order_id");
                $cater1->bindValue(':state_Fk', 4);
                $cater1->bindValue(':order_id', $data['order_id']);
                $cater1->execute();
                header('Location: modo_comand.php');
                exit();
            }
            header('Location: modo_comand.php');
        }
    endwhile;
    ?>
</main>
<?php require 'footer.php'; ?>
</body>
</html>