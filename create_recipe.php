<!-- Group members:
Aswin Kizhuppully Santhosh     :041098900
SAVIO GOPURAN BABU             :041098027
session                        :320
Lab: Assignment 2 -->
<?php
session_start(); // Start session

include_once "db_functions.php"; 

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Get username from the session
$loggedInUsername = $_SESSION['username'];

// Get user details
$userDetails = getUserDetails($loggedInUsername);

// Get user ID for creating recipes
// Assuming 'user_id' is a unique identifier in the 'users' table
$userID = $userDetails['user_id'];

include_once "header.php";
include_once "navbar.php";
?>

<body>
    <head>
        <link rel="stylesheet" href="css/register.css">
    </head>
    <h1>Create Recipe</h1>
    <form action="process_recipe.php" method="POST">
        <label for="recipe_title">Recipe Title:</label>
        <input type="text" id="recipe_title" name="recipe_title"><br><br>
        
        <label for="photo">Photo URL:</label>
        <input type="text" id="photo" name="photo"><br><br>

        <label for="ingredients">Ingredients:</label>
        <textarea id="ingredients" name="ingredients"></textarea>
        <br>
        
        <label for="description">Description:</label><br>
        <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

        <label for="instructions">Instructions:</label><br>
        <textarea id="instructions" name="instructions" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Create Recipe">
    </form>
</body>
