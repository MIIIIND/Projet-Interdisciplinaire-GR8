<?php
require_once 'models/m-Model.php';
session_start();
$BD = new DB();
$bd = $BD->getDB();

$nomOptions = '';
$typeOptions = '';

// Fetch options for Nom dropdown
$nomQuery = "SELECT shop_name FROM shop";
$nomResult = $bd->query($nomQuery);
while ($row = $nomResult->fetch(PDO::FETCH_ASSOC)) {
    $nomOptions .= "<option value='" . htmlspecialchars($row['shop_name']) . "'>" . htmlspecialchars($row['shop_name']) . "</option>";
}

// Fetch options for Type dropdown
$typeQuery = "SELECT type_name FROM shop_type";
$typeResult = $bd->query($typeQuery);
while ($row = $typeResult->fetch(PDO::FETCH_ASSOC)) {
    $typeOptions .= "<option value='" . htmlspecialchars($row['type_name']) . "'>" . htmlspecialchars($row['type_name']) . "</option>";
}

// Check if the Modification Form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modifier'])) {
    $selectedNom = $_POST['nom'];
    $nomTextBox = $_POST['nomTextBox'];
    $selectedType = $_POST['type'];

    // SQL to update the shop table
    $updateQuery = "UPDATE shop SET shop_name = ?, shop_type_Fk = (SELECT shop_type_id FROM shop_type WHERE type_name = ?) WHERE shop_name = ?";

    // Prepare and execute query
    $stmt = $bd->prepare($updateQuery);
    $stmt->bindParam(1, $nomTextBox);
    $stmt->bindParam(2, $selectedType);
    $stmt->bindParam(3, $selectedNom);
    if ($stmt->execute()) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p>Error updating record: " . htmlspecialchars($bd->errorInfo()[2]) . "</p>";
    }
}

// Check if the Ajout Form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajout'])) {
    $nomMagasin = $_POST['nomMagasin'];
    $typeMagasin = $_POST['typeMagasin'];

    // SQL to insert a new shop
    $insertQuery = "INSERT INTO shop (shop_name, shop_type_Fk) VALUES (?, (SELECT shop_type_id FROM shop_type WHERE type_name = ?))";

    // Prepare and execute query
    $stmt = $bd->prepare($insertQuery);
    $stmt->bindParam(1, $nomMagasin);
    $stmt->bindParam(2, $typeMagasin);
    if ($stmt->execute()) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p>Error adding new shop: " . htmlspecialchars($bd->errorInfo()[2]) . "</p>";
    }
    
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ajoutType'])) {
    $typeMagasin = $_POST['AjoutTypeMagasin'];

    // SQL to insert a new shop type
    $insertTypeQuery = "INSERT INTO shop_type (type_name) VALUES (?)";

    // Prepare and execute query
    $stmt = $bd->prepare($insertTypeQuery);
    $stmt->bindParam(1, $typeMagasin);
    if ($stmt->execute()) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p>Error adding new shop type: " . htmlspecialchars($bd->errorInfo()[2]) . "</p>";
    }
}



// Fetch options for Type to Delete dropdown
$typeDeleteOptions = '';
$typeDeleteQuery = "SELECT type_name FROM shop_type";
$typeDeleteResult = $bd->query($typeDeleteQuery);
while ($row = $typeDeleteResult->fetch(PDO::FETCH_ASSOC)) {
    $typeDeleteOptions .= "<option value='" . htmlspecialchars($row['type_name']) . "'>" . htmlspecialchars($row['type_name']) . "</option>";
}

// Check if the Suppression Form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['supprimer'])) {
    $typeToDelete = $_POST['typeToDelete'];

    // SQL to delete the selected shop type
    $deleteQuery = "DELETE FROM shop_type WHERE type_name = ?";

    // Prepare and execute query
    $stmt = $bd->prepare($deleteQuery);
    $stmt->bindParam(1, $typeToDelete);
    if ($stmt->execute()) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p>Error deleting shop type: " . htmlspecialchars($bd->errorInfo()[2]) . "</p>";
    }
}

// Get page statistique
if ( isset($_POST['statistique']) ) {
    header("Location:c-admin_stat.php");
    } 
    
    if ( isset($_POST['GestionModo']) ) {
        header("Location:c-admin_gestion_modo.php");
        }   

require 'views/v-admin.php';
?>
