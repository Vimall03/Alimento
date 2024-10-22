<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $query = "SELECT * FROM `users` WHERE `user_id` = '".$_SESSION['user_id']."'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($old_password, $row['password'])) {
            if ($new_password == $confirm_password) {
                $hash = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE `users` SET `password` = '$hash' WHERE `user_id` = '".$_SESSION['user_id']."'";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    echo '<script>alert("Password changed successfully!")</script>';
                } else {
                    echo '<script>alert("Failed to change password!")</script>';
                }
            } else {
                echo '<script>alert("New password and confirm password do not match!")</script>';
            }
        } else {
            echo '<script>alert("Old password is incorrect!")</script>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href=".css">
  <link rel="stylesheet" href="main.css">
</head>
<body>
<style>
  .change-password-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f7f7f7;
  }

  .change-password-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 500px;
  }

  .change-password-card h2 {
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
  }

  .change-password-form {
    margin-top: 20px;
  }

  .change-password-form label {
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
  }

  .change-password-form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  .change-password-form button {
    width: 100%;
    padding: 10px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .change-password-form button:hover {
    background-color: #555;
  }

</style>

<nav class="nav">
  <div class="nav__wrapper grid">
    <div class="grid__span2 nav__logo-wrap">
      <a href="home.php">
        <img class="nav__logo-img" src="images/logo/logo.webp">                
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
            <img class="nav__link-icon" style="width: 1.9rem" src="images/favicons/user_male_circle_32px.webp">
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
            <img class="nav__link-icon" style="width: 1.8rem" src="images/favicons/tableware_50px.webp">
            <span class="nav__link-item">Orders</span> 
          </a>
        </li>
        <li class="nav__link">
          <a href="#contact ">
            <img class="nav__link-icon" style="width: 1.8rem" src="images/favicons/phone_50px.webp">
            <span class="nav__link-item">Contact</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="change-password-container">
  <div class="change-password-card">
    <h2>Change Password</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="change-password-form">
      <label for="old_password">Old Password:</label>
      <input type="password" class="form-control" id="old_password" name="old_password" required>
      <label for="new_password">New Password:</label>
      <input type="password" class="form-control" id="new_password" name="new_password" required>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
      <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
  </div>
</div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src ="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>