<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Style.css">
  <title>IsimsParc</title>
</head>
<body>
  <?php require '_header.html' ;?>
  <main> 	
	<a href="modo.php">Retour</a>
	<?php
	while ($data = $cater->fetch()) {
    echo '<p>', $data->first_name. ' '. $data->second_name. ' : '.$data->score, '/5', '</p><p>', $data->content, '</p>
    <form method="post">
		<input type="hidden" name="comment_id" value="' . $data->comment_id . '">
        <input type="submit" name="supprimer" value="supprimer">
    </form>';
	} ?>		
  </main>
  <?php require '_footer.html'; ?>
</body>
</html>