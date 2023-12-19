<?php 
    $titre = 'IsimsParc';
    ob_start() 
?>
    <p>Une erreur est survenue : <?= $MessageError?> </p>
<?php 
    $contenu = ob_get_clean(); 
    require 'shema.php';
?>