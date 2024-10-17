<?php
session_start();

// Session security enhancement: Regenerate session ID to prevent fixation attacks.
session_regenerate_id(true);

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: user_login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Finder</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="main.css"> <!-- Fixed invalid CSS link -->
</head>
<body>

<!-- Navigation Bar -->
<nav class="nav">
    <div class="nav__wrapper grid">
        <div class="grid__span2 nav__logo-wrap">
            <a href="home.php">
                <img class="nav__logo-img" src="images/logo/Logo.png" alt="Restaurant Finder Logo">                
            </a>
        </div>
        <div class="grid__span10 nav__links-wrap">
            <ul class="nav__links">
                <!-- Search Form -->
                <li class="nav__link">
                    <form action="pin_search.php" method="POST" class="form-inline">
                        <input type="text" class="form-control mr-2" id="searchBar" name="pincode" placeholder="Search by Pincode" required>
                        <input type="submit" class="btn btn-dark" value="Search">
                    </form>
                </li>

                <!-- User Dropdown Menu -->
                <li class="nav__link dropdown">
                    <a class="nav__link-item dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="nav__link-icon" style="width: 1.9rem" src="images/favicons/user_male_circle_32px.png" alt="User Icon">
                        <span class="nav__link-item">
                            <?php echo htmlspecialchars($_SESSION['name']); // Sanitize output to prevent XSS ?>
                        </span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profile.php">Profile</a>
                        <a class="dropdown-item" href="orders.php">Orders</a>
                        <a class="dropdown-item" href="change_password.php">Change Password</a>
                        <a class="dropdown-item" href="user_logout.php">Logout</a>
                    </div>
                </li>

                <!-- Other Links -->
                <li class="nav__link">
                    <a href="new_track_order.php">
                        <img class="nav__link-icon" style="width: 1.8rem" src="images/favicons/tableware_50px.png" alt="Order Icon">
                        <span class="nav__link-item">Orders</span> 
                    </a>
                </li>
                <li class="nav__link">
                    <a href="#contact">
                        <img class="nav__link-icon" src="images/favicons/phone_32px.png" alt="Contact Icon">
                        <span class="nav__link-item">Contact</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Restaurant Listings -->
<div class="container mt-5">
    <h1 class="card-title">Top Restaurants</h1>

    <div class="container">
        <div class="row">
            <?php
            include 'partials/_dbconnect.php';
            
            // Improved error handling for database connection
            if (!$conn) {
                echo "<p>Unable to connect to the database.</p>";
                exit;
            }

            // Fetch restaurants, ordered by rating
            $query = "SELECT * FROM `restaurant` ORDER BY `r_rating` DESC";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // Sanitize output to prevent XSS
                    $restaurantName = htmlspecialchars($row['r_name']);
                    $restaurantCuisine = htmlspecialchars($row['r_cuisine']);
                    $restaurantRating = htmlspecialchars($row['r_rating']);
                    $restaurantBg = htmlspecialchars($row['r_bg']);
                    $restaurantId = htmlspecialchars($row['r_id']);

                    echo '
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="vendor/' . $restaurantBg . '" class="card-img-top" alt="' . $restaurantName . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $restaurantName . '</h5>
                                <p class="card-text">Cuisine: ' . $restaurantCuisine . '</p>
                                <p class="card-text">Rating: ' . $restaurantRating . '</p>
                                <a href="menu.php?id=' . $restaurantId . '" class="btn btn-primary btn-block">View Menu</a>
                            </div>
                        </div>
                    </div>';
                }
            } else {
                echo '<div class="col"><p>No restaurants found.</p></div>';
            }
            ?>
        </div>
    </div>
</div>

<!-- Embedded Chatbot -->
<script>
window.embeddedChatbotConfig = {
    chatbotId: "gvEIQuZ1QCpui9UuF1UWX",
    domain: "www.chatbase.co"
};
</script>
<script src="https://www.chatbase.co/embed.min.js" defer></script>

<!-- External Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
