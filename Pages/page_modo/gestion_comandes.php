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

require 'm-Order.php';
require 'm-User.php';
require 'm-Shop.php';
$USER = new user();
$ORDER = new Order();
$SHOP = new Shop();

$_SESSION['user_id'] = 2;
#$shop_id = $_SESSION['shop_id'];
$shop_id =$SHOP->getShopFromOwner($_SESSION['user_id'])->fetch()->shop_id;

$cater = $bd->prepare("SELECT o.order_id, o.quantity, o.date, o.state_Fk, os.state_name, u.user_id, u.first_name, u.second_name, u.bill, c.name AS cottage_name, p.Souvenir_name, p.price FROM `order` AS o JOIN `order_state` AS os ON os.order_state_id = o.state_Fk JOIN `user` AS u ON o.client_user_id_Fk = u.user_id JOIN `cottage` AS c ON u.stays_at_Fk = c.cottage_id JOIN `product` AS p ON o.product_Fk = p.product_id WHERE shop_id_Fk=?;");
$cater->execute(array($shop_id));

if (isset($_POST['facturer'])) {
    $USER->updateBill($_POST['price'], $_POST['user_id']);
    header('Location: gestion_comandes.php');
    exit();
}

?><!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Style.css">
    <title>Isims Parc | Gestion commandes</title>
</head>
<body>
<?php require '_header.html'; ?>
<main class="">
    <a href="modo.php">Retour</a>
    <table>
        <tr>
            <th>Client</th>
            <th>Logement</th>
            <th>Article</th>
            <th>Quantité</th>
            <th>État de la commande</th>
        </tr>
    <?php while ($data = $cater->fetch()) : ?>
        <form method="post">
            <tr>
                <td>
                    <input type="hidden" name="order_id" value="<?= $data['order_id'] ?>">
                    <?= $data["first_name"] . ' ' . $data["second_name"] ?>
                </td>
                <td><?= $data["cottage_name"] ?></td>
                <td><?= $data["Souvenir_name"] ?></td>
                <td><?= $data['quantity'] ?></td>
                <td><?= $data['state_name'] ?></td>
                <td>
                    <select name="" id="">
                        <?php $states = $ORDER->getOrderStates(); ?>
                        <?php while ($data = $states->fetch()) : ?>
                            <option value="<?= $data->order_state_id; ?>"><?= $data->state_name; ?></option>
                        <?php endwhile; ?>
                    </select>
                </td>
                <td><input type="submit" name="vali_com" value="Modifier l'état"></td>
                <td><input type="submit" name="facturer" value="facturer"></td>
            </tr>
        </form>
        <?php endwhile; ?>
    </table>
</main>
<?php require '_footer.html'; ?>
</body>
</html>