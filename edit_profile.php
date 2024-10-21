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
    <link rel="stylesheet" href="output.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href=".css">
  <link rel="stylesheet" href="main.css">
</head>
<body>
<nav
        class="hidden  sm:flex sm:max-w-xl md:max-w-2xl lg:max-w-5xl xl:max-w-7xl       w-full items-center justify-between max-w-7xl mx-auto font-poppins py-4">
        <a href="index.php"><img src="./images/logo/logo.png" alt="logo" class="w-36"></a>
        <div class="flex sm:gap-1 md:gap-2">
            <a href="orders.php"
                class="hover:bg-gray-200 transition-all flex gap-1 ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4 text-black">
                <img class="nav__link-icon h-6" src="images/favicons/tableware_50px.png">
                <span class="nav__link-item px-2">Orders</span> 
            </a>
            <a href="#"
                class="hover:bg-gray-200 transition-all flex gap-1 ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4 text-black">
                <img class="nav__link-icon h-6"  src="images/favicons/phone_32px.png">
                <span class="nav__link-item px-2">Contact </span>
            </a>
            <form action="pin_search.php" method="post" class="flex gap-2">
                <input type="text" class=" h-12 border-2 border-black w-48 p-2 rounded-full" id="searchBar" name="pincode" placeholder="Search by Pincode" required style="border: 1px solid black;"> 
                <input type="submit" class="btn-dark py-1 px-2 text-white rounded-xl cursor-pointer" style="background-color: black;" value="Search">
            </form>
            
        </div>

        <div>
            <!-- <?php 
                echo '<a href="user_login.php" class="bg-red-500 hover:bg-red-600 transition-all ease-in-out duration-75 cursor-pointer w-max px-6 py-2 text-white rounded-full">Logout</a>';
             ?> -->
             <li class="nav__link dropdown h-full flex items-center relative"  onclick="toggle()">
                      <a class="nav__link-item flex gap-2" href="#" id="navbarDropdown" role="button">
                          <img class="nav__link-icon h-8" src="images/favicons/user_male_circle_32px.png">
                          <span class="nav__link-item h-8 flex justify-center items-center">
                            <p>
                                <?php echo $_SESSION['name']; ?>
                            </p>
                          </span>
                      </a>
                      <div class="hidden absolute flex-col right-1/2 translate-x-1/2 top-12 w-48 border-2 rounded-md p-2 border-black" id="options" style="right: 50%; transform: translateX(50%);">
                          <a class="dropdown-item border-b-2 border-black text-center" href="profile.php">Profile</a>
                          <a class="dropdown-item border-b-2 border-black text-center" href="new_track_order.php">Track Order</a>
                          <a class="dropdown-item border-b-2 border-black text-center" href="change_password.php">Change Password</a>
                          <a class="dropdown-item text-center" href="user_logout.php">Logout</a>
                      </div>
            </li>

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