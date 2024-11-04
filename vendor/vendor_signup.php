<?php

use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\SMTP; // Removed unused import
use PHPMailer\PHPMailer\Exception;

include 'partials/_dbconnect.php';
// Assuming the form has been submitted and the data is available in $_POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $restaurantName = $_POST["restaurant_name"];
    $restaurantCuisine = $_POST["restaurant_cuisine"];
    $restaurantAbout = mysqli_real_escape_string($conn, $_POST["restaurant_about"]);
    $restaurantPin = $_POST['restaurant_pin'];


$uploadCv = 'restaurant/cover/';
$uploadCover = $uploadCv . basename($_FILES["restaurant_bg_img"]['name']);

$uploadPr = 'restaurant/';
$uploadProfile = $uploadPr . basename($_FILES["vendor_image"]['name']);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $existSql = "SELECT * FROM `restaurant` WHERE `p_email` = '$email' ";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);

        if ($numExistRows > 0) {
            $showError = "Email already registered. Try logging in.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);

            $otp = random_int(10000000, 99999999);
            $hashotp = password_hash($otp, PASSWORD_DEFAULT);

            if ((move_uploaded_file($_FILES['vendor_image']['tmp_name'], $uploadProfile)) && (move_uploaded_file($_FILES['restaurant_bg_img']['tmp_name'], $uploadCover))) {
            $sql = "INSERT INTO `restaurant` (`p_name`, `p_email`, `p_about`, `p_password`, `r_bg`, `p_phone`, `p_image`, `r_name`, `r_cuisine`, `reset_code`, `account_status`, `r_pincode`) 
                    VALUES ('$name', '$email', '$restaurantAbout', '$hash', '$uploadCover', '$phone', '$uploadProfile', '$restaurantName', '$restaurantCuisine', '$hashotp', 'Not-Verified', '$restaurantPin')";
            $result = mysqli_query($conn, $sql);
            echo "Upload Profile Path: " . $uploadProfile . "<br>";
            echo "Upload Cover Path: " . $uploadCover . "<br>";
        }
            // PHP mailer
            require 'phpmailer/Exception.php';
            require 'phpmailer/PHPMailer.php';
            require 'phpmailer/SMTP.php';


            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'aftereditofficial@gmail.com';                     //SMTP username
                $mail->Password   = 'asnfswjtqvsqpngu';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('from@example.com', 'ETIFFY');
                $mail->addAddress($email);     //Add a recipient
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Verification code from homemade';
                $mail->Body    = '<h1>' . $email . ' </h1><br><h1>' . $otp . ' </h1>';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo 'Message has been sent';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }


            //PHP mailer
            session_start();
            $_SESSION['email'] = $email;
            header("location: email_verify.php");
    
        
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>etiffy - Vendor Sign Up</title>
  <link rel="stylesheet" href="../output.css">
</head>
<body>
  <div class="w-full max-w-screen-lg mx-auto" style="max-width: 1024px;">
    <div class="w-full justify-end flex gap-4 py-8">
      <a href="vendor_login.php" class="hover:text-blue-600">Sign In</a>
      <a href="vendor_signup.php" class="hover:text-blue-600">Register</a>
    </div>

    <div class="w-full h-[80vh] py-8 flex">
        <div class="flex flex-col w-1/2 max-h-[600px] h-full justify-center">
            <span class="flex flex-col gap-4">
              <h1 class="text-5xl font-bold">Welcome to</h1>
              <h1 class="text-6xl font-bold">Alimento</h1>
            </span>
            <span class="my-8">
              <p class="text-sm">
              We are excited to offer a modern and user-friendly platform, designed to ensure you have the best experience in managing your restaurant. With this service, you can easily list your restaurant, edit menus, and view or manage orders with ease.
              </p>
            </span>
            <span class="h-56">
              <img src="../images/Frame.png" alt="" class="h-full">
            </span>
        </div>
        <div class="form flex flex-col w-1/2 max-h-[600px] h-full pl-8 justify-center">
            <div class="w-full flex flex-col gap-8">
              <span class="flex flex-col gap-4">
                <h1 class="text-2xl font-bold">Register</h1>
              </span>

              <form action="vendor_signup.php"  method="post" enctype="multipart/form-data" class="flex flex-col gap-4">
                <div class="w-full flex gap-4">
                  <div class="left w-1/2 flex flex-col gap-2">
                    
                    <div class="form-group">
                      <label for="email" class="mb-2">Email</label>
                      <input type="email" id="email" name="email" placeholder="Email" class="form-control p-2 form-control outline-2 border border-black w-full" required>
                    </div>
                    <div class="form-group">
                      <label for="password" class="mb-2">Password</label>
                      <input type="password" id="password" placeholder="Password" name="password" class="form-control p-2 form-control outline-2 border border-black w-full" required>
                    </div>
                    <div class="form-group"> 
                      <label for="restaurant_name" class="mb-2">Restraunt Name</label>
                      <input type="text" id="restaurant_name" placeholder="Restraunt Name" name="restaurant_name" class="form-control p-2 form-control outline-2 border border-black w-full" required>
                    </div>
                    <div class="form-group">
                      <label for="restaurant_bg_img" class="mb-2">Restraunt BG Image</label>
                      <input type="file" id="restaurant_bg_img" placeholder="Restraunt Background" name="restaurant_bg_img" class="form-control p-2 form-control outline-2 border w-full border-black" accept="image/*" required>
                    </div>
                    <div class="form-group">
                      <label for="restaurant_about" class="mb-2">Restaurant About</label>
                      <input id="restaurant_about" placeholder="About" name="restaurant_about" rows="4" class="form-control p-2 form-control outline-2 border border-black w-full" required></input>
                    </div>
                  </div>
                  <div class="right w-1/2 flex flex-col gap-2">
                    <div class="form-group">
                      <label for="name" class="mb-2">Vendor Name</label>
                      <input type="text" id="name" name="name" placeholder="Vendor Name" class="form-control p-2 form-control outline-2 border border-black w-full" required>
                    </div>
                    <div class="form-group">
                    <label for="phone" class="mb-2">Phone</label>
                      <input type="tel" id="phone" name="phone" placeholder="Phone no." class="form-control p-2 form-control outline-2 border border-black w-full" required>
                    </div>
                    <div class="form-group">
                      <label for="restaurant_cuisine" class="mb-2">Restaurant Cuisine</label>
                      <input type="text" id="restaurant_cuisine" placeholder="Restaurant Cuisine" name="restaurant_cuisine" class="form-control p-2 form-control outline-2 border border-black w-full" required>
                    </div>
                    <div class="form-group">
                      <label for="vendor_image" class="mb-2">Vendor Image</label>
                      <input type="file" id="vendor_image" placeholder="Vendor Image" name="vendor_image" class="form-control p-2 form-control outline-2 border border-black w-full"  accept="image/*" required>
                    </div>
                    <div class="form-group">
                      <label for="restaurant_pin" class="mb-2">Restaurant Pin code</label>
                      <input type="text" id="restaurant_pin" placeholder="Restaurant Pin code" name="restaurant_pin" class="form-control p-2 form-control outline-2 border border-black w-full" required>
                    </div>
                  </div>
                </div>
                <button type="submit" class="px-2 py-2 mt-2 rounded-lg text-white bg-blue-500">Register</button>
            </form>
            </div>
        </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
