<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="views/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <title>Isims Parc | <?= $title; ?></title>
</head>
<body>
  <?php require '_header.html'; ?>
  <div class="center">
    <h2><?= $title; ?></h2>
    <?= $content; ?>
  </div>
  <?php require '_footer.html'; ?>
</body>  
</html>