<!-- Group members:
Aswin Kizhuppully Santhosh     :041098900
SAVIO GOPURAN BABU             :041098027
session                        :320
Lab: Assignment 2 -->
<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; 
    require_once "db_functions.php";
    $userId = getUserIdByUsername($username);
    $_SESSION['username'] = $input_username;
    if ($userId) {
        // Retrieve recipe details from the form
        $title = $_POST['recipe_title'];
        $photo = $_POST['photo'];
        $description = $_POST['description'];
        $instructions = $_POST['instructions'];
        $ingredients = $_POST['ingredients'];


        // Insert the recipe into the database
        require_once "db_functions.php"; 
        if (insertRecipe($userId, $title, $photo, $description, $instructions, $ingredients)) {
            // Recipe inserted successfully.
            header("Location: account.php");
            exit();
        } else {
            // Handle insertion failure
            echo "Failed to insert the recipe. Please try again.";
        }
    } else {
        echo "User ID not found for the provided username.";
    }
} else {
    echo "Form submission error.";
}

?>
