<?php
session_start();
include_once('db_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $recipeId = $_GET['id'];
    $username = $_SESSION['username']; 
    $userId = getUserIdByUsername($username);

    // Fetch recipe details based on the recipe ID
    $recipeDetails = getRecipeDetails($recipeId);
    $recipeId = $_GET['id']; // Assuming recipe ID is obtained from URL
    $recipeDetails = getRecipeDetails($recipeId); // Function to get recipe details by ID
    
    // Check if the recipe is already a favorite for the logged-in user
    $isFavorite = isFavoriteRecipe($userId, $recipeId); // Function to check if the recipe is a favorite
    
    if ($recipeDetails) {
        // Display the recipe details
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <title><?php echo $recipeDetails['recipe_title']; ?> - Recipe Details</title>
        </head>
        <body>
            <!-- Include your header and navigation -->
            <?php include_once('header.php'); ?>
            <?php include_once('navbar.php'); ?>
            <?php include_once('db_functions.php'); ?>
            <link rel="stylesheet" href="css/recipe_det.css">
            <div class="container">
            <?php if ($isFavorite) : ?>
                <form action="toggle_favorite.php" method="post">
                    <input type="hidden" name="recipe_id" value="<?php echo $recipeId; ?>">
                    <button type="submit" class="remove-favorite">Remove from Favorites ❤️</button>
                </form>
            <?php else : ?>
                <form action="toggle_favorite.php" method="post">
                <input type="hidden" name="recipe_id" value="<?php echo $recipeId; ?>">
                <button type="submit" class="add-favorite">Add to Favorites</button>
                </form>
            <?php endif; ?>
            <h1><?php echo $recipeDetails['recipe_title']; ?></h1>
            <img src="<?php echo $recipeDetails['photo']; ?>" alt="<?php echo $recipeDetails['recipe_title']; ?>" style="width: 300px; height: 200px;">
            <h3>Description:</h3> <p><?php echo $recipeDetails['description']; ?></p>
            <!-- Display other recipe details -->
            <h5>Instructions:</h5><p> <?php echo $recipeDetails['instructions']; ?></p>
            <h5>Ingredients:</h5><li> <?php echo $recipeDetails['ingredients']; ?></li>
            <!-- Add more details as needed -->
            </div>


            <!-- Include your footer and any other closing tags -->
        </body>
        </html>
        <?php
    } else {
        echo "Recipe details not found.";
    }
} else {
    echo "Invalid request method or missing recipe ID.";
}
?>
