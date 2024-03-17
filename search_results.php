<?php
session_start();
include_once('db_functions.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $search = $_GET['search'];

    // Perform a search in the database using SQL queries or functions
    // Fetch recipes based on the search term

    // Example query (replace this with your specific logic)
    $matchingRecipes = searchRecipes($search);

    // Display the matching recipes
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Search Results - Recipe Manager</title>
        <link rel="stylesheet" href="path/to/your/styles.css">
    </head>
    <body>
        <!-- Include your header and navigation -->
        <?php include_once('header.php'); ?>
        <?php include_once('navbar.php'); ?>
        <?php include_once('db_functions.php'); ?>

        <div class="container">
            <h2>Search Results for "<?php echo $search; ?>"</h2>
            <div class="recipe-manager">
                <?php
                if ($matchingRecipes) {
                    foreach ($matchingRecipes as $recipe) {
                        $username = $_SESSION['username']; 
                        $userId = getUserIdByUsername($username);
                        $recipeId = $recipe['recipe_id'];
                        $isFavorite = isFavoriteRecipe($userId, $recipeId);
                        ?>
                        <a href="recipe_details.php?id=<?php echo $recipe['recipe_id']; ?>" class="recipe-link">
                            <div class="recipe">
                                <?php if ($isFavorite) : ?>
                                    <div class="favorite-icon">
                                        ❤️ <!-- Display heart icon for favorites -->
                                    </div>
                                <?php endif; ?>
                                <img style="width: 300px; height: 200px;" src="<?php echo $recipe['photo']; ?>" alt="<?php echo $recipe['recipe_title']; ?>">
                                <div class="recipe-content">
                                    <h2><?php echo $recipe['recipe_title']; ?></h2>
                                    <p>Description: <?php echo $recipe['description']; ?></p>
                                </div>
                            </div>
                        </a>
                        <?php
                    }
                } else {
                    echo "No matching recipes found.";
                }
                ?>
            </div>

        </div>

        <!-- Include your footer and any other closing tags -->
    </body>
    </html>
    <?php
} else {
    echo "Invalid request method.";
}
?>
