<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="/Projet-Interdisciplinaire-GR8/views/css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>🎁</text></svg>"/>
  <title>Isims Parc | Acceuil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php require 'views/_header.html'?>
<?php if ($orderPlaced): ?>
    <p>Order placed successfully for <?= htmlspecialchars($orderedProductName) ?>!</p>
<?php endif; ?>
<ul>
    <li><a href="c-client_commande.php">Suivre mes commandes</a></li>
    <li><a href="c-client_review.php">Donner un avis</a></li>
</ul>
<div class="container">
    <div class="sidebar">
        <form method="post" class="filter-form">
            <!-- Filter Form -->
            <label for="minPrice">Prix Minimum :</label>
            <input type="number" id="minPrice" name="minPrice" min="0" max="9999" value="<?= htmlspecialchars($minPrice) ?>">
            <label for="maxPrice">Prix Maximum :</label>
            <input type="number" id="maxPrice" name="maxPrice" min="0" max="9999" value="<?= htmlspecialchars($maxPrice) ?>">
            <label for="shop">Magasin :</label>
            <select id="shop" name="shop">
                <option value="">Sélectionner</option>
                <?php foreach ($shops as $shop): ?>
                    <option value="<?= $shop['shop_id'] ?>" <?= $selectedShop == $shop['shop_id'] ? 'selected' : '' ?>><?= htmlspecialchars($shop['shop_name']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Filtrer</button>
        </form>
    </div>
    <div class="content">
        <!-- Product Table -->
        <table>
            <thead>
                <tr>
                    <th>Souvenir</th>
                    <th>Prix</th>
                    <th>Magasin</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $productStmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['Souvenir_name']) ?></td>
                        <td><?= htmlspecialchars($row['price']) ?></td>
                        <td><?= htmlspecialchars($row['shop_name']) ?></td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="order_product_id" value="<?= $row['product_id'] ?>">
                                <button type="submit">Order</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require 'views/_footer.html'?>
</body>
</html>