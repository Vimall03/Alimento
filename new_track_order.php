<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
    exit;
}

include 'partials/_dbconnect.php';
$uid = $_SESSION['user_id'];
$feedback = false;


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $r_id = $_POST['r_id'];
    $order_id = $_POST['order_id'];
    $rating = $_POST['rating'];

    $sql = "UPDATE `orders` SET `rating` = '$rating' WHERE `r_id` = '$r_id' AND `order_id` = '$order_id'";
    $result = mysqli_query($conn, $sql);

    $sql = "SELECT * FROM `orders` WHERE `r_id` = '$r_id' AND `rating` != '0'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    $sql = "SELECT SUM(rating) AS 'sum_value' FROM `orders` WHERE `r_id` = '$r_id' AND `rating` != '0'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $sum = $row['sum_value'];

    $new_rating = $sum / $num;

    $sql = "UPDATE `restaurant` SET `r_rating` = '$new_rating' WHERE `r_id` = '$r_id'";
    $result = mysqli_query($conn, $sql);
}

// Fetch orders
$sql = "SELECT * FROM `orders` WHERE `user_id` = '$uid'";
$result = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="main.css"> -->
    <!-- Google fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Google icons  -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=menu" />
    <link rel="stylesheet" href="new_track_order.css">
    <link rel="stylesheet" href="output.css">
    <title>Order Information</title>

</head>

<body>
<div class="gtranslate_wrapper"></div>
      <script>window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper"}</script>
      <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

    <!-- new navbar  -->
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

    <!-- responsive navbar -->
    <div class="responsive-navbar" id="rnav">
        <ul class="nav-links">
            <li><a class="nav-item" href="home.php">Restaurants</a></li>
            <li><a href="new_track_order.php">Orders</a></li>
            <li><a href="index.php#contact">Contact</a></li>
            <li><a href="profile.php">Account</a></li>
        </ul>

        <form action="pin_search.php" method="post">
            <input type="text" class="search-input" placeholder="Search pincode..." name="pincode" id="searchBar"
                required>
            <input type="submit" value="Search" class="search-btn">
        </form>
        <div class="session-links">
            <?php
            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                echo '<a href="user_logout.php" class="signout">Logout</a>';
            } else {
                echo '<a href="user_login.php" class="login">Login</a>';
            }
            ?>
        </div>
    </div>

    <div class="space"></div>
    <!-- Orders section  -->
    <section class="main">
        <h2 class="title">Your Orders</h2>
        <div class="orders-table-container">
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>ItemName</th>
                        <th>Order no</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Total</th>
                
                        <th>Payment Status</th>
                   
                        <th>Update order</th>
                        <th>Feedback</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($orders as $order) {
                        $item = $order['order'];
                        $order_no = $order['order_id'];
                        $username = $order['name'];
                        $date = $order['dt'];
                        // convert date to string
                        $date = date('M d', strtotime($order['dt']));
                        $amount = $order['amount'];
                      
                        $payment = $order['payment'];
                        $payment == "SUCCESS" ? $payment = "Completed" : $payment = "failed";

                        echo ' <tr>
                                <td class="order-item">
                            ' . $item . '
                                    </td>
                                    <td>#' . $order_no . '</td>
                                    <td>' . $username . '</td>
                                    <td>' . $date . '</td>
                                    <td>₹' . $amount . '</td>
                                   
                                    <td><span class="' . $payment . '">' . $payment . '</span></td>
                                   
                                    <td>Delivered</td>
                                    <td>Feedback recieved</td>
                                </tr>            
                        ';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <script src="./darkMode.js"></script>
    <script>
        window.embeddedChatbotConfig = {
            chatbotId: "gvEIQuZ1QCpui9UuF1UWX",
            domain: "www.chatbase.co"
        }

        const option = document.getElementById("options")

    const toggle = ()=>{
        console.log("hii");
        
        if(option.classList.contains("hidden")){
            option.classList.remove("hidden");
            option.classList.add("flex");
        } else {
            option.classList.remove("flex");
            option.classList.add("hidden")
        }
    }

        // nav responsive open and close
        const menu = document.querySelector('.menu');
        const rnav = document.getElementById('rnav');

        menu.addEventListener('click', () => {
            if (rnav.classList.contains('open')) {
                rnav.style.height = "0px";
                rnav.classList.remove('open');
            } else {
                rnav.style.height = "343px";
                rnav.classList.add('open');
            }
        })
    </script>
    <script src="https://www.chatbase.co/embed.min.js" chatbotId="gvEIQuZ1QCpui9UuF1UWX" domain="www.chatbase.co" defer>
    </script>
</body>

</html>