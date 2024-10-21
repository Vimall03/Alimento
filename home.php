<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
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

  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="home.css">
</head>
<body>



<div class="gtranslate_wrapper"></div>
      <script>window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper"}</script>
      <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

<nav class="nav">
      <div class="nav__wrapper grid">
          <div class="grid__span2 nav__logo-wrap">
              <a href="home.php">
                  <img class="nav__logo-img" src="images/logo/Logo.png">                
              </a>
          </div>
          <div class="grid__span10 nav__links-wrap">
              <ul class="nav__links">

                  <li class="nav__link">
                      
                          <form action="pin_search.php" method="post">
                          <input type="text" class="form-control " id="searchBar" name="pincode" placeholder="Search by Pincode" required>
                  </li>
                  <li class="nav__link">
                      
                          <input type="submit" class="btn-dark form-control " value="Search">
                      </form>
                  </li>
                  <li class="nav__link dropdown">
                      <a class="nav__link-item dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img class="nav__link-icon" style="width: 1.9rem" src="images/favicons/user_male_circle_32px.png">
                          <span class="nav__link-item"><?php echo $_SESSION['name']; ?></span>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="profile.php">Profile</a>
                          <a class="dropdown-item" href="orders.php">Orders</a>
                          <a class="dropdown-item" href="change_password.php">Change Password</a>
                          <a class="dropdown-item" href="user_logout.php">Logout</a>
                      </div>
                  </li>
                  <li class="nav__link">
                      <a href="new_track_order.php">
                          <img class="nav__link-icon" style="width: 1.8rem" src="images/favicons/tableware_50px.png">
                          <span class="nav__link-item">Orders</span> 
                      </a>
                  </li>
                  <li class="nav__link">
                      <a href="#contact">
                          <img class="nav__link-icon" src="images/favicons/phone_32px.png">
                          <span class="nav__link-item">Contact </span>
                      </a>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
<br>
<br>
<br>
<br>


<div id="hero-bg" class="hero-section">
        <div class="overlay">
            <h1><i>Alimento</i></h1>
            <p>Home</p>
        </div>
    </div>


     <!-- Restaurant Section -->
     <section class="restaurants">
        <h2>Restaurants:</h2>
        <div class="restaurant-cards">
            <!-- Restaurant Card -->

            <?php
        include 'partials/_dbconnect.php';
        $query = "SELECT * FROM `restaurant` ORDER BY `r_rating` DESC";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);

        if ($num >= 1) {
            while ($row = mysqli_fetch_array($result)) {
                echo '
                        <div class="card">
                            <img src="vendor/' . $row['r_bg'] . '" alt="' . $row['r_name'] . '">
                            <div style="display:flex;">
                                       <div style="text-align:left;width:50%">
                                            <h3 style="font-weight:bold;margin-top:8px">' . $row['r_name'] . '</h3>
                                            <p class="cuisine">Cuisine: ' . $row['r_cuisine'] . '</p>
                                        </div>

                                        <div style="text-align:right;width:50%">
                                            <p class="discount">30% Discount</p>
                                            <p class="rating">' . (empty($row['r_rating']) ? '-' : str_repeat('★', (int)$row['r_rating'])) . '</p>
                                        </div>
                            
                            </div>
                           <a href="menu.php?id=' . $row['r_id'] . '" class="menu-btn">View Menu</a>
                        </div>

                          


                    ';

            }
        } else {
            echo '<div class="col">
                      <p>No restaurants found.</p>
                  </div>';
        }
        ?>


           
            <!-- Duplicate these cards as needed -->
<!--             
             <div class="card">
                <img src="restaurant1.jpg" alt="Restaurant 1">
                <h3>Restaurant 1</h3>
                <p class="discount">30% Discount</p>
                <p class="cuisine">Cuisine: Global Fusion Cuisine</p>
                <p class="rating">★★★★★</p>
                <button class="menu-btn">View Menu</button>
            </div> -->
        </div>
    </section>

  <script>
window.embeddedChatbotConfig = {
chatbotId: "gvEIQuZ1QCpui9UuF1UWX",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="gvEIQuZ1QCpui9UuF1UWX"
domain="www.chatbase.co"
defer>
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
</body>

</html>