<!-- Group members:
Aswin Kizhuppully Santhosh     :041098900
SAVIO GOPURAN BABU             :041098027
session                        :320
Lab: Assignment 2 -->
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $db_server = "localhost"; 
    $db_username = "root"; 
    $db_password = ""; 
    $db_name = "recipemanager"; 
    $db_port = 3308;
    // Create connection
    $connection = new mysqli($db_server, $db_username, $db_password, $db_name, $db_port);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

   
    $username = $_POST['username'];
    $email = $_POST['email'];
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    $stmt = $connection->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $connection->close();
}
?>
