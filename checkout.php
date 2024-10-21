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




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  
  <link rel="stylesheet" href="checkout.css">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href=".css"> -->
  <!-- <link rel="stylesheet" href="main.css"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="output.css">
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
<div >
    <form action="pay.php" method="post">
<div class="container">
    <!-- Contact and Shipping Form -->
    <div class="form-section">
        <h3>Contact Information</h3>
        <!-- <label for="email">Email address</label> -->
        <input type="email" id="email" placeholder="Enter your email" required="">

        <!-- <label for="phone">Phone</label> -->
        <input type="text" id="phone" placeholder="Enter your phone number" required="">

        <div class="form-group">
            <div>
                <!-- <label for="first-name">First name</label> -->
                <input type="text" id="first-name" placeholder="First name" required="">
            </div>
            <div>
                <!-- <label for="last-name">Last name</label> -->
                <input type="text" id="last-name" placeholder="Last name" required="">
            </div>
        </div>

        <h3>Billing & Shipping</h3>
        <!-- <label for="address">House number and street name</label> -->
        <input type="text" id="address" placeholder="Enter your address" required="">

        <!-- <label for="city">Town / City</label> -->
        <input type="text" id="city" placeholder="Town / City" required="">

        <!-- <label for="state">State</label> -->
        <select id="state">
            <option value="Madhya Pradesh">Madhya Pradesh</option>
            <option value="Uttar Pradesh">Uttar Pradesh</option>
            <option value="Delhi">Delhi</option>
        </select>

        <!-- <label for="zip">ZIP Code</label> -->
        <input type="text" id="zip" placeholder="ZIP Code">

        <h3>Additional information</h3>
        <!-- <label for="notes">Notes about your order</label> -->
        <textarea id="notes" rows="4" placeholder="Special notes for delivery"></textarea>
    </div>

    <!-- Order Summary Section -->
    <div class="summary-section">
        <h3>Order Summary</h3>
        <br><br>
        <?php  foreach ($order as $item) {
                  ?> 
        <div class="item">
            <div class="item-details">
                <h5><strong><?php echo $item; ?></strong></h5>
                
            </div>
            <!-- <div class="item-price">$9.48</div> -->
        </div>
  <?php } ?>
        

        <!-- <h3>Shipping</h3>
        <label><input type="radio" name="shipping" checked> Local pickup</label><br>
        <label><input type="radio" name="shipping"> Local Delivery: $2.99</label>

        <label for="pickup-date">Pickup Date</label>
        <select id="pickup-date">
            <option>As soon as possible</option>
            <option>Tomorrow</option>
            <option>Later this week</option>
        </select>

        <h3>Tip Amount</h3>
        <div class="tip-options">
            <button class="tip-btn">15%</button>
            <button class="tip-btn">18%</button>
            <button class="tip-btn">22%</button>
            <button class="tip-btn active">No Tip</button>
            <button class="tip-btn">Custom Tip</button>
        </div> -->

        <div class="total">
            <div>Subtotal</div>
            <div><?php echo $amount; ?></div>
        </div>

        <div class="total">
            <div>Shipping</div>
            <div>Free</div>
        </div>

        <div class="total">
            <div>Tax</div>
            <div>$1.16</div>
        </div>

        <div class="total">
            <div>Total</div>
            <div>$15.63</div>
        </div>

        <button style="width:100%;height:30px;background-color:#e64a19;color:white;border:none;border-radius:3px;margin-top:12px">Order Place</button>
    </div>

</div>
</form>
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
</body>
</html>

