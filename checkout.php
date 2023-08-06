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
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <header class="bg-primary text-white text-center py-4">
    <h1>Checkout</h1>
  </header>
  
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
            <p>Total: <span class="badge badge-success">Rs. <?php echo $amount; ?></span></p>
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

  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2023 Checkout</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

