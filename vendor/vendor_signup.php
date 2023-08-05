<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
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
    $restaurantAbout = $_POST["restaurant_about"];
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

            $sql = "INSERT INTO `restaurant` (`r_id`, `p_name`, `p_email`, `p_about`, `p_password`, `r_bg`, `p_phone`, `p_image`, `r_name`, `r_cuisine`, `reset_code`, `account_status`, `r_pincode`) 
                    VALUES (NULL, '$name', '$email', '$restaurantAbout', '$hash', '$uploadCover', '$phone', '$uploadProfile', '$restaurantName', '$restaurantCuisine', '$hashotp', 'Not-Verified', '$restaurantPin');";
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
                $mail->Password   = '###';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('from@example.com', 'afteredit');
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
<html>

<head>
    <title>Restaurant Registration Form</title>
</head>

<body>
    
    <h2>Restaurant Registration Form</h2>
    <form action="vendor_signup.php" method="post" enctype="multipart/form-data">
        <!-- Personal Information -->
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <!-- Restaurant Information -->
        <label for="vendor_image">Vendor Image:</label>
        <input type="file" id="vendor_image" name="vendor_image" accept="image/*" required><br>

        <label for="restaurant_name">Restaurant Name:</label>
        <input type="text" id="restaurant_name" name="restaurant_name" required><br>

        <label for="restaurant_cuisine">Restaurant Cuisine:</label>
        <input type="text" id="restaurant_cuisine" name="restaurant_cuisine" required><br>

        <label for="restaurant_bg_img">Restaurant Background Image:</label>
        <input type="file" id="restaurant_bg_img" name="restaurant_bg_img" accept="image/*" required><br>

        <label for="restaurant_about">Restaurant About:</label>
        <textarea id="restaurant_about" name="restaurant_about" rows="4" cols="50" required></textarea><br>

        <label for="restaurant_pin">Restaurant Pin code:</label>
        <input type="text" id="restaurant_pin" name="restaurant_pin" required><br>

        <input type="submit" value="Submit">
    </form>
</body>

</html>