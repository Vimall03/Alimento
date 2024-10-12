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
  <title>Profile</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href=".css">
  <link rel="stylesheet" href="main.css">
  <style>
    .profile-container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .profile-card {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .profile-card h2 {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .profile-card p {
      font-size: 18px;
      margin-bottom: 20px;
    }
    .profile-card .profile-info {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .profile-card .profile-info .info-label {
      font-weight: bold;
      margin-right: 10px;
    }
    .profile-image {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      margin: 20px auto;
    }
    .profile-header {
      background-color: #f7f7f7;
      padding: 20px;
      border-bottom: 1px solid #ddd;
    }
    .profile-header h2 {
      font-weight: bold;
      margin-bottom: 10px;
    }
    .profile-body {
      padding: 20px;
    }
    .profile-stats {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }
    .profile-stats .stat {
      margin-right: 20px;
    }
    .profile-stats .stat .stat-label {
      font-weight: bold;
      margin-bottom: 5px;
    }
    .profile-stats .stat .stat-value {
      font-size: 24px;
      font-weight: bold;
    }
  </style>
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
                          <img class="nav__link-icon" style="width: 1.8rem" src=" images /favicons/tableware_50px.png">
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
<style>
  .profile-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f7f7f7;
  }

  .profile-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 500px;
  }

  .profile-card h2 {
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
  }

  .profile-card p {
    font-size: 18px;
    margin-bottom: 20px;
    color: #666;
  }

  .profile-card .profile-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
  }

  .profile-card .profile-info .info-label {
    font-weight: bold;
    margin-right: 10px;
    color: #333;
  }

  .profile-image {
    width: 150px;
    height: 150px;
    border-radius: 50%;
    margin: 20px auto;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .profile-header {
    background-color: #f7f7f7;
    padding: 20px;
    border-bottom: 1px solid #ddd;
    text-align: center;
  }

  .profile-header h2 {
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
  }

  .profile-body {
    padding: 20px;
  }

  .profile-stats {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
  }

  .profile-stats .stat {
    margin-right: 20px;
  }

  .profile-stats .stat .stat-label {
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
  }

  .profile-stats .stat .stat-value {
    font-size: 24px;
    font-weight: bold;
    color: #666;
  }

  .profile-actions {
    margin-top: 20px;
    text-align: center;
  }

  .profile-actions a {
    margin: 0 10px;
  }
</style>

<div class="profile-container">
  <div class="profile-card">
    <div class="profile-header">
      <h2>Profile Information</h2>
    </div>
    <div class="profile-body">
      <img src="images/default_profile.png" class="profile-image" alt="Profile Image">
      <?php
      include 'partials/_dbconnect.php';
      $query = "SELECT * FROM `users` WHERE `user_id` = '".$_SESSION['user_id']."'";
      $result = mysqli_query($conn, $query);
      $num = mysqli_num_rows($result);

      if ($num >= 1) {
        while ($row = mysqli_fetch_array($result)) {
          echo '<div class="profile-info">
                  <span class="info-label">Name:</span>
                  <span>'.$row['name'].'</span>
                </div>
                <div class="profile-info">
                  <span class="info-label">Email:</span>
                  <span>'.$row['email'].'</span>
                </div>
                <div class="profile-info">
                  <span class="info-label">Phone:</span>
                  <span>'.$row['phone'].'</span>
                </div>
                <div class="profile-info">
                  <span class="info-label">Address:</span>
                  <span>'.$row['address'].'</span>
                </div>';
        }
      } else {
        echo '<p>No profile found.</p>';
      }
      ?>
      <?php
      $order_query = "SELECT COUNT(*) as total_orders FROM `orders` WHERE `user_id` = '".$_SESSION['user_id']."'";
      $order_result = mysqli_query($conn, $order_query);
      $order_row = mysqli_fetch_array($order_result);
      $review_query = "SELECT COUNT(*) as total_reviews FROM `reviews` WHERE `user_id` = '".$_SESSION['user_id']."'";
      $review_result = mysqli_query($conn, $review_query);
      $review_row = mysqli_fetch_array($review_result);
      $rating_query = "SELECT AVG(`rating`) as average_rating FROM `reviews` WHERE `user_id` = '".$_SESSION['user_id']."'";
      $rating_result = mysqli_query($conn, $rating_query);
      $rating_row = mysqli_fetch_array($rating_result);
      ?>
      <div class="profile-stats">
        <div class="stat">
          <span class="stat-label">Total Orders:</span>
          <span class="stat-value"><?php echo $order_row['total_orders']; ?></span>
        </div>
        <div class="stat">
          <span class="stat-label">Total Reviews:</span>
          <span class="stat-value"><?php echo $review_row['total_reviews']; ?></span>
        </div>
        <div class="stat">
          <span class="stat-label">Average Rating:</span>
          <span class="stat-value"><?php echo round($rating_row['average_rating'], 1); ?>/5</span>
        </div>
      </div>
      <div class="profile-actions">
        <a href="edit_profile.php">Edit Profile</a>
        <a href="change_password.php">Change Password</a>
      </div>
    </div>
  </div>
</div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src ="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>