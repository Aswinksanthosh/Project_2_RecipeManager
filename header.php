<!-- Group members:
Aswin Kizhuppully Santhosh     :041098900
SAVIO GOPURAN BABU             :041098027
session                        :320
Lab: Assignment 2 -->
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <title>Recipe Manager</title>
    <!-- Bootstrap CSS link -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<script>
        let searchFieldClicks = 0;
        let recipeManagerClicks = 0;

        function displayCreditPopup() {
            if (searchFieldClicks === 4 && recipeManagerClicks === 2) {
                alert("Made by Aswin K Santhosh :)");
                searchFieldClicks = 0; // Resetting the click counts
                recipeManagerClicks = 0;
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const searchField = document.querySelector('input[name="search"]');
            const recipeManagerLink = document.querySelector('.navbar-brand');

            searchField.addEventListener('click', function () {
                searchFieldClicks++;
                displayCreditPopup();
            });

            recipeManagerLink.addEventListener('click', function () {
                recipeManagerClicks++;
                displayCreditPopup();
            });
        });
    </script>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Recipe Manager</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div style="">
            <form action="search_results.php" method="GET" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>

            </div>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="account.php">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
