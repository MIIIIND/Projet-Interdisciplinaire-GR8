<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="views/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
    <title>Isims Parc | Statistiques</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        input[type=number], .filter-section input[type=submit], .dropdown-form input[type=submit] {width: 100px;}
        select {width: fit-content;}
    </style>
</head>
<body>
    <?php require 'views/_header.html'; ?>
    <h2>Statistiques de ventes</h2>
    <ul>
        <li><a href="c-admin.php">Retour</a></li>
    </ul>
    <div class="filter-section">
        <form method="post">
            <label for="minPrice">Prix minimal :</label>
            <input type="number" name="minPrice" min="0" max="9999" value="<?php echo htmlspecialchars($minPrice); ?>">

            <label for="maxPrice">Prix maximal :</label>
            <input type="number" name="maxPrice" min="0" max="9999" value="<?php echo htmlspecialchars($maxPrice); ?>">

            <label for="minQuantity">Quantité minimale :</label>
            <input type="number" name="minQuantity" min="0" value="<?php echo htmlspecialchars($minQuantity); ?>">

            <label for="maxQuantity">Quantité maximale :</label>
            <input type="number" name="maxQuantity" min="0" value="<?php echo htmlspecialchars($maxQuantity); ?>">

            <input type="hidden" name="action" value="filterResults">
            <input type="submit" value="Filtrer">
        </form>
    </div>

    <div class="dropdown-form">
        <form method="post">
            <select name="shopSelect">
                <?php
                if ($shop_list) {
                    while ($row = $shop_list->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['shop_name']) . "'>" . htmlspecialchars($row['shop_name']) . "</option>";
                    }
                } ?>
            </select>
            <input type="hidden" name="action" value="selectShop">
            <input type="submit" value="Voir">
        </form>
    </div>

    <div class="inner-box">
        <?= $content ?>
    </div>
    <?php require 'views/_footer.html' ?>
</body>
</html>