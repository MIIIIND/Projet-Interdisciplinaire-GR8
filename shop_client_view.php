<?php 
// Include the database connection
include('db.php'); 

// Function to populate the dropdown
function populateDropdown($bd, $selected_shop_id) {
    $html = '';
    try {
        $result = $bd->query('SELECT shop_id, shop_name FROM shop');
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $selected = ($row['shop_id'] == $selected_shop_id) ? 'selected' : '';
            $html .= "<option value='{$row['shop_id']}' $selected>{$row['shop_name']}</option>";
        }
    } catch (PDOException $e) {
        $html .= "<option value=''>Could not load shops</option>";
    }
    return $html;
}

// Get the shop_id from POST if set
$selected_shop_id = isset($_POST['shop_dropdown']) ? intval($_POST['shop_dropdown']) : null;

// Handle comment submission
// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_comment'])) {
    $content = $_POST['comment_content'];
    $score = $_POST['score'];
    $target_shop = $_POST['shop_dropdown'];
    $author_id = 1; // Placeholder for user ID

    $stmt = $bd->prepare('INSERT INTO comment (author_user_id_Fk, target_shop_Fk, content, score) VALUES (?, ?, ?, ?)');
    $stmt->execute([$author_id, $target_shop, $content, $score]);
  
}


// Function to fetch comments based on selected shopfunction fetchComments($bd, $shop_id) {
    function fetchComments($bd, $shop_id) {
        $html = '';
        if ($shop_id) {
            $stmt = $bd->prepare('SELECT content, score FROM comment WHERE target_shop_Fk = ?');
            $stmt->execute([$shop_id]);
            
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $html .= "<tr><td>" . htmlspecialchars($row['content']) . "</td><td>" . htmlspecialchars($row['score']) . "</td></tr>";
            }
        }
        return $html;
    }
    
    $comments_html = fetchComments($bd, $selected_shop_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shop Comments</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 80%; margin: 20px auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        select, textarea, input, button { width: 100%; margin-top: 10px; }
        button { cursor: pointer; }
    </style>
</head>
<body>

<div class="container">
    <h1>Submit and View Shop Comments</h1>
    
    <!-- Dropdown Menu for Shop Selection -->
    <form action="" method="post">
        <label for="shop_dropdown">Select Shop:</label>
        <select name="shop_dropdown" id="shop_dropdown" onchange="this.form.submit()">
            <option value="">Select Shop</option>
            <?php echo populateDropdown($bd, $selected_shop_id); ?>
        </select>
    </form>
    
    <!-- Comment Submission Form -->
    <form action="" method="post">
        <textarea name="comment_content" placeholder="Type your comment here..."></textarea>
        <input type="number" name="score" min="1" max="5" placeholder="Score (1-5)">
        <input type="hidden" name="shop_dropdown" value="<?php echo $selected_shop_id; ?>">
        <button type="submit" name="submit_comment">Submit Comment</button>
    </form>

    <!-- Comments Table -->
    <table>
        <tr>
            <th>Comment</th>
            <th>Score</th>
        </tr>
        <?php echo $comments_html; ?>
    </table>
</div>

</body>
</html>
