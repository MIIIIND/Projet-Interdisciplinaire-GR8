<?php
session_start();
require 'models/m-Shop.php';
require 'models/m-User.php';
$SHOP = new Shop();
$USER = new User();

if (isset($_POST['ajout'])) {
    $nom = $_POST['NomTextboxAjout'];
    $prenom = $_POST['PrenomTextboxAjout'];
    $role_fk = 1; // Moderator role ID (should not be hardcoded but it's 6AM and I'm tired, sorry. Maybe later.) (Marcin should have done it)
    $mdp = $_POST['MDPTextboxAjout'];
    $login = $_POST['LoginTextboxAjout']; // Capture the login value
    $stmt = $USER->addUser($nom, $prenom, $role_fk, $mdp, $login);
    if ($stmt->execute()) {
        header("Location:admin_stat.php");
        exit();
    }
}

// Handle Delete Moderator Form
if (isset($_POST['delete_modo'])) {$USER->delUser($_POST['NomSelectSup']);}

// Fetch shop names for the Magasin dropdowns
$magasins = $SHOP->getAllShops()->fetchAll(PDO::FETCH_ASSOC);

// Fetch moderators for the Nom dropdowns
$noms = $USER->getModo()->fetchAll(PDO::FETCH_ASSOC);

// Handle Modify Moderator Form
if (isset($_POST['modify_modo'])) {
    $nom = $_POST['NomSelectSup']; // Name of the moderator to modify
    $prenom = $_POST['PrenomTextboxModif']; // New second name
    $mdp = $_POST['MDPTextboxModif']; // New password
    $login = $_POST['LoginTextboxModif']; // New login
    $USER->updateUser($prenom, $mdp, $login, $nom);
    header("Location:admin_stat.php"); // Redirect to the same page to refresh
}

require 'views/v-admin_gestion_modo.php'
?>