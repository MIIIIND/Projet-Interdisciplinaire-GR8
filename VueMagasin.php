<?php
  $titre = 'IsimsParc';
  ob_start();
?>
<article>
    <header>
      <h1 class="TitreMagasin"><?= $shop->shop_name ?></h1>
    </header>
    <p>le magasin se trouve :<?= $shop->shop_location ?></p>
  </article>
<?php
  $contenu = ob_get_clean();
  require '_StructurePage.php';
?> 