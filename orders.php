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
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href=".css">
  <link rel="stylesheet" href="main.css"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="output.css">
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
</script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src ="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>