<?php
// Include the database connection file
ob_start
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $selectedShop = $_POST['shopSelect'];

    
    $sql = "SELECT 
                p.souvenir_name, 
                p.price, 
                SUM(o.quantity) AS total_quantity
            FROM 
                product p
            JOIN 
                shop s ON p.shop_id_Fk = s.shop_id
            LEFT JOIN 
                `order` o ON p.product_id = o.product_Fk
            WHERE 
                s.shop_name = :shop_name
            GROUP BY 
                p.product_id";

    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':shop_name', $selectedShop, PDO::PARAM_STR);
    $stmt->execute();

    
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['query_results'] = $results; 
}
?>
