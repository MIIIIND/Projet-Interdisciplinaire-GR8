<?php ob_start(); ?>
<ul>
    <li><a href="c-client.php">Retour</a></li>
    <li><a href="c-client_review.php">Donner un avis</a></li>
</ul>
<table class="suivi">
<?php while ($data = $cater->fetch()) : ?>
    <tr>
        <td><h3><?= $data->Souvenir_name ?></h3></td>
        <td><?= etat($data->state_Fk); ?></td>
    </tr>
<?php endwhile; ?>
</table>
<?php
$content = ob_get_clean();
$title = 'Suivi commandes';
require '_template.php';
?>