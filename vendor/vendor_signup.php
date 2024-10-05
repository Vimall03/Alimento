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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="vendor_styles.css">
</head>
<body>
  <header class="bg-dark text-white text-center py-4">
    <h1>etiffy</h1>
  </header>
  
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-dark text-white">
            <h4>Vendor Sign Up</h4>
          </div>
          <div class="card-body">
            <form action="vendor_signup.php" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="vendor_image">Vendor Image</label>
                <input type="file" id="vendor_image" name="vendor_image" class="form-control" accept="image/*" required>
              </div>
              <div class="form-group">
                <label for="restaurant_name">Restaurant Name</label>
                <input type="text" id="restaurant_name" name="restaurant_name" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="restaurant_cuisine">Restaurant Cuisine</label>
                <input type="text" id="restaurant_cuisine" name="restaurant_cuisine" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="restaurant_bg_img">Restaurant Background Image</label>
                <input type="file" id="restaurant_bg_img" name="restaurant_bg_img" class="form-control" accept="image/*" required>
              </div>
              <div class="form-group">
                <label for="restaurant_about">Restaurant About</label>
                <textarea id="restaurant_about" name="restaurant_about" rows="4" class="form-control" required></textarea>
              </div>
              <div class="form-group">
                <label for="restaurant_pin">Restaurant Pin code</label>
                <input type="text" id="restaurant_pin" name="restaurant_pin" class="form-control" required>
              </div>
              <button type="submit" class="btn btn-dark btn-block">Sign Up</button>
            </form>
            <p class="mt-3 text-center">Already have an account? <a href="vendor_login.php">Log In</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2023 etiffy - Homemade Food Delivery</p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
