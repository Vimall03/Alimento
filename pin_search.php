<?php
session_start();
include 'partials/_dbconnect.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pincode = $_POST['pincode'];
    $query = "SELECT * FROM `restaurant` WHERE `r_pincode` LIKE '$pincode' ORDER BY `r_rating` DESC";
                $result = mysqli_query($conn, $query);
                $num = mysqli_num_rows($result);
}


?> 



<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>

<body>


    
<nav class="nav">
      <div class="nav__wrapper grid">
          <div class="grid__span2 nav__logo-wrap">
              <a href="index.html">
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
          <div class="theme-switch-wrapper">
            <label class="theme-switch" for="checkbox">
              <input type="checkbox" id="checkbox" />
              <div class="slider"></div>
            </label>
            <span id="mode-label">Light Mode</span>
          </div>
      </div>
  </nav>
<br>
<br>
<br>
<br>
  <div class="container mt-5">
    <br>
            <h1 class="card-title">Restaurants in "<?php echo $pincode ?>"</h1>
            <br>
            <div class="row">
                <?php
                
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
  <script src="./darkMode.js"></script>
</body>

</html>