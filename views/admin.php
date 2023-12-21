<?php
// Include your database connection file

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
    require 'admin_stat.php';
    } 
    
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
  <title>Isims Parc | Administration</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php require '_header.html';?>
    <div class="big-box">
        <!-- Modification Form -->
    <form class="small-box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h3>Modification Magasin</h3>

        <!-- Nom Dropdown -->
        <div>
            <label for="nom">Nom</label>
            <select id="nom" name="nom">
                <?php echo $nomOptions; ?>
            </select>
        </div>

        <div style="margin-bottom: 20px;"></div>

        <div>
            <label for="nomTextBox">Nom</label>
            <input type="text" id="nomTextBox" name="nomTextBox" />
        </div>

        <!-- Type Dropdown -->
        <div>
            <label for="type">Type</label>
            <select id="type" name="type">
                <?php echo $typeOptions; ?>
            </select>
        </div>

        <div class="button-container">
        <input type="submit" class="centered-button" name="modifier" value="Modifier">
        </div>
    </form>
    
    <!-- Ajout Magasin Form -->
        <form class="small-box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <h3>Ajout de Magasin</h3>
        <div>
            <label for="nomMagasin">Nom</label>
            <input type="text" id="nomMagasin" name="nomMagasin" />
        </div>
        <div>
            <label for="typeMagasin">Type</label>
            <select id="typeMagasin" name="typeMagasin">
                <?php echo $typeOptions; ?>
            </select>
        </div>
        <div class="button-container">
            <input type="submit" class="centered-button" name="ajout" value="Ajout">
        </div>
        </form>
    
        <form class="small-box" action="c-admin.php" method="post">
            <div class="button-container">
                <input type="submit" class="centered-button"  name="GestionModo" value="Gestion Moderateur">
            </div>
        </form>

        <!-- Ajout Type de magasin Form -->
  <!-- ======================================= -->
        
    
        <form class="small-box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h3>Ajout de type de magasin</h3>
            <div>
                <label for="AjoutTypeMagasin">Nom</label>
                <input type="text" id="AjoutTypeMagasin" name="AjoutTypeMagasin" />
            </div>
            <div class="button-container">
                <input type="submit" class="centered-button" name="ajoutType" value="Ajout">
            </div>
        </form>


        <form class="small-box" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h3>Suppression de Type de magasin</h3>
            <p></p>
            <div>
                <label for="typeToDelete">Type</label>
                <select id="typeToDelete" name="typeToDelete">
                    <?php echo $typeDeleteOptions; ?>
                </select>
            </div>
            <div class="button-container">
                <input type="submit" class="centered-button" name="supprimer" value="Supprimer">
            </div>
        </form>
    
        <form class="small-box" action="c-admin.php" method="post">
            <div class="button-container">
                <input type="submit" class="centered-button" name="statistique" value="Statistique">
            </div>
        </form>
    </div>
    <?php // Get page Gestion des modo
if ( isset($_POST['GestionModo']) ) {
    require 'Gestion_modo.php';
    } 
    require '_footer.html';
    ?>
</body>
</html>