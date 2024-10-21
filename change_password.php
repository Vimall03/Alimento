<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $query = "SELECT * FROM `users` WHERE `user_id` = '".$_SESSION['user_id']."'";
    $result = mysqli_query($conn, $query);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($old_password, $row['password'])) {
            if ($new_password == $confirm_password) {
                $hash = password_hash($new_password, PASSWORD_DEFAULT);
                $query = "UPDATE `users` SET `password` = '$hash' WHERE `user_id` = '".$_SESSION['user_id']."'";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    echo '<script>alert("Password changed successfully!")</script>';
                } else {
                    echo '<script>alert("Failed to change password!")</script>';
                }
            } else {
                echo '<script>alert("New password and confirm password do not match!")</script>';
            }
        } else {
            echo '<script>alert("Old password is incorrect!")</script>';
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Change Password</title>
  <!-- <link rel="stylesheet" href="output.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href=".css">
  <link rel="stylesheet" href="main.css"> -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="output.css">
</head>
<body>
<style>
  .change-password-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f7f7f7;
  }

  .change-password-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    width: 500px;
  }

  .change-password-card h2 {
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
  }

  .change-password-form {
    margin-top: 20px;
  }

  .change-password-form label {
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
  }

  .change-password-form input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
  }

  .change-password-form button {
    width: 100%;
    padding: 10px;
    background-color: #333;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  .change-password-form button:hover {
    background-color: #555;
  }

</style>

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
<div class="change-password-container">
  <div class="change-password-card">
    <h2>Change Password</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="change-password-form">
      <label for="old_password">Old Password:</label>
      <input type="password" class="form-control" id="old_password" name="old_password" required>
      <label for="new_password">New Password:</label>
      <input type="password" class="form-control" id="new_password" name="new_password" required>
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
      <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
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