<?php
// Include your database connection file
include 'db.php';

$nomOptions = '';
$typeOptions = '';


// --------------------------------------------------------
//                 MODIFICATION MAGASIN
// --------------------------------------------------------

// Fetch options for Nom dropdown
$nomQuery = "SELECT shop_name FROM shop";
$nomResult = $bd->query($nomQuery);
while ($row = $nomResult->fetch(PDO::FETCH_ASSOC)) { // Corrected to fetch(PDO::FETCH_ASSOC)
    $nomOptions .= "<option value='" . htmlspecialchars($row['shop_name']) . "'>" . htmlspecialchars($row['shop_name']) . "</option>";
}

// Fetch options for Type dropdown
$typeQuery = "SELECT type_name FROM shop_type";
$typeResult = $bd->query($typeQuery);
while ($row = $typeResult->fetch(PDO::FETCH_ASSOC)) { // Corrected to fetch(PDO::FETCH_ASSOC)
    $typeOptions .= "<option value='" . htmlspecialchars($row['type_name']) . "'>" . htmlspecialchars($row['type_name']) . "</option>";
}

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedNom = $_POST['nom'];
    $nomTextBox = $_POST['nomTextBox'];
    $selectedType = $_POST['type'];

    // SQL to update the shop table
    $updateQuery = "UPDATE shop SET shop_name = ?, shop_type_Fk = (SELECT shop_type_id FROM shop_type WHERE type_name = ?) WHERE shop_name = ?";

    // Prepare and execute query (Prevents SQL Injection)
    $stmt = $bd->prepare($updateQuery);
    $stmt->bindParam(1, $nomTextBox);
    $stmt->bindParam(2, $selectedType);
    $stmt->bindParam(3, $selectedNom);
    if ($stmt->execute()) {
        // Refresh the page after successful update
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<p>Error updating record: " . htmlspecialchars($bd->errorInfo()[2]) . "</p>";
    }

    
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Apply some basic styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Style for the big box */
        .big-box {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 columns */
            grid-template-rows: repeat(2, 1fr);    /* 2 rows */
            gap: 20px; /* Adjust the gap between smaller boxes */
            width: 800px; /* Set the width of the big box */
            height: 600px; /* Set the height of the big box */
            border: 2px solid #333; /* Border for the big box */
            padding: 10px; /* Padding for the big box */
        }

        /* Style for the smaller boxes */
        .small-box {
            border: 1px solid #666; /* Border for the smaller boxes */
            padding: 10px; /* Padding for the smaller boxes */
            text-align: center; /* Align text to the center */
            position: relative; /* Set position to relative for absolute positioning */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%; /* Make the small box take full height */
        }

        /* Style for the combo box and text box */
        select, input {
            width: 100%; /* Make combo box and text box fill the container */
            margin-top: 5px; /* Add some space at the top */
            margin-bottom: 10px; /* Add some space at the bottom */
        }

        /* Style for the centered button */
        .centered-button {
            text-align: center;
            padding: 10px; /* Add padding for better visibility */
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: auto; /* Center the button */
        }

        /* Style to push the button to the bottom */
        .button-container {
            margin-top: auto;
        }
    </style>
</head>
<body>

    <div class="big-box">
    <form class="small-box" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>Modification Magasin</div>

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
            <input type="submit" class="centered-button" value="Modifier">
        </div>
    </form>
    
        <form class="small-box" action="/submit-url" method="post">
            <div>Ajout Type</div>
            <div>
                <label for="typeTextBox">Type</label>
                <input type="text" id="typeTextBox" />
            </div>
            <div class="button-container">
                <input type="submit" class="centered-button" value="Ajout">
            </div>
        </form>
    
        <form class="small-box" action="/submit-url" method="post">
            <div class="button-container">
                <input type="submit" class="centered-button" value="Gestion Moderateur">
            </div>
        </form>
    
        <form class="small-box" action="/submit-url" method="post">
            <div>Ajout de Magasin</div>
            <div>
                <label for="nomMagasin">Nom</label>
                <input type="text" id="nomMagasin" />
            </div>
            <div>
                <label for="typeMagasin">Type</label>
                <select id="typeMagasin">
                    <option value="type1">Type 1</option>
                    <option value="type2">Type 2</option>
                </select>
            </div>
            <div class="button-container">
                <input type="submit" class="centered-button" value="Ajout">
            </div>
        </form>
    
        <form class="small-box" action="/submit-url" method="post">
            <div>Suppression Type</div>
            <div>
                <label for="typeToDelete">Type</label>
                <select id="typeToDelete">
                    <option value="type1">Type 1</option>
                    <option value="type2">Type 2</option>
                </select>
            </div>
            <div class="button-container">
                <input type="submit" class="centered-button" value="Supprimer">
            </div>
        </form>
    
        <form class="small-box" action="/submit-url" method="post">
            <div class="button-container">
                <input type="submit" class="centered-button" value="Statistique">
            </div>
        </form>
    </div>

</body>
</html>