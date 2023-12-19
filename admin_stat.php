<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the values from the form
    $minPrice = $_POST['minPrice'];
    $maxPrice = $_POST['maxPrice'];

    // Assuming you have a database connection established
    $servername = "your_server_name";
    $username = "your_username";
    $password = "your_password";
    $dbname = "your_database_name";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch data based on user input
    $sql = "SELECT * FROM your_table_name WHERE price BETWEEN $minPrice AND $maxPrice";
    $result = $conn->query($sql);

    // Display the results
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Column 1</th><th>Column 2</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["column1"] . "</td><td>" . $row["column2"] . "</td></tr>";
        }

        echo "</table>";
    } else {
        echo "0 results";
    }

    // Close the connection
    $conn->close();
}
?>
