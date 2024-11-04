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
    <title>Orders</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href=".css"> -->
    <!-- <link rel="stylesheet" href="main.css"> -->

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap icons  -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- <link rel="stylesheet" href="main.css"> -->
    <link rel="stylesheet" href="output.css">

</head>

<body class="bg-[#F0EAEA]">
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

    <div class="container mt-5">
        <h1 class="card-title font-bold text-lg">Your Orders</h1>
        <br>
        <div class="container">
            <div class="row">
                <?php
                include 'partials/_dbconnect.php';
                $query = "SELECT * FROM `orders` WHERE `user_id` = '" . $_SESSION['user_id'] . "' ORDER BY `dt` DESC";
                $result = mysqli_query($conn, $query);
                $num = mysqli_num_rows($result);

                if ($num >= 1) {
                    while ($row = mysqli_fetch_array($result)) {
                        echo '<div class="col-md-4 mb-4">
                          <div class="order-card p-5 mb-5 shadow-sm rounded-[10px]">
                            <div class="card-body">
                                <h5 class="card-title font-bold text-lg">Item: ' . $row['order'] . '</h5>
                                <p class="card-text text-base">Order ID: ' . $row['order_id'] . '</p>
                                <p class="card-text text-base">Date & Time: ' . $row['dt'] . '</p>
                                <p class="card-text text-base">Order Status: ' . $row['order_status'] . '</p>
                                <p class="card-text text-base">Total: ₹' . $row['amount'] . '</p>
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
    <script src="menu.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>