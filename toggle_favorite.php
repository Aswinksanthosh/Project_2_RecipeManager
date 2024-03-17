<?php
session_start();
include_once('db_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['username'])) {
    // Fetch user ID from session
    $username = $_SESSION['username']; 
    $userId = getUserIdByUsername($username);

    // Fetch recipe ID from the form
    $recipeId = $_POST['recipe_id'];    

    // Check if the recipe is already a favorite
    $isFavorite = isFavoriteRecipe($userId, $recipeId);

    if ($isFavorite) {
        // Remove from favorites if already a favorite
        removeFavorite($userId, $recipeId);
        echo "Removed from favorites";
    } else {
        // Add to favorites if not a favorite
        addFavorite($userId, $recipeId);
        echo "Added to favorites";
    }
} else {
    // Handle if user is not logged in or if it's not a POST request
    echo "Error: Unable to toggle favorite.";
}
?>
