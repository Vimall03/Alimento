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
  <title>Restaurant Finder</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="styles.css">
</head>

<body>
<header class="bg-primary text-white text-center py-4">
    <h1>Restaurant Finder</h1>
  </header>
  
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8">
        <form action="pin_search.php" method="post">
        <input type="text" class="form-control " id="searchBar" name="pincode" placeholder="Search by Pincode" required>
        <input type="submit" class="form-control col-md-4" value="Search">
        </form>
      </div>
      <div class="col-md-4">
        <a href="/homemade/user_logout.php"><button class="btn btn-danger float-right ml-2">Logout</button></a>
        <a href="track_order.php"><button class="btn btn-success float-right ml-2">Track Orders</button></a>
      </div>
    </div>

    <br>


            <h5 class="card-title">Top Restaurants</h5>
            <div>
                <?php
                include 'partials/_dbconnect.php';
                $query = "SELECT * FROM `restaurant` ORDER BY `r_rating` DESC";
                $result = mysqli_query($conn, $query);
                $num = mysqli_num_rows($result);
                if($num>=1){
                while ($row = mysqli_fetch_array($result)) {
                    echo'<div class="row">
                    <div class="col-md-4 mb-4">
                      <div class="card">
                        <img src="' . $row['r_bg'] . '" class="card-img-top" alt="' . $row['r_name'] . '">
                        <div class="card-body">
                          <h5 class="card-title">' . $row['r_name'] . '</h5>
                          <p class="card-text">Cuisine: ' . $row['r_cuisine'] . '</p>
                          <p class="card-text">Rating: ' . $row['r_rating'] . '</p>
                          <a href="menu.php?id=' . $row['r_id'] . '" class="btn btn-primary btn-block">View Menu</a>
                        </div>
                      </div>
                    </div>';
                }}

                ?>
            </div>


</body>

</html>