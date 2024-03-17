<!-- Group members:
Aswin Kizhuppully Santhosh     :041098900
SAVIO GOPURAN BABU             :041098027
session                        :320
Lab: Assignment 2 -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Account - Recipe Manager</title>
    <link rel="stylesheet" href="css/item.css">
</head>

<body>
    <?php
    session_start();

    include_once('db_functions.php');

    if (!isset($_SESSION['username'])) {
        header("Location: login.php");
        exit();
    }

    $userDetails = getUserDetails($_SESSION['username']);
    $userRecipes = getUserRecipes($userDetails['user_id']);
    $userFavorites = getUserFavorites($userDetails['user_id']);
    ?>

    <?php include_once('header.php'); ?>
    <?php include_once('navbar.php'); ?>

    <div class="container">
        <h2>Welcome, <?php echo $userDetails['username']; ?>!</h2>
        <p>Email: <?php echo $userDetails['email']; ?></p>

        <h3>Create Recipe</h3>
        <a href="create_recipe.php">Create a new recipe</a>

        <h3>Your Recipes:</h3>
        <div class="recipe-manager">
            <?php foreach ($userRecipes as $recipe) : ?>
                <a href="recipe_details.php?id=<?php echo $recipe['recipe_id']; ?>" class="recipe-link">
                    <div class="recipe">
                        <img style="width: 300px;height: 200px;" src="<?php echo $recipe['photo']; ?>" alt="<?php echo $recipe['recipe_title']; ?>">
                        <div class="recipe-content">
                            <h2><?php echo $recipe['recipe_title']; ?></h2>
                            <p>Description: <?php echo $recipe['description']; ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <br><br><br>
        <h3>Your Favorite Recipes:</h3>
        <div class="recipe-manager">
        <?php if ($userFavorites) : ?>
            <ul>
            <?php foreach ($userFavorites as $recipe) : ?>
                <a href="recipe_details.php?id=<?php echo $recipe['recipe_id']; ?>" class="recipe-link">
                    <div class="recipe">
                        <img style="width: 300px;height: 200px;" src="<?php echo $recipe['photo']; ?>" alt="<?php echo $recipe['recipe_title']; ?>">
                        <div class="recipe-content">
                            <h2><?php echo $recipe['recipe_title']; ?></h2>
                            <p>Description: <?php echo $recipe['description']; ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>No favorite recipes yet.</p>
        <?php endif; ?>
        </div>
    </div>

    <footer>
    </footer>
    <script src="scripts.js"></script>
</body>

</html>
