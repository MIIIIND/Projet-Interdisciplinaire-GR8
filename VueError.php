<?php $titre = 'IsimsParc'; ?>

<?php ob_start() ?>
<p>Une erreur est survenue : <?= $MessageError ?></p>
<?php $contenu = ob_get_clean(); ?>

<?php require 'StructurePage.php'; ?>