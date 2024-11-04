<?php
session_start();
//connect to database
include 'partials/_dbconnect.php';

$order=$_SESSION['Order'];
$amount=$_SESSION['amount'];
$userId= $_SESSION['user_id'];
$rid = $_SESSION['rest_id'];

$oid = mt_rand(10000, 99999);
$_SESSION['orderid'] = str_pad($oid, 5, '0', STR_PAD_LEFT);

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    $login_status = true;
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  
  <!-- <link rel="stylesheet" href="checkout.css"> -->
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />

  <link rel="stylesheet" href="output.css">
</head>
<body class="font-serif">
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

<div >
    <form action="pay.php" method="post">
<div class="flex flex-col md:flex-row justify-between items-center md:items-start flex-wrap gap-5 mt-12 p-4 md:p-2">
    <!-- Contact and Shipping Form -->
    <div class="form-section bg-white p-5 rounded-lg w-full md:w-[48%] shadow-sm min-w-[300px]">
        <h3 class="mt-4 font-bold text-xl">Contact Information</h3>
        <!-- <label for="email">Email address</label> -->
        <input class="w-full p-2 mb-1 border border-[#ccc] rounded-md mt-3 outline-none text-sm" type="email" id="email" placeholder="Enter your email" required="">

        <!-- <label for="phone">Phone</label> -->
        <input class="w-full p-2 mb-1 border border-[#ccc] rounded-md mt-3 outline-none text-sm" type="text" id="phone" placeholder="Enter your phone number" required="">

        <div class="flex gap-[10px]">
            <div class="flex-1">
                <!-- <label for="first-name">First name</label> -->
                <input class="w-full p-2 mb-1 border border-[#ccc] rounded-md mt-3 outline-none text-sm" type="text" id="first-name" placeholder="First name" required="">
            </div>
            <div class="flex-1">
                <!-- <label for="last-name">Last name</label> -->
                <input class="w-full p-2 mb-1 border border-[#ccc] rounded-md mt-3 outline-none text-sm" type="text" id="last-name" placeholder="Last name" required="">
            </div>
        </div>

        <h3 class="mt-4 font-bold text-xl">Billing & Shipping</h3>
        <!-- <label for="address">House number and street name</label> -->
        <input class="w-full p-2 mb-1 border border-[#ccc] rounded-md mt-3 outline-none text-sm" type="text" id="address" placeholder="Enter your address" required="">

        <!-- <label for="city">Town / City</label> -->
        <input class="w-full p-2 mb-1 border border-[#ccc] rounded-md mt-3 outline-none text-sm" type="text" id="city" placeholder="Town / City" required="">

        <!-- <label for="state">State</label> -->
        <select class="w-full p-2 mb-1 border border-[#ccc] rounded-md mt-3 outline-none text-sm" id="state">
            <option value="Madhya Pradesh">Madhya Pradesh</option>
            <option value="Uttar Pradesh">Uttar Pradesh</option>
            <option value="Delhi">Delhi</option>
        </select>

        <!-- <label for="zip">ZIP Code</label> -->
        <input class="w-full p-2 mb-1 border border-[#ccc] rounded-md mt-3 outline-none text-sm" type="text" id="zip" placeholder="ZIP Code">

        <h3 class="mt-4 font-bold text-xl">Additional information</h3>
        <!-- <label for="notes">Notes about your order</label> -->
        <textarea  class="w-full p-2 mb-1 border border-[#ccc] rounded-md mt-3 outline-none text-sm resize-none" id="notes" rows="4" placeholder="Special notes for delivery"></textarea>
    </div>

    <!-- Order Summary Section -->
    <div class="summary-section bg-slate-400 p-5 rounded-lg w-full md:w-[48%] shadow-sm min-w-[300px] ">
        <h3 class="my-4 font-bold text-xl">Order Summary</h3>
        <br><br>
        <?php  foreach ($order as $item) {
                  ?> 
        <div class="item flex justify-between mb-[10px]">
            <div class="item-details flex-1 ml-[10px]">
                <h5><strong><?php echo $item; ?></strong></h5>
                
            </div>
            <!-- <div class="item-price">$9.48</div> -->
        </div>
  <?php } ?>
        


        <div class="total mt-5 flex justify-between font-bold">
            <div>Subtotal</div>
            <div><?php echo $amount; ?></div>
        </div>

        <div class="total mt-5 flex justify-between font-bold">
            <div>Shipping</div>
            <div>Free</div>
        </div>

        <div class="total mt-5 flex justify-between font-bold">
            <div>Tax</div>
            <div>$1.16</div>
        </div>

        <div class="total mt-5 flex justify-between font-bold">
            <div>Total</div>
            <div>$15.63</div>
        </div>

        <button style="width:100%;height:30px;background-color:#e64a19;color:white;border:none;border-radius:3px;margin-top:12px">Order Place</button>
    </div>

</div>
</form>
</div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
window.embeddedChatbotConfig = {
chatbotId: "gvEIQuZ1QCpui9UuF1UWX",
domain: "www.chatbase.co"
}
</script>
<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="gvEIQuZ1QCpui9UuF1UWX"
domain="www.chatbase.co"
defer>
</script>
<script>
    const menu = document.querySelector(".menu");
    const navitems = document.getElementById("nav-items");

    menu.addEventListener("click", () => {
      navitems.classList.toggle("hidden")
    })
  </script>
</body>
</html>

