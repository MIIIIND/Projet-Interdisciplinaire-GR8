<?php


    // Get the selected shop value from the form submission
    $selectedShop = $_POST['selectedShop'];

    // Use the selected shop value in your SQL query
    $sql = "SELECT * FROM your_table_name WHERE shop_column = '$selectedShop'";
    $result = $conn->query($sql);

    // Process and display the result as needed
    if ($result->num_rows > 0) {
        // Your table display code here
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
?>