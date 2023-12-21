<?php
require 'models/m-Model.php';
$BD = new DB();
$bd = $BD->getDB();
if (isset($_POST['ajout'])) {
    // Updated SQL Query to include login
    $stmt = $bd->prepare("INSERT INTO user (first_name, second_name, role_Fk, password, login) VALUES (:nom, :prenom, :role_fk, :mdp, :login)");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':role_fk', $role_fk);
    $stmt->bindParam(':mdp', $mdp);
    $stmt->bindParam(':login', $login);

    // Set parameters and execute
    $nom = $_POST['NomTextboxAjout'];
    $prenom = $_POST['PrenomTextboxAjout'];
    $role_fk = 2; // Moderator role ID
    $mdp = sha1($_POST['MDPTextboxAjout']);
    $login = $_POST['LoginTextboxAjout']; // Capture the login value
    $stmt->execute();
        
}

// Handle Delete Moderator Form
if (isset($_POST['delete_modo'])) {
    $stmt = $bd->prepare("DELETE FROM user WHERE second_name = :nom");
    $stmt->bindParam(':nom', $nom);

    $nom = $_POST['NomSelectSup']; 
    $stmt->execute();
}


// Fetch shop names for the Magasin dropdowns
$magasinQuery = $bd->query("SELECT shop_name FROM shop");
$magasins = $magasinQuery->fetchAll(PDO::FETCH_ASSOC);

// Fetch user second names for the Nom dropdowns where role_Fk = 2 (Moderator)
$nomQuery = $bd->query("SELECT second_name FROM user WHERE role_Fk = 2");
$noms = $nomQuery->fetchAll(PDO::FETCH_ASSOC);


// Handle Modify Moderator Form
if (isset($_POST['modify_modo'])) {
    $stmt = $bd->prepare("UPDATE user SET second_name = :prenom, password = :mdp, login = :login WHERE second_name = :nom");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':mdp', $mdp);
    $stmt->bindParam(':login', $login);

    $nom = $_POST['NomSelectSup']; // Name of the moderator to modify
    $prenom = $_POST['PrenomTextboxModif']; // New second name
    $mdp = sha1($_POST['MDPTextboxModif']); // New password
    $login = $_POST['LoginTextboxModif']; // New login
    $stmt->execute();

    // Redirect to the same page to refresh
    
}
if ( isset($_POST['retour']) ) {
    require 'c-admin.php';
    session_destroy() ;
    exit;
    } 
    

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="views/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php require 'views/_header.html';?>
    <div class="container">
        <div class="columns-container">
            <!-- Add Moderator Form -->
            <div class="column">
                <div class="content-box">
                    <form method="post" action="Gestion_modo.php">
                        <p style="line-height:10.8pt">Ajouter Modo</p>
                        <p><span>Nom</span><span class="interaction-box"><input type="text" id="NomTextboxAjout" name="NomTextboxAjout"></span></p>
                        <p><span>Prenom</span><span class="interaction-box"><input type="text" id="PrenomTextboxAjout" name="PrenomTextboxAjout"></span></p>
                        <p><span>Login</span><span class="interaction-box"><input type="text" id="LoginTextboxAjout" name="LoginTextboxAjout"></span></p>
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
                        <input type="submit" name="ajout" class="custom-button" value="Ajout">
                    </form>
                </div>
            </div>

        <!-- Delete Moderator Form -->
    <div class="column">
        <div class="content-box">
            <form method="post" action="Gestion_modo.php">
                <p>Sup Modo</p>
                <p><span>Nom</span><span class="interaction-box">
                <select id="NomSelectSup" name="NomSelectSup"> <!-- Corrected name attribute -->
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
                    <form method="post" action="Gestion_modo.php">
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
                        <p><span>Nouveau Nom</span><span class="interaction-box"><input type="text" id="PrenomTextboxModif" name="PrenomTextboxModif"></span></p>
                        <p><span>Nouveau Login</span><span class="interaction-box"><input type="text" id="LoginTextboxModif" name="LoginTextboxModif"></span></p>
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
        <form class="small-box" action="Gestion_modo.php" method="post">
            <div class="button-container">
                <input type="submit" class="centered-button" name="retour" value="Fermer">
            </div>
        </form>
    </div>
    <?php require 'views/_footer.html';?>
</body>
</html>
