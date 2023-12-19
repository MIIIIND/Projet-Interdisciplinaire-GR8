<?php
  $titre = 'IsimsParc';
  ob_start();
  
  foreach ($shops as $shop){
?>
<article>
    <header>
      <a href="<?= "magasin.php?id=". $shop->shop_id?>">
      <h1 class="TitreMagasin"><?= $shop->shop_name ?></h1>
      <p>bonjour</p>
    </header>
    <p>le magasin se trouve :<?= $shop->shop_location ?></p>
  </article>
<?php
  exit ;}
  require 'StructurePage.php';
  $contenu = ob_get_clean();
  
?> 