<!-- Group members:
Aswin Kizhuppully Santhosh     :041098900
SAVIO GOPURAN BABU             :041098027
session                        :320
Lab: Assignment 2 -->
<?php
function connectDB() {
    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "recipemanager";
    $db_port = 3308;

    $conn = new mysqli($db_server, $db_username, $db_password, $db_name, $db_port);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}
function getUserDetails($username) {
    $conn = connectDB();

    $stmt = $conn->prepare("SELECT user_id, username, email FROM users WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $stmt->close(); // Close the statement
            return $row;
        } else {
            $stmt->close(); 
            return null; 
        }
    } else {
        return null;
    }
}
function getUserRecipes($user_id) {
    $conn = connectDB();

    $stmt = $conn->prepare("SELECT recipe_id, recipe_title, photo, description, instructions FROM recipes WHERE user_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $recipes = array();
        while ($row = $result->fetch_assoc()) {
            $recipes[] = $row;
        }

        return $recipes;

    } else {
        return null;
    }


}
function getUserFavorites($user_id) {
    $conn = connectDB();

    $stmt = $conn->prepare("SELECT recipes.recipe_id, recipes.recipe_title, recipes.photo, recipes.description FROM favorites INNER JOIN recipes ON favorites.recipe_id = recipes.recipe_id WHERE favorites.user_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $favorites = array();
        while ($row = $result->fetch_assoc()) {
            $favorites[] = $row;
        }

        return $favorites;

    } else {
        return null;
    }

}
function insertRecipe($user_id, $title, $photo, $description, $instructions, $ingredients) {
    $conn = connectDB();

    $stmt = $conn->prepare("INSERT INTO recipes (user_id, recipe_title, photo, description, instructions, ingredients) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("ssssss", $user_id, $title, $photo, $description, $instructions, $ingredients);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            return true; 
        } else {
            $stmt->close();
            $conn->close();
            return false; 
        }
    } else {
        $conn->close();
        return false; 
    }
}
function getUserIdByUsername($username) {
    $db_server = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "recipemanager";
    $db_port = 3308;

    $conn = new mysqli($db_server, $db_username, $db_password, $db_name, $db_port);

    $stmt = $conn->prepare("SELECT user_id FROM users WHERE username = ?");
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['user_id'];
        } else {
            return null; // Username not found
        }

    } else {
        return null; // Statement preparation error
    }
}
function searchRecipes($searchTerm) {
    $conn = connectDB();

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM recipes WHERE recipe_title LIKE ?");
    if ($stmt) {
        $search = '%' . $searchTerm . '%';
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $recipes = $result->fetch_all(MYSQLI_ASSOC);
            $stmt->close();
            $conn->close();
            return $recipes;
        } else {
            $stmt->close();
            $conn->close();
            return null; // No matching recipes
        }
    } else {
        $conn->close();
        return null; // Statement preparation error
    }
}
// Assuming you have a function to connect to your database called connectDB()
function getRecipeDetails($recipeId) {
    $conn = connectDB();

    $stmt = $conn->prepare("SELECT * FROM recipes WHERE recipe_id = ?");
    if ($stmt) {
        $stmt->bind_param("i", $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $recipeDetails = $result->fetch_assoc();
            return $recipeDetails;
        } else {
            return null; // Recipe not found
        }

    } else {
        // Handle statement preparation error
        return null;
    }
}
// Assume this function checks if a recipe is a favorite for a user
function isFavoriteRecipe($userId, $recipeId) {
    // Connect to the database and perform a query to check if the recipe is a favorite for the user
    $conn = connectDB();

    // Prepare and execute a query to check if the recipe is a favorite for the user
    $stmt = $conn->prepare("SELECT favorite_id FROM favorites WHERE user_id = ? AND recipe_id = ?");
    if ($stmt) {
        $stmt->bind_param("ii", $userId, $recipeId);
        $stmt->execute();
        $result = $stmt->get_result();

        // If a row exists in the result set, it's a favorite
        if ($result->num_rows > 0) {
            return true;
        }
    }

    return false; // Recipe is not a favorite
}
// Include your database connection or any necessary files here
function addFavorite($userId, $recipeId)
{
    // Perform your database query to add a recipe to favorites for a user
    // Example using mysqli
    $conn = connectDB();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO favorites (user_id, recipe_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $userId, $recipeId);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
function removeFavorite($userId, $recipeId)
{
    // Perform your database query to remove a recipe from favorites for a user
    // Example using mysqli
    $conn = connectDB();

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = ? AND recipe_id = ?");
    $stmt->bind_param("ii", $userId, $recipeId);
    $stmt->execute();
    $stmt->close();
    $conn->close();
}
?>
