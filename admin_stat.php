<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];

    // Display the received values (you can replace this with your desired logic)
    echo "Min Price: " . $minPrice . "<br>";
    echo "Max Price: " . $maxPrice;
}
?>
