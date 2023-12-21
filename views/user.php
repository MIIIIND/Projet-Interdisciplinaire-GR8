<?php
// Place this at the top of your file

function placeOrder($pdo, $productId, $quantity, $stateId, &$productName) {
    $userId = $_SESSION['user_id']; // Replace with actual user ID from session or authentication system

    // Fetch the product name for the confirmation message
    $productStmt = $pdo->prepare("SELECT Souvenir_name FROM product WHERE product_id = :productId");
    $productStmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $productStmt->execute();
    $product = $productStmt->fetch(PDO::FETCH_ASSOC);
    $productName = $product ? $product['Souvenir_name'] : '';

    // Insert the order into the database
    $stmt = $pdo->prepare("INSERT INTO `order` (product_Fk, client_user_id_Fk, quantity, date, state_Fk) VALUES (:productId, :userId, :quantity, NOW(), :stateId)");
    $stmt->bindParam(':productId', $productId, PDO::PARAM_INT);
    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
    $stmt->bindParam(':stateId', $stateId, PDO::PARAM_INT);
    return $stmt->execute();
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
$shopQuery = "SELECT shop_id, shop_name FROM shop";
$shopStmt = $bd->prepare($shopQuery);
$shopStmt->execute();
while ($row = $shopStmt->fetch(PDO::FETCH_ASSOC)) {
    $shops[] = $row;
}

// Prepare product query with optional filters
$productQuery = "SELECT product_id, Souvenir_name, price, shop_id_Fk FROM product";
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
<link rel="stylesheet" href="views/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body, html {
    height: 100%;
    margin: 0;
    font-family: Arial, sans-serif;
}
.container {
    display: flex;
    height: 100%;
}
.filter-bar {
    background: #f1f1f1;
    padding: 10px;
    display: flex;
    align-items: center;
}
.filter-btn {
    margin-right: 10px;
}
.filter-types {
    display: flex;
}
.type-btn {
    margin-right: 5px;
}
.content {
    flex-grow: 1;
    padding: 10px;
}
table {
    width: 100%;
    border-collapse: collapse;
}
table, th, td {
    border: 1px solid black;
}
th, td {
    padding: 8px;
    text-align: left;
}
.sidebar {
    width: 200px;
    background: #ddd;
    padding: 10px;
}
.filter-form {
    display: flex;
    flex-direction: column;
}
.filter-form label,
.filter-form input,
.filter-form select,
.filter-form button {
    margin-bottom: 10px;
}
</style>
<title>Product Catalog</title>
</head>
<body>
<?php require '_header.html'?>
<?php if ($orderPlaced): ?>
    <p>Order placed successfully for <?= htmlspecialchars($orderedProductName) ?>!</p>
<?php endif; ?>
<form class="small-box" action="c-client.php" method="post">
    <div class="button-container">
        <input type="submit" class="centered-button" name="getMag" value="Magasin">
    </div>
</form>
<form class="small-box" action="c-client.php" method="post">
    <div class="button-container">
        <input type="submit" class="centered-button" name="getCommande" value="commande">
    </div>
</form>
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
                    <th>Price</th>
                    <th>Shop ID</th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $productStmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['Souvenir_name']) ?></td>
                        <td><?= htmlspecialchars($row['price']) ?></td>
                        <td><?= htmlspecialchars($row['shop_id_Fk']) ?></td>
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
<?php require '_footer.html'?>
</body>
</html>