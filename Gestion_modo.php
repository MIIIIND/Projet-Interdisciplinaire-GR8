<?php
// Include the database connection file
include 'db.php';

if (isset($_POST['add_modo'])) {
  // Prepare and bind parameters
  $stmt = $bd->prepare("INSERT INTO user (first_name, second_name, role_Fk, password) VALUES (:nom, :prenom, :role_fk, :mdp)");
  $stmt->bindParam(':nom', $nom);
  $stmt->bindParam(':prenom', $prenom);
  $stmt->bindParam(':role_fk', $role_fk);
  $stmt->bindParam(':mdp', $mdp);

  // Set parameters and execute
  $nom = $_POST['NomTextboxAjout'];
  $prenom = $_POST['PrenomTextboxAjout'];
  $role_fk = 2; // Replace 2 with the actual role_id for moderator from your 'role' table
  $mdp = $_POST['MDPTextboxAjout'];
  $stmt->execute();
}

// Handle Delete Moderator Form
if (isset($_POST['delete_modo'])) {
  $stmt = $bd->prepare("DELETE FROM user WHERE second_name = :nom");
  $stmt->bindParam(':nom', $nom);

  // Set parameter and execute
  $nom = $_POST['NomSelectSup'];
  $stmt->execute();
  // Add error handling as necessary
}

// Fetch shop names for the Magasin dropdowns
$magasinQuery = $bd->query("SELECT shop_name FROM shop");
$magasins = $magasinQuery->fetchAll(PDO::FETCH_ASSOC);

// Fetch user second names for the Nom dropdowns where role_Fk = 2 (Moderator)
$nomQuery = $bd->query("SELECT second_name FROM user WHERE role_Fk = 2");
$noms = $nomQuery->fetchAll(PDO::FETCH_ASSOC);


// Handle Modify Moderator Form
if (isset($_POST['modify_modo'])) {
  $stmt = $bd->prepare("UPDATE user SET second_name = :prenom, password = :mdp WHERE second_name = :nom");
  $stmt->bindParam(':nom', $nom);
  $stmt->bindParam(':prenom', $prenom);
  $stmt->bindParam(':mdp', $mdp);

  // Set parameters and execute
  $nom = $_POST['NomSelectModif'];
  $prenom = $_POST['PrenomTextboxModif'];
  $mdp = $_POST['MDPTextboxModif'];
  $stmt->execute();
  // Add error handling as necessary
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Your existing head content -->
</head>
<body>
    <div class="container">
        <div class="columns-container">
            <!-- Add Moderator Form -->
            <div class="column">
                <div class="content-box">
                    <form method="post" action="">
                        <p style="line-height:10.8pt">Ajouter Modo</p>
                        <p><span>Nom</span><span class="interaction-box"><input type="text" id="NomTextboxAjout" name="NomTextboxAjout"></span></p>
                        <p><span>Prenom</span><span class="interaction-box"><input type="text" id="PrenomTextboxAjout" name="PrenomTextboxAjout"></span></p>
                        <p><span>Magasin</span><span class="interaction-box">
                        <select id="MagasinSelectAjout" name="MagasinSelectAjout">
                                <option value="" disabled selected>Select a Magasin</option>
                                <?php foreach ($magasins as $magasin): ?>
                                    <option value="<?php echo htmlspecialchars($magasin['shop_name']); ?>">
                                        <?php echo htmlspecialchars($magasin['shop_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </span></p>
                        <p><span>MDP</span><span class="interaction-box"><input type="text" id="MDPTextboxAjout" name="MDPTextboxAjout"></span></p>
                        <button type="submit" name="add_modo" class="custom-button">Ajout</button>
                    </form>
                </div>
            </div>

            <!-- Delete Moderator Form -->
            <div class="column">
                <div class="content-box">
                    <form method="post" action="">
                        <p>Sup Modo</p>
                        <p><span>Nom</span><span class="interaction-box">
                        <select id="NomSelectSup" name="NomSelectSup">
                                <option value="" disabled selected>Select a Nom</option>
                                <?php foreach ($noms as $nom): ?>
                                    <option value="<?php echo htmlspecialchars($nom['second_name']); ?>">
                                        <?php echo htmlspecialchars($nom['second_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </span></p>
                        <button type="submit" name="delete_modo" class="custom-button">Sup</button>
                    </form>
                </div>
            </div>

            <!-- Modify Moderator Form -->
            <div class="column">
                <div class="content-box">
                    <form method="post" action="">
                        <p>Modif modo</p>
                        <p><span>Nom</span><span class="interaction-box">
                        <select id="NomSelectSup2" name="NomSelectSup">
                                <option value="" disabled selected>Select a Nom</option>
                                <?php foreach ($noms as $nom): ?>
                                    <option value="<?php echo htmlspecialchars($nom['second_name']); ?>">
                                        <?php echo htmlspecialchars($nom['second_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </span></p>
                        <p><span>Prenom</span><span class="interaction-box"><input type="text" id="PrenomTextboxModif" name="PrenomTextboxModif"></span></p>
                        <p><span>Magasin</span><span class="interaction-box">
                        <select id="MagasinSelectAjout2" name="MagasinSelectAjout">
                                <option value="" disabled selected>Select a Magasin</option>
                                <?php foreach ($magasins as $magasin): ?>
                                    <option value="<?php echo htmlspecialchars($magasin['shop_name']); ?>">
                                        <?php echo htmlspecialchars($magasin['shop_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </span></p>
                        <p><span>MDP</span><span class="interaction-box"><input type="text" id="MDPTextboxModif" name="MDPTextboxModif"></span></p>
                        <button type="submit" name="modify_modo" class="custom-button">Modif</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
