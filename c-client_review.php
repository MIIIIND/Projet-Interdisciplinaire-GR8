<?php
session_start();
require 'models/m-Shop.php';
require 'models/m-Comment.php';
$COMMENT = new Comment();
$SHOP = new Shop();

// Ajout des magasin au select
function populateDropdown($bd, $selected_shop_id) {
    global $SHOP;
    $html = '';
    try {
        $result = $SHOP->getAllShops();
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $selected = ($row['shop_id'] == $selected_shop_id) ? 'selected' : '';
            $html .= "<option value='{$row['shop_id']}' $selected>{$row['shop_name']}</option>";
        }
    } 
    catch (PDOException $e) {$html .= "<option value=''>Impossible de charger les magasins</option>"; }
    return $html;
}

// Récupère l'ID du magasin
$selected_shop_id = isset($_POST['shop_dropdown']) ? intval($_POST['shop_dropdown']) : null;

// Gère l'envoi des commentaires
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_comment'])) {
    if (empty($_POST['comment_content'])){
    }else{
        $content = trim($_POST['comment_content']);
        if (!empty($_POST['score'])){
            $score = $_POST['score'];
            $target_shop = $_POST['shop_dropdown'];
            $author_id = $_SESSION['user_id'];        
            $COMMENT->addComment($author_id, $target_shop, $content, $score);
        }
    }
}

// Récupère les commentaires de la boutique sélectionnée
function fetchComments($shop_id) {
    global $COMMENT;
    $html = '';
    if ($shop_id) {
        $stmt = $COMMENT->getShopComments($shop_id);       
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $html .= "<tr><td>" . htmlspecialchars($row['score']) . "</td><td>" . htmlspecialchars($row['content']) . "</td></tr>";
        }
    }
    return $html;
}
    
$comments_html = fetchComments($selected_shop_id);

require 'views/v-client_review.php'
?>