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
    $mdp = $_POST['MDPTextboxAjout'];
    $login = $_POST['LoginTextboxAjout']; // Capture the login value
    if ($stmt->execute()) {
        header("Location:admin_stat.php");
        exit();
    }
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
    $mdp = $_POST['MDPTextboxModif']; // New password
    $login = $_POST['LoginTextboxModif']; // New login
    $stmt->execute();

    // Redirect to the same page to refresh
    
}
if ( isset($_POST['retour']) ) {
    require 'c-admin.php';
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
    } 

require 'views/v-admin_gestion_modo.php'
?>