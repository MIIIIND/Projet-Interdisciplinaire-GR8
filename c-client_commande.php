<?php
session_start();
require 'models/m-Order.php';
$ORDER = new Order(); // Création d'un objet Order pour accéder à la table

// Requête des commandes du client
$cater = $ORDER->getClientOrder($_SESSION['user_id']);

// Fonction d'affichage de l'état de la commande
function etat($etat)
{
    global $ORDER;
    $suivi = $ORDER->getOrderStates(); // Récupère tout les état de commandes possible
    while ($result=$suivi->fetch()) {
    if ($result->order_state_id == $etat){
        echo $result->state_name;
        echo '<img src="/Projet-Interdisciplinaire-GR8/views/img/rond_plein.png" alt="état actuel">';
    }else{
        echo $result->state_name;
        echo '<img src="/Projet-Interdisciplinaire-GR8/views/img/rond_vide.png" alt="autre état">';}
    }
}

// Appel de la vue
require 'views/v-client_commande.php'; 
?>