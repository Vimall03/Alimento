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
  <link rel="stylesheet" href=".css">
  <link rel="stylesheet" href="main.css">

</head>

<body>


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
                  <li class="nav__link">
                      <a href="track_order.php">
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
                  <li class="nav__link">
                      <a href="user_logout.php">
                          <img class="nav__link-icon" style="width: 1.9rem" src="images/favicons/user_male_circle_32px.png">
                          <span class="nav__link-item">Logout</span> 
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
  <div class="container mt-5">
    <br>
            <h1 class="card-title">Top Restaurants</h1>
            <br>
            <div class="container">
    <div class="row">
        <?php
        include 'partials/_dbconnect.php';
        $query = "SELECT * FROM `restaurant` ORDER BY `r_rating` DESC";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);

        if ($num >= 1) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="col-md-4 mb-4">
                          <div class="card">
                            <img src="vendor/' . $row['r_bg'] . '" class="card-img-top" alt="' . $row['r_name'] . '">
                            <div class="card-body">
                                <h5 class="card-title">' . $row['r_name'] . '</h5>
                                <p class="card-text">Cuisine: ' . $row['r_cuisine'] . '</p>
                                <p class="card-text">Rating: ' . $row['r_rating'] . '</p>
                                <a href="menu.php?id=' . $row['r_id'] . '" class="btn btn-primary btn-block">View Menu</a>
                            </div>
                          </div>
                      </div>';
            }
        } else {
            echo '<div class="col">
                      <p>No restaurants found.</p>
                  </div>';
        }
        ?>
    </div>
</div>


  </div>
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
</body>

</html>