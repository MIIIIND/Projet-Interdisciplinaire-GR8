<?php
// Place this at the top of your file
require 'models/m-Model.php';
require 'c-deconnect.php';
$BD = new DB();
$bd = $BD->getDB();
session_start();
deconnexion();


function placeOrder($pdo, $productId, $quantity, $stateId, &$productName) {
    $userId = $_SESSION['user_id']; // Replace with actual user ID from session or authentication system

    // Fetch the product name for the confirmation message
    $productStmt = $pdo->prepare("SELECT Souvenir_name FROM product WHERE product_id = ?");
    $productStmt->execute(array($productId));
    $product = $productStmt->fetch(PDO::FETCH_ASSOC);
    $productName = $product ? $product['Souvenir_name'] : '';

    // Insert the order into the database
    $stmt = $pdo->prepare("INSERT INTO `order` (product_Fk, client_user_id_Fk, quantity, date, state_Fk) VALUES (?, ?, ?, NOW(), ?)");
    return $stmt->execute(array((int) $productId, (int) $userId, (int) $quantity, (int) $stateId));
}

$orderPlaced = false;
$orderedProductName = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_product_id'])) {
    $product_id = intval($_POST['order_product_id']);
    if (placeOrder($bd, $product_id, 1, 1, $orderedProductName)) {
        $orderPlaced = true;
    }
}

// Initialize variables for filters
$minPrice = $_POST['minPrice'] ?? '';
$maxPrice = $_POST['maxPrice'] ?? '';
$selectedShop = $_POST['shop'] ?? '';

// Fetch shop names for the dropdown
$shops = [];
$shopStmt = $bd->prepare("SELECT shop_id, shop_name FROM shop");
$shopStmt->execute();
while ($row = $shopStmt->fetch(PDO::FETCH_ASSOC)) {
    $shops[] = $row;
}

// Prepare product query with optional filters
$productQuery = "SELECT p.product_id, p.Souvenir_name, p.price, s.shop_name FROM product AS p JOIN shop AS s ON p.shop_id_Fk = s.shop_id";
$filterConditions = [];
$params = [];

if (!empty($minPrice)) {
    $filterConditions[] = "price >= :minPrice";
    $params[':minPrice'] = $minPrice;
}
if (!empty($maxPrice)) {
    $filterConditions[] = "price <= :maxPrice";
    $params[':maxPrice'] = $maxPrice;
}
if (!empty($selectedShop)) {
    $filterConditions[] = "shop_id_Fk = :shopId";
    $params[':shopId'] = $selectedShop;
}

if (!empty($filterConditions)) {
    $productQuery .= " WHERE " . implode(" AND ", $filterConditions);
}

$productStmt = $bd->prepare($productQuery);
foreach ($params as $key => &$value) {
    $productStmt->bindParam($key, $value);
}
$productStmt->execute();
?>
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
            <label for="minPrice">Prix Minimum:</label>
            <input type="number" id="minPrice" name="minPrice" value="<?= htmlspecialchars($minPrice) ?>">
            <label for="maxPrice">Prix Maximum:</label>
            <input type="number" id="maxPrice" name="maxPrice" value="<?= htmlspecialchars($maxPrice) ?>">
            <label for="shop">Magasin:</label>
            <select id="shop" name="shop">
                <option value="">Select Shop</option>
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