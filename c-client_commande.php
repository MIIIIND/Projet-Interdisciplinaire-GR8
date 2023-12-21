<?php
session_start();
require 'models/m-Order.php';

$ORDER = new Order();

$cater = $ORDER->getClientOrder($_SESSION['user_id']);

function etat($etat)
{
    global $ORDER;
    $suivi = $ORDER->getOrderStates();
    while ($result=$suivi->fetch()) {
    if ($result->order_state_id == $etat){
        echo $result->state_name;
        echo '<img src="/Projet-Interdisciplinaire-GR8/views/img/rond_plein.png" alt="Commande reçu">';
    }else{echo $result->state_name;
        echo '<img src="/Projet-Interdisciplinaire-GR8/views/img/rond_vide.png" alt="Commande pas reçu">';}
    }
}
?><!doctype html>
<html lang="fr">
<head>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/Projet-Interdisciplinaire-GR8/views/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
    <title>Isims Parc | Suivi commandes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php include 'views/_header.html'; ?>
<main class="">
    <ul>
        <li><a href="c-client.php">Retour</a></li>
        <li><a href="c-client_review.php">Donner un avis</a></li>
    </ul>
    <?php
    while ($data = $cater->fetch()) :
        ?>
        <div>
            <article>
            <h1><?= $data->Souvenir_name ?></h1>
            <?= etat($data->state_Fk); ?>
            </article>
        </div>
        <?php
    endwhile;
    ?>
</main>
<?php require 'views/_footer.html'; ?>
</body>
</html>