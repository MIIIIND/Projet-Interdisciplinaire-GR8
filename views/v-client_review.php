<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="views/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
    <title>Isims Parc | Avis magasins</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 20px auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        select, textarea, input, button { margin-top: 10px; }
        textarea {width: 100%;}
        button { cursor: pointer; }
    </style>
</head>
<body>
<?php require 'views/_header.html'?>
<h2>Avis sur les boutique</h2>
<ul>
    <li><a href="c-client.php">Retour</a></li>
</ul>
<div class="review_form">
    <!-- Dropdown Menu for Shop Selection -->
    <form method="post">
        <label for="shop_dropdown"><h4>Sélectionner un boutique :</h4></label>
        <select name="shop_dropdown" id="shop_dropdown" onchange="this.form.submit()">
            <option value="">Sélectionner une boutique</option>
            <?php echo populateDropdown($bd, $selected_shop_id); ?>
        </select>
    </form>
    
    <!-- Comment Submission Form -->
    <form method="post">
        <textarea name="comment_content" placeholder="Type your comment here..."></textarea>
        <input type="number" name="score" min="1" max="5" placeholder="Note (1-5)">
        <input type="hidden" name="shop_dropdown" value="<?php echo $selected_shop_id; ?>">
        <button type="submit" name="submit_comment">Envoyer</button>
    </form>
</div>  

<!-- Comments Table -->
<?php if(!empty($comments_html)) {
    echo '<table>
    <tr>
        <th>Note</th>
        <th>Commentaire</th>
    </tr>
    '.$comments_html.'
</table>';
} elseif (!empty($_POST['shop_dropdown'])) {
    echo '<p>Aucun commentaire pour cette boutique.</p>';
} ?>
<?php require 'views/_footer.html'?>
</body>
</html>