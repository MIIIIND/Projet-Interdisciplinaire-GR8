<?php
date_default_timezone_set('Europe/Brussels');
$hote = 'localhost';
$nomBD = 'isim_parc';
$user = 'root';
$mdp = '';

try {
    $bd = new PDO('mysql:host=' . $hote . ';dbname=' . $nomBD, $user, $mdp);
    $bd->exec("SET NAMES 'utf8'");
} catch (Exception $e) {
    echo "Erreur de connexion à la BD : $e";
    exit();
}

$cater = $bd->prepare("SELECT shop_name, shop_id FROM `shop`");
$cater->execute();

$cater2 = $bd->prepare("SELECT s.shop_name, s.shop_id FROM shop s ");
$cater2->execute();

$cater3 = $bd->prepare("SELECT s.shop_name, s.shop_id, c.content, c.score, u.first_name, u.second_name 
                      FROM shop s 
                      LEFT JOIN comment c ON s.shop_id = c.target_shop_Fk 
                      LEFT JOIN user u ON c.author_user_id_Fk = u.user_id");
$cater3->execute();

$selectedShops = array();
$selectedShopContents = array();

// Traitement du formulaire de filtre
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST["rc_name"])) {
        $selectedShops = $_POST["rc_name"];
        
        // Récupère les contenus liés aux magasins sélectionnés
        $cater3->execute();
        while ($data = $cater3->fetch()) {
            if (in_array($data["shop_id"], $selectedShops)) {
                $selectedShopContents[] = $data;
            }
        }
    }
}

// Traitement du formulaire de commentaire
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_comment"])) {
    // Récupérer les données du formulaire
    $comment = $_POST["comm"];
    $score = $_POST["note"];

    // Utiliser l'ID de l'utilisateur à partir de la session (à adapter en fonction de votre authentification)
    $userId = 1; // Remplacez cela par la méthode appropriée pour obtenir l'ID de l'utilisateur

    // Vérifier si un magasin a été sélectionné
    if (!empty($selectedShops)) {
        $selectedShop = $selectedShops[0]; // Utiliser le premier magasin sélectionné pour cet exemple

        // Insertion du commentaire dans la base de données
        $insertComment = $bd->prepare("INSERT INTO comment (author_user_id_Fk, target_shop_Fk, content, score) 
                                        VALUES (:author_user_id, :target_shop, :content, :score)");

        if (!$insertComment->execute(array(
            ':author_user_id' => $userId,
            ':target_shop' => $selectedShop,
            ':content' => $comment,
            ':score' => $score
        ))) {
            // Afficher des informations sur l'erreur MySQL
            echo "Erreur MySQL : " . $insertComment->errorInfo()[2];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="Style.css">
    <title>IsimsParc</title>
</head>
<body>
<?php include 'header.php'; ?>
<main class="">
    <a href=""><p>magasin</p></a>
    <a href=""><p>article</p></a>
    <form method="post">
        <h1>filtre</h1>
        <label for='rc_name'>
        <?php while ($data = $cater->fetch()) : ?>
                <input type="checkbox" name="rc_name[]" value="<?php echo $data["shop_id"]; ?>" 
                    <?php if (in_array($data["shop_id"], $selectedShops)) echo 'checked'; ?>>
                <?php echo $data["shop_name"]; ?><br>
        <?php endwhile; ?>
        </label>
        <input type="submit" name="filtre" value="filtrer">
    </form>
    <?php if (!empty($selectedShops)) : ?>
        <?php foreach ($selectedShops as $selectedShop) : ?>
            <?php foreach ($selectedShopContents as $content) : ?>
                <?php if ($content["shop_id"] == $selectedShop) : ?>
                    <p><?php echo $content["first_name"], " ", $content["second_name"]; ?></p>
                    <p><?php echo $content["content"], " ", $content["score"], "/5"; ?></p>
                <?php endif; ?>
            <?php endforeach; ?>
            <form method="post">
                <label>Commentaire
                    <input type="text" name="comm"><br>
                </label>
                <label>Note
                    <select name="note">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select><br>
                </label>
                <input type="submit" name="submit_comment" value="Envoyer commentaire">
            </form>
        <?php endforeach; ?>
    <?php endif; ?>
</main>
<?php require 'footer.php'; ?>
</body>
</html>



