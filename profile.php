<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: user_login.php");
  exit;
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $login_status = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> -->
  <!-- <link rel="stylesheet" href="main.css"> -->
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <!-- Bootstrap icons  -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
  <!-- <link rel="stylesheet" href="main.css"> -->
  <link rel="stylesheet" href="output.css">
  <script src="menu.js"></script>
  
</head>

<body>
  <div class="gtranslate_wrapper"></div>
  <script>window.gtranslateSettings = { "default_language": "en", "detect_browser_language": true, "wrapper_selector": ".gtranslate_wrapper" }</script>
  <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

  <nav
    class="hidden  lg:flex sm:max-w-xl md:max-w-2xl lg:max-w-5xl xl:max-w-7xl w-full items-center justify-between max-w-7xl mx-auto font-poppins py-4">
    <a href="index.php"><img src="./images/logo/logo.webp" alt="logo" class="w-36"></a>
    <div class="flex sm:gap-1 md:gap-2">
      <a href="home.php"
        class="hover:bg-gray-200 transition-all ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4">Restaurants</a>
      <a href="new_track_order.php"
        class="hover:bg-gray-200 transition-all ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4">Orders</a>
      <a href="#"
        class="hover:bg-gray-200 transition-all ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4">Contact</a>
      <?php if ($login_status == true) {
        echo '<a href="profile.php" class="hover:bg-gray-200 transition-all ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4">Account</a>';
      } ?>
    </div>
    <div class="flex">

      <div class="mx-3">
        <?php if ($login_status == true) {
          echo '<a href="user_logout.php" class="bg-red-500 hover:bg-red-600 transition-all ease-in-out duration-75 cursor-pointer w-max px-6 py-2 text-white rounded-full">Logout</a>';
        } else {
          echo '<a href="user_login.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Login</a>';
        } ?>
      </div>

  </nav>

  <!-- nav for small device  -->
  <div class="flex items-center justify-between max-w-7xl mx-auto font-poppins bg-white py-3 px-5 lg:hidden">
    <a href="index.php"><img src="./images/logo/logo.webp" alt="logo" class="w-36 "></a>
    <i class="bi bi-list menu select-none text-3xl"></i>
  </div>
  <div class="bg-gray-200 w-full top-5 font-poppins overflow-hidden px-5 py-3 hidden lg:hidden mb-5" id="nav-items">
    <div class="flex flex-col gap-4">
      <a href="#"
        class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Restaurants</a>
      <a href="new_track_order.php"
        class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Orders</a>
      <a href="#"
        class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Contact</a>
      <?php if ($login_status == true) {
        echo '<a href="profile.php" class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Account</a>';
      } ?>
      <div>
        <h2 class="text-base text-gray-400 mt-3">User actions</h2>
        <div class="h-[1px] bg-gray-300 w-full"></div>
      </div>
      <?php if ($login_status == true) {
        echo '<a href="user_logout.php" class="bg-red-500 hover:bg-red-600 transition-all ease-in-out duration-75 cursor-pointer w-max px-6 py-2 text-white rounded-full">Logout</a>';
      } else {
        echo '<a href="user_login.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Login</a>';
      }
      ?>
    </div>
  </div>

  <div class="profile-container bg-[#f7f7f7] flex justify-center items-center h-screen">
    <div class="profile-card bg-white p-5 rounded-lg w-[500px] shadow-md">
      <div class="profile-header bg-[#f7f7f7] p-5 border-b text-center border-[#ddd]">
        <h2 class="font-bold text-[#333] mb-[10px]">Profile Information</h2>
      </div>
      <div class="profile-body p-5">
        <img src="images/default_profile.webp" class="profile-image w-[150px] h-[150px] rounded-[50%] mx-auto my-5 shadow-md" alt="Profile Image">
        <?php
        include 'partials/_dbconnect.php';
        $query = "SELECT * FROM `users` WHERE `user_id` = '" . $_SESSION['user_id'] . "'";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);

        if ($num >= 1) {
          while ($row = mysqli_fetch_array($result)) {
            echo '<div class="profile-info border-b border-[#ddd] pb-[10px] flex justify-between items-center mb-5">
                  <span class="info-label text-[#333] font-bold mr-[10px]">Name:</span>
                  <span>' . $row['name'] . '</span>
                </div>
                <div class="profile-info border-b border-[#ddd] pb-[10px] flex justify-between items-center mb-5">
                  <span class="info-label text-[#333] font-bold mr-[10px]">Email:</span>
                  <span>' . $row['email'] . '</span>
                </div>
                <div class="profile-info border-b border-[#ddd] pb-[10px] flex justify-between items-center mb-5">
                  <span class="info-label text-[#333] font-bold mr-[10px]">Phone:</span>
                  <span>' . $row['phone'] . '</span>
                </div>
                <div class="profile-info border-b border-[#ddd] pb-[10px] flex justify-between items-center mb-5">
                  <span class="info-label text-[#333] font-bold mr-[10px]">Address:</span>
                  <span>' . $row['address'] . '</span>
                </div>';
          }
        } else {
          echo '<p class="text-lg mb-5 text-[#666]">No profile found.</p>';
        }
        ?>
        <?php
        $order_query = "SELECT COUNT(*) as total_orders FROM `orders` WHERE `user_id` = '" . $_SESSION['user_id'] . "'";
        $order_result = mysqli_query($conn, $order_query);
        $order_row = mysqli_fetch_array($order_result);
        $review_query = "SELECT COUNT(*) as total_reviews FROM `reviews` WHERE `user_id` = '" . $_SESSION['user_id'] . "'";
        $review_result = mysqli_query($conn, $review_query);
        $review_row = mysqli_fetch_array($review_result);
        $rating_query = "SELECT AVG(`rating`) as average_rating FROM `reviews` WHERE `user_id` = '" . $_SESSION['user_id'] . "'";
        $rating_result = mysqli_query($conn, $rating_query);
        $rating_row = mysqli_fetch_array($rating_result);
        ?>
        <div class="profile-stats flex justify-between border-b border-[#ddd] pb-[10px] items-center mb-5">
          <div class="stat mr-5">
            <span class="stat-label text-[#333] font-bold mb-[5px]">Total Orders:</span>
            <span class="stat-value text-2xl font-bold text-[#666]"><?php echo $order_row['total_orders']; ?></span>
          </div>
          <div class="stat mr-5">
            <span class="stat-label text-[#333] font-bold mb-[5px]">Total Reviews:</span>
            <span class="stat-value text-2xl font-bold text-[#666]"><?php echo $review_row['total_reviews']; ?></span>
          </div>
          <div class="stat mr-5">
            <span class="stat-label text-[#333] font-bold mb-[5px]">Average Rating:</span>
            <span class="stat-value text-2xl font-bold text-[#666]"><?php echo round($rating_row['average_rating'], 1); ?>/5</span>
          </div>
        </div>
        <div class="profile-actions mt-5 text-center flex justify-center gap-8">
          <a href="edit_profile.php" class="my-0 mt-[10px] hover:underline">Edit Profile</a>
          <a href="change_password.php" class="my-0 mt-[10px] hover:underline">Change Password</a>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>