<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="views/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
  <title>Isims Parc | Gestion commentaires</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    input {
      width: 200px;
    }
    .comment {
      border: 1px solid black;
      border-radius: 20px;
      padding: 10px;
      margin: 10px;
    }
  </style>
</head>
<body>
  <?php require '_header.html' ;?>
  <main>
    <ul>
      <li><a href="c-modo.php">Retour</a></li>
    </ul>
	<?php
	while ($data = $cater->fetch()) {
    echo '<div class="comment">';
    echo '<p>', $data->first_name. ' '. $data->second_name. ' : '.$data->score, '/5', '</p><p>', $data->content, '</p>
    <form method="post">
		<input type="hidden" name="comment_id" value="' . $data->comment_id . '">
        <input type="submit" name="supprimer" value="supprimer">
    </form>';
    echo '</div>';
	} ?>		
  </main>
  <?php require '_footer.html'; ?>
</body>
</html>