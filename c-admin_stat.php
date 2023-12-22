<?php
require 'c-deconnect.php';
deconnexion();
session_start();

require 'models/m-Shop.php';
$SHOP = new Shop();

// Récupère la liste des magasins
$shop_list = $SHOP->getAllShops();

// Initialize filter variables
$minPrice = $maxPrice = $minQuantity = $maxQuantity = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des stat d'un boutique
    if (isset($_POST['action']) && $_POST['action'] == 'selectShop') {
        $selectedShop = $_POST['shopSelect'];
        $stmt = $SHOP->getStats($selectedShop);
        $_SESSION['query_results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // filtre (pas encore fonctionnel)
    elseif (isset($_POST['action']) && $_POST['action'] == 'filterResults') {
        $minPrice = $_POST['minPrice'];
        $maxPrice = $_POST['maxPrice'];
        $minQuantity = $_POST['minQuantity'];
        $maxQuantity = $_POST['maxQuantity'];
        $stmt = $SHOP->getFilteredStats($minPrice, $maxPrice, $minQuantity, $maxQuantity);
        $_SESSION['query_results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

ob_start();
if (isset($_SESSION['query_results']) && !empty($_SESSION['query_results'])) {
    if (isset($_POST['shopSelect'])) {
        echo "<h3>Ventes de '".$_POST['shopSelect']."'</h3>";
    }
    echo "<table>";
    echo "<tr><th>Article</th><th>Prix</th><th>Quantité total commandée</th><th>Recette</th></tr>";
    foreach ($_SESSION['query_results'] as $row) {
        if (empty($filterText) || stripos($row['souvenir_name'], $filterText) !== false) {
            echo "<tr><td>" . htmlspecialchars($row['souvenir_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['price']) . "</td>";
            if (($row['total_quantity'])== NULL){
                echo "<td>0</td>";
            }
            else {echo "<td>" .htmlspecialchars($row['total_quantity']). "</td>";}
            if (($row['ca'])== NULL){
                echo "<td>0</td>";
            }
            else {echo "<td>" . htmlspecialchars($row['ca']) . "</td></tr>";}
        }
    }
    echo "</table>";
}

$content = ob_get_clean();
require 'views/v-admin_stat.php'
?>