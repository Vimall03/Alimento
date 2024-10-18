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
  <title>Orders</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href=".css">
  <link rel="stylesheet" href="main.css">
  <style>
    .order-card {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      padding: 20px;
      margin-bottom: 20px;
    }
    .order-card .card-title {
      font-weight: bold;
      font-size: 18px;
    }
    .order-card .card-text {
      font-size: 16px;
    }
  </style>
</head>
<body> <div class="gtranslate_wrapper"></div>
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
              </ul>
          </div>
      </div>
  </nav>
<br>
<br>
<br>
<br>
  <div class="container mt-5">
    <h1 class="card-title">Your Orders</h1>
    <br>
    <div class="container">
    <div class="row">
        <?php
        include 'partials/_dbconnect.php';
        $query = "SELECT * FROM `orders` WHERE `user_id` = '".$_SESSION['user_id']."' ORDER BY `dt` DESC";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);

        if ($num >= 1) {
            while ($row = mysqli_fetch_array($result)) {
                echo '<div class="col-md-4 mb-4">
                          <div class="order-card">
                            <div class="card-body">
                                <h5 class="card-title">Item: '.$row['order'].'</h5>
                                <p class="card-text">Order ID: '.$row['order_id'].'</p>
                                <p class="card-text">Date & Time: '.$row['dt'].'</p>
                                <p class="card-text">Order Status: '.$row['order_status'].'</p>
                                <p class="card-text">Total: ₹'.$row['amount'].'</p>
                            </div>
                          </div>
                      </div>';
            }
        } else {
            echo '<div class="col">
                      <p>No orders found.</p>
                  </div>';
        }
        ?>
    </div>
</div>

  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src ="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>