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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href=".css">
  <link rel="stylesheet" href="main.css">
</head>
<body>
<nav class="nav" style="topo:0">
      <div class="nav__wrapper grid">
          <div class="grid__span2 nav__logo-wrap">
              <a href="home.php">
                  <img class="nav__logo-img" src="images/logo/Logo.png">                
              </a>
          </div>
          <div class="grid__span10 nav__links-wrap">
              <ul class="nav__links">

                  <li class="nav__link">
                      <a href="new_track_order.php">
                          <img class="nav__link-icon" style="width: 1.8rem" src="images/favicons/tableware_50px.png">
                          <span class="nav__link-item">Orders</span> 
                      </a>
                  </li>
                  <li class="nav__link">
                      <a href="#contact">
                          <img class="nav__link-icon" src="images/favicons/phone_32px.png">
                          <span class="nav__link-item">Contact </span>
                      </a>
                  </li>
                  <li class="nav__link">
                      <a href="user_logout.php">
                          <img class="nav__link-icon" style="width: 1.9rem" src="images/favicons/user_male_circle_32px.png">
                          <span class="nav__link-item">Logout</span> 
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

