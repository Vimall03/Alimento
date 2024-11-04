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
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $login_status = true;
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa"
        crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Document</title>
</head>

<body class="bg-[#F0EAEA]">

    <div class="gtranslate_wrapper"></div>
    <script>
        window.gtranslateSettings = {
            "default_language": "en",
            "detect_browser_language": true,
            "wrapper_selector": ".gtranslate_wrapper"
        }
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>


    <nav
        class="hidden lg:flex sm:max-w-xl md:max-w-2xl lg:max-w-5xl xl:max-w-7xl w-full items-center justify-between max-w-7xl mx-auto font-poppins py-4">
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

    <div class="w-full max-w-[1140px] lg:p-0 p-6 mx-auto mt-5">
        <br>
        <h1 class="card-title text-2xl font-bold">Restaurants in "<?php echo $pincode ?>"</h1>
        <br>
        <div class="row w-full flex flex-wrap">
            <?php

            if ($num >= 1) {
                while ($row = mysqli_fetch_array($result)) {
                    echo '
                    <div class="w-full md:w-[33%] mb-4">
                                  <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                    <img src="vendor/' . $row['r_bg'] . '" class="w-full h-48 object-cover" alt="' . $row['r_name'] . '">
                                    <div class="p-4">
                                        <h5 class="text-lg font-semibold mb-2">' . $row['r_name'] . '</h5>
                                        <p class="text-gray-700 mb-1">Cuisine: ' . $row['r_cuisine'] . '</p>
                                        <p class="text-gray-700 mb-3">Rating: ' . $row['r_rating'] . '</p>
                                        <a href="menu.php?id=' . $row['r_id'] . '" class="block text-center bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">View Menu</a>
                                    </div>
                                  </div>
                    </div>
                    
                    ';
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
    <script src="menu.js"></script>
</body>

</html>