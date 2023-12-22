<?php
session_start();

// Modèles requis pour la page
require 'models/m-Shop.php';
require 'models/m-Order.php';
require 'models/m-Product.php';
$SHOP = new Shop();
$ORDER = new Order();
$PRODUCT = new Product();

// Créer une commande
function placeOrder($productId, $quantity, $stateId, &$productName) {
    global $ORDER;
    global $PRODUCT;
    // Récupère le nom de l'article commandé pour confirmer la commande
    $productStmt= $PRODUCT->getProduct($productId);
    $product = $productStmt->fetch(PDO::FETCH_ASSOC);
    $productName = $product ? $product['Souvenir_name'] : '';
    // Insère la commande dans la base de données
    return $ORDER->addOrder($productId, $_SESSION['user_id'], $quantity, $stateId);
}

$orderPlaced = false;
$orderedProductName = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_product_id'])) {
    $product_id = intval($_POST['order_product_id']);
    if (placeOrder($product_id, 1, 1, $orderedProductName)) {
        $orderPlaced = true;
    }
}

// Initialisation des variables pour le filtre
$minPrice = $_POST['minPrice'] ?? '';
$maxPrice = $_POST['maxPrice'] ?? '';
$selectedShop = $_POST['shop'] ?? '';

// Récupère les magasins pour le select
$shops = [];
$shopStmt = $SHOP->getAllShops();
while ($row = $shopStmt->fetch(PDO::FETCH_ASSOC)) {
    $shops[] = $row;
}

// Préparation de la requête pour les filtres
$productQuery = "SELECT p.product_id, p.Souvenir_name, p.price, s.shop_name FROM product AS p JOIN shop AS s ON p.shop_id_Fk = s.shop_id;";
$filterConditions = [];
$params = [];

// Ajout des filtres
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

if (!empty($filterConditions)) { // Si au moins un filtre est appliqué, on ajoute la clause WHERE
    $productQuery .= " WHERE " . implode(" AND ", $filterConditions);
}

$productStmt = $PRODUCT->prepareRequestForFilter($productQuery); // récupération de la requête préparée
foreach ($params as $key => &$value) {
    $productStmt->bindParam($key, $value); // binding des paramètres
}
$productStmt->execute(); // exécution de la requête

require 'views/v-client.php'
?>