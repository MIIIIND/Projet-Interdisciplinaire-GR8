<?php
session_start();
require 'models/m-Shop.php';
require 'models/m-ShopType.php';
$SHOP = new Shop();
$SHOP_TYPE = new ShopType();

// Redirect to the appropriate page (should be links in the navbar)
if ( isset($_POST['statistique']) ) {
    header("Location:c-admin_stat.php");
    exit;
} 
    
if ( isset($_POST['GestionModo']) ) {
    header("Location:c-admin_gestion_modo.php");
    exit;
}  

$nomOptions = '';
$typeOptions = '';

// pour le select des boutiques
$shop_list = $SHOP->getAllShops();
while ($row = $shop_list->fetch(PDO::FETCH_ASSOC)) {
    $nomOptions .= "<option value='" . htmlspecialchars($row['shop_name']) . "'>" . htmlspecialchars($row['shop_name']) . "</option>";
}

// pour le select des types
$type_list = $SHOP_TYPE->getAllShopTypes();
while ($row = $type_list->fetch(PDO::FETCH_ASSOC)) {
    $typeOptions .= "<option value='" . htmlspecialchars($row['type_name']) . "'>" . htmlspecialchars($row['type_name']) . "</option>";
}

// Modification Magasin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier'])) {
    $selectedNom = $_POST['nom'];
    $nomTextBox = $_POST['nomTextBox'];
    $selectedType = $_POST['type'];
    $stmt = $SHOP->updateShop($nomTextBox, $selectedType, $selectedNom);
    if ($stmt) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = $SHOP->getError();
        echo "<p>Erreur lors de la modification : " . $error . "</p>";
    }
}

// Ajout type de magasin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajout'])) {
    $nomMagasin = $_POST['nomMagasin'];
    $typeMagasin = $_POST['typeMagasin'];
    $stmt = $SHOP->addShop($nomMagasin, $typeMagasin);
    if ($stmt) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = $SHOP->getError();
        echo "<p>Erreur lors de l'ajout : " . $error . "</p>";
    }
}

// Ajout Type de Magasin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajoutType'])) {
    $typeMagasin = $_POST['AjoutTypeMagasin'];
    $stmt = $SHOP_TYPE->addShopType($typeMagasin);
    if ($stmt) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = $SHOP_TYPE->getError();
        echo "<p>Erreur lors de l'ajout : " . $error . "</p>";
    }
}

// pour le select
$typeDeleteOptions = '';
$type_list = $SHOP_TYPE->getAllShopTypes();
while ($row = $type_list->fetch(PDO::FETCH_ASSOC)) {
    $typeDeleteOptions .= "<option value='" . htmlspecialchars($row['type_name']) . "'>" . htmlspecialchars($row['type_name']) . "</option>";
}

// Suppression Type de Magasin
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['supprimer'])) {
    $typeToDelete = $_POST['typeToDelete'];
    $stmt = $SHOP_TYPE->delShopType($typeToDelete);
    if ($stmt) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        $error = $SHOP_TYPE->getError();
        echo "<p>Erreur lors de la supression : " . $error . "</p>";
    }
}

require 'views/v-admin.php';
?>