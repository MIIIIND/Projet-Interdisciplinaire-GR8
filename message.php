<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messaging Page</title>
    <style>
        /* CSS styles */
        body {
            font-family: Arial, sans-serif;
        }
        .message-box {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            padding: 10px;
        }
    </style>
</head>
<body>

<?php
// Include the database connection file
include 'db.php';

// Define the concerning_shop and userID
$concerning_shop = 1; // Assuming 'fleurs' corresponds to shop_id 1
$userID = 1; // This will be dynamic in the future

// Handle new message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newMessage'])) {
    $newMessage = $_POST['newMessage'];

    // First, get the user_id of the shop manager for the given shop
    $getManagerIdSQL = "SELECT manager_user_id_Fk FROM shop WHERE shop_id = :shopId";
    $getManagerIdStmt = $bd->prepare($getManagerIdSQL);
    $getManagerIdStmt->execute(['shopId' => $concerning_shop]);
    $manager = $getManagerIdStmt->fetch(PDO::FETCH_ASSOC);

    if ($manager && isset($manager['manager_user_id_Fk'])) {
        $managerUserId = $manager['manager_user_id_Fk'];

        // Insert the new message into the database
        $insertSQL = "INSERT INTO message (from_user_Fk, to_user_Fk, concerning_shop_Fk, content) 
                      VALUES (:fromUserID, :toUserID, :concerning_shop, :content)";
        $insertStmt = $bd->prepare($insertSQL);
        $insertStmt->execute([
            'fromUserID' => $userID,
            'toUserID' => $managerUserId,
            'concerning_shop' => $concerning_shop,
            'content' => $newMessage
        ]);

        // Refresh the page
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Manager not found for the shop with ID: $concerning_shop";
        exit;
    }
}

// SQL to fetch messages
$sql = "SELECT m.content, u.first_name
        FROM message m
        JOIN user u ON u.user_id = m.from_user_Fk
        WHERE m.concerning_shop_Fk = :concerning_shop
        AND (m.from_user_Fk = :userID OR m.to_user_Fk = :userID)";

$stmt = $bd->prepare($sql);
$stmt->execute(['userID' => $userID, 'concerning_shop' => $concerning_shop]);

// Display messages
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<div class='message-box'>";
    echo "<strong>" . htmlspecialchars($row['first_name']) . ":</strong> ";
    echo htmlspecialchars($row['content']);
    echo "</div>";
}
?>

<!-- Message submission form -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <textarea name="newMessage" rows="4" cols="50" placeholder="Type your message here..."></textarea><br>
    <input type="submit" value="Send Message">
</form>

</body>
</html>
