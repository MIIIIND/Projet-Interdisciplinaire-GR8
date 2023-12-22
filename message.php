<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messaging Page</title>
    <style>
        /* Add your CSS styles here */
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
$concerning_shop = 1; // This will be dynamic in the future
$userID = 1; // This will be dynamic in the future

// Handle new message submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['newMessage'])) {
    $newMessage = $_POST['newMessage'];
    // Insert the new message into the database
    $insertSQL = "INSERT INTO message (from_user_Fk, concerning_shop_Fk, content) VALUES (:userID, :concerning_shop, :content)";
    $insertStmt = $bd->prepare($insertSQL);
    $insertStmt->execute(['userID' => $userID, 'concerning_shop' => $concerning_shop, 'content' => $newMessage]);

    // Refresh the page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
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
