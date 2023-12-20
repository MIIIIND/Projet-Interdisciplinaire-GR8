<?php
// Include your database connection file
include('db.php');

// Function to handle order placement
function placeOrder($pdo, $productId, $quantity, $stateId) {
    $userId = 1; // Replace with actual user ID, e.g., from a session variable
    $stmt = $pdo->prepare("INSERT INTO `order` (product_Fk, client_user_id_Fk, quantity, state_Fk, date) VALUES (:productId, :userId, :quantity, :stateId, NOW())");
    $stmt->bindParam(':productId', $productId);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':stateId', $stateId);
    return $stmt->execute();
}

// Check for order form submission
$orderPlaced = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_product_id'])) {
    $product_id = intval($_POST['order_product_id']);
    $orderPlaced = placeOrder($bd, $product_id, 1, 1); // Quantity and stateId are hardcoded for now
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

<?php if ($orderPlaced): ?>
    <p>Order placed successfully!</p>
<?php endif; ?>

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

</body>
</html>