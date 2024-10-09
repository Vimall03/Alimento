<?php
session_start();
//connect to database
include 'partials/_dbconnect.php';


$order=$_SESSION['Order'];
$amount=$_SESSION['amount'];
$userId= $_SESSION['user_id'];


$oid = mt_rand(10000, 99999);
$_SESSION['orderid'] = str_pad($oid, 5, '0', STR_PAD_LEFT);




?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href=".css">
  <link rel="stylesheet" href="main.css">
</head>
<body>
<nav class="nav">
      <div class="nav__wrapper grid">
          <div class="grid__span2 nav__logo-wrap">
              <a href="home.php">
                  <img class="nav__logo-img" src="images/logo/Logo.png">                
              </a>
          </div>
          <div class="grid__span10 nav__links-wrap">
              <ul class="nav__links">

                  <li class="nav__link">
                      <a href="track_order.php">
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
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-6">
        <h2>Shipping Details</h2>
        <form action="pay.php" method="post">
          <div class="form-group">
            <label for="phone">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
          </div>
          <div class="form-group">
            <label for="address1">Address Line 1</label>
            <input type="text" class="form-control" id="address1" name="address1" required>
          </div>
          <div class="form-group">
            <label for="address2">Address Line 2</label>
            <input type="text" class="form-control" id="address2" name="address2">
          </div>
          <div class="form-group">
            <label for="pincode">Pincode</label>
            <input type="text" class="form-control" id="pincode" name="address3" required>
          </div>
        
      </div>
      
      <div class="col-md-6">
        <h2>Order Summary</h2>
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Order ID: <?php echo $oid; ?></h5>
            <ul class="list-group mb-3">
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <?php  foreach ($order as $item) {
                echo $item;    
                echo '<span class="badge badge-primary badge-pill"></span><br>';} ?>
              </li>
            </ul>
            <p>Total: <b >Rs. <?php echo $amount; ?></b></p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row mt-5">
      <div class="col-md-12">
        <button class="btn btn-primary btn-lg float-right">Place Order</button>
        </form>
      </div>
    </div>
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

