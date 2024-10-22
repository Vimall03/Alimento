<?php
session_start();
include 'partials/_dbconnect.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
    exit;
}
$userId = $_SESSION['user_id'];
$updateMsg = '';
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$userData = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $updateSql = "UPDATE users SET name = ?, email = ?, phone = ?, address = ? WHERE user_id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ssisi", $name, $email, $phone, $address, $userId);
    
    if ($updateStmt->execute()) {
        $updateMsg = "Profile updated successfully!";
    } else {
        $updateMsg = "Error updating profile. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href=".css">
  <link rel="stylesheet" href="main.css">
</head>
<body>
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
                      <a href="#contact">
                          <img class="nav__link-icon" src="images/favicons/phone_32px.webp">
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
    <?php include 'partials/_dbconnect.php'; ?>
    <div class="container mt-5">
        <h2>Edit Profile</h2>
        <?php if ($updateMsg): ?>
            <div class="alert alert-info"><?php echo $updateMsg; ?></div>
        <?php endif; ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($userData['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($userData['phone']); ?>" required>
            </div>
            <div class="form-group">
                <label for="phone">Adddress:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($userData['address']); ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <div class="gtranslate_wrapper"></div>
      <script>window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper"}</script>
      <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

</body>
</html>