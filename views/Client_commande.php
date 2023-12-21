<?php

$cater = $bd->query("SELECT o.order_id, o.quantity, o.date, o.state_Fk, u.user_id, u.first_name, u.second_name, u.bill, c.name AS cottage_name, p.Souvenir_name, p.price, p.shop_id_Fk
FROM
    `order` o
JOIN
    user u ON o.client_user_id_Fk = u.user_id
JOIN
    cottage c ON u.stays_at_Fk = c.cottage_id
JOIN
    product p ON o.product_Fk = p.product_id;");


function etat($etat,$bd)
{
    $suivi = $bd->query("SELECT * From order_state ");
    $suivi->setFetchMode(PDO::FETCH_OBJ);
    while ($result=$suivi->fetch()) {
    if ($result->order_state_id == $etat){
        echo $result->state_name;
        echo '<img src="img/rond_plein.png" alt="Commande reçu">';
    }else{echo $result->state_name;
        echo '<img src="img/rond_vide.png" alt="Commande pas reçu">';}
    }
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="views/style.css">
    <title>IsimsParc</title>
    <style>
        article{
            display:flex;
        }
    </style>
</head>
<body>
<?php include '_header.html'; ?>
<main class="">
    <a href="shop_client_view.php"><p>magasin</p></a>
	<a href="c-client.php"><p>article</p></a>
    <?php
    while ($data = $cater->fetch()) :
        ?>
        <div>
            <article>
            <h1><?= $data["Souvenir_name"] ?></h1>
            <?= etat($data["state_Fk"],$bd); ?>
            </article>
        </div>
        <?php
    endwhile;
    ?>
</main>
<?php require '_footer.html'; ?>
</body>
</html>