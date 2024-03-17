<!-- Group members:
Aswin Kizhuppully Santhosh     :041098900
SAVIO GOPURAN BABU             :041098027
session                        :320
Lab: Assignment 2 -->
<?php
session_start(); // Start session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get username and password from the login form
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "recipemanager";
    $db_port = 3308;

    // Create connection
    $conn = new mysqli($db_server, $db_username, $db_password, $db_name, $db_port);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $input_username);
        $stmt->execute();
        $result = $stmt->get_result();


if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $stored_password = $row['password'];

    // For debugging purposes
    echo "<p>Retrieved Username from DB: " . $input_username . "</p>";
    echo "<p>Retrieved Password from DB: " . $stored_password . "</p>";

    // Verify the entered password against the stored hashed password
    if (password_verify($input_password, $stored_password)) {
        // Passwords match, user is authenticated
        $_SESSION['username'] = $input_username;
        header("Location: account.php");
        exit();
    } else {
        echo "<p>Invalid password!</p>";
    }
} else {
    // For debugging purposes, print the username being searched
    echo "<p>Username entered for search: " . $input_username . "</p>";
    echo "<p>No user found for this username!</p>";
}


        $stmt->close();
    } else {
        echo "<p>Statement preparation error!</p>";
    }

    $conn->close();
}
?>
