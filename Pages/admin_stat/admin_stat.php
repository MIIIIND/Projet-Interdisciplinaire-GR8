<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Statistics</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .filter-section, .dropdown-form {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .inner-box {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
    session_start();
    include 'db.php';

    // Initialize filter variables
    $minPrice = $maxPrice = $minQuantity = $maxQuantity = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['action']) && $_POST['action'] == 'selectShop') {
            // ... existing code for selectShop action ...
        }
        elseif (isset($_POST['action']) && $_POST['action'] == 'filterResults') {
            $minPrice = $_POST['minPrice'];
            $maxPrice = $_POST['maxPrice'];
            $minQuantity = $_POST['minQuantity'];
            $maxQuantity = $_POST['maxQuantity'];
        
            $sql = "SELECT 
                        p.souvenir_name, 
                        p.price, 
                        SUM(o.quantity) AS total_quantity,
                        (p.price * SUM(o.quantity)) AS ca
                    FROM 
                        product p
                    JOIN 
                        shop s ON p.shop_id_Fk = s.shop_id
                    LEFT JOIN 
                        `order` o ON p.product_id = o.product_Fk
                    GROUP BY 
                        p.product_id
                    HAVING 
                        p.price BETWEEN :minPrice AND :maxPrice AND
                        SUM(o.quantity) BETWEEN :minQuantity AND :maxQuantity";
        
            $stmt = $bd->prepare($sql);
            $stmt->bindParam(':minPrice', $minPrice, PDO::PARAM_STR);
            $stmt->bindParam(':maxPrice', $maxPrice, PDO::PARAM_STR);
            $stmt->bindParam(':minQuantity', $minQuantity, PDO::PARAM_STR);
            $stmt->bindParam(':maxQuantity', $maxQuantity, PDO::PARAM_STR);
            $stmt->execute();
            $_SESSION['query_results'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    ?>

<div class="filter-section">
        <form method="post" action="admin_stat.php">
            <label for="minPrice">Min Price:</label>
            <input type="number" name="minPrice" value="<?php echo htmlspecialchars($minPrice); ?>">

            <label for="maxPrice">Max Price:</label>
            <input type="number" name="maxPrice" value="<?php echo htmlspecialchars($maxPrice); ?>">

            <label for="minQuantity">Min Quantity:</label>
            <input type="number" name="minQuantity" value="<?php echo htmlspecialchars($minQuantity); ?>">

            <label for="maxQuantity">Max Quantity:</label>
            <input type="number" name="maxQuantity" value="<?php echo htmlspecialchars($maxQuantity); ?>">

            <input type="hidden" name="action" value="filterResults">
            <input type="submit" value="Filter">
        </form>
    </div>

    <div class="dropdown-form">
        <form method="post" action="admin_stat.php">
            <select name="shopSelect">
                <?php
                $query = "SELECT shop_name FROM shop";
                $result = $bd->query($query);
                if ($result) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . htmlspecialchars($row['shop_name']) . "'>" . htmlspecialchars($row['shop_name']) . "</option>";
                    }
                }
                ?>
            </select>
            <input type="hidden" name="action" value="selectShop">
            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="inner-box">
        <?php
        if (isset($_SESSION['query_results']) && !empty($_SESSION['query_results'])) {
            echo "<table>";
            echo "<tr><th>Souvenir Name</th><th>Price</th><th>Total Quantity Ordered</th><th>C.A.</th></tr>";
            foreach ($_SESSION['query_results'] as $row) {
                if (empty($filterText) || stripos($row['souvenir_name'], $filterText) !== false) {
                    echo "<tr><td>" . htmlspecialchars($row['souvenir_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['price']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['total_quantity']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['ca']) . "</td></tr>";
                }
            }
            echo "</table>";
        }
        ?>
    </div>
</body>
</html>
