<?php ob_start(); ?>
<ul>
    <li><a href="c-client.php">Retour</a></li>
    <li><a href="c-client_review.php">Donner un avis</a></li>
</ul>
<?php while ($data = $cater->fetch()) : ?>
    <div>
        <article>
        <h1><?= $data->Souvenir_name ?></h1>
        <?= etat($data->state_Fk); ?>
        </article>
    </div>
<?php endwhile; ?>
<?php
$content = ob_get_clean();
$title = 'Suivi commandes';
require '_template.php';
?>