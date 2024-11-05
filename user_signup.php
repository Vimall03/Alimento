<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  header("location: home.php");
}

$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'partials/_dbconnect.php';
  $name= $_POST["name"];
  $email= $_POST["email"];

  if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  
    $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    if ($email == '' || $password == '') {
      $showError = "Enter valid Email/password";
    } elseif (!preg_match($pattern, $password)) {
      $showError = "Password must be at least 8 characters long, include at least one uppercase letter, one lowercase letter, one digit, and one special character.";
    } else {
      $existSql = "SELECT * FROM `users` WHERE email = '$email'";
      $result = mysqli_query($conn, $existSql);
      $numExistRows = mysqli_num_rows($result);

      if ($numExistRows > 0){
        $showError = "Email already registered. Try logging in.";
      } else {
        if ($password == $cpassword){
          $hash = password_hash($password, PASSWORD_DEFAULT);
          $sql = "INSERT INTO `users` (`name`, `email`, `password`, `date`, `account_status`, `resetcode`) VALUES ('$name', '$email', '$hash', current_timestamp(), 'Not Verified', '0')";
          $result = mysqli_query($conn, $sql);

          if($result){
            $otp = random_int(10000000, 99999999);
            $hashotp = password_hash($otp, PASSWORD_DEFAULT);

            $sql = "UPDATE `users` SET `resetcode` = '$hashotp' WHERE `email` = '$email'";
            $result = mysqli_query($conn, $sql);

            if($result){
              $showAlert = true;
              require 'phpmailer/Exception.php';
              require 'phpmailer/PHPMailer.php';
              require 'phpmailer/SMTP.php';

              $mail = new PHPMailer(true);

              try {
                  $mail->isSMTP();
                  $mail->Host       = 'smtp.gmail.com';
                  $mail->SMTPAuth   = true;
                  $mail->Username   = 'aftereditofficial@gmail.com';
                  $mail->Password   = 'asnfswjtqvsqpngu';
                  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                  $mail->Port       = 465;

                  $mail->setFrom('from@example.com', 'ETIFFY');
                  $mail->addAddress($email);
                  $mail->isHTML(true);
                  $mail->Subject = 'Verification code from homemade';
                  $mail->Body    = '<h1>'.$email.'</h1><br><h1>'.$otp.'</h1>';
                  $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                  $mail->send();
                  echo 'Message has been sent';
              } catch (Exception $e) {
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
              }

              session_start();
              $_SESSION['email'] = $email;
              header("location: email_verify.php");
              $showAlert = true;
            }
          } else {
            $showError = "Passwords do not match.";
          }
        }
      }
    }
  } else {
    $showError = "The email address is not valid.";
  }
}
?>

<!-- Source HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./output.css">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AfterEdit • Signup</title>
  <link rel="icon" type="image/png" href="css/favicon.png">
</head>

<body>
  <div class="gtranslate_wrapper"></div>
  <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

  <?php
  if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Congratulations!</strong> Your account has been created.
      <a href="login.php"><button class="btn btn-dark">Login</button></a>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  if ($showError) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Error.</strong> '.$showError.'
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  ?>

  <div class="w-full max-w-screen-lg mx-auto">
    <nav class="hidden lg:flex w-full items-center justify-between py-4">
      <a href="index.php"><img src="./images/logo/logo.webp" alt="logo" class="w-36"></a>
      <div class="flex">
        <div class="mx-3">
          <a href="user_login.php" class="bg-gray-900 hover:bg-gray-800 text-white rounded-full px-6 py-2">Login</a>
        </div>
    </nav>

    <div class="w-full h-[80vh] py-8 flex">
      <div class="flex flex-col w-1/2 max-h-[600px] h-full justify-center">
        <img src="./images/signup.png" alt="" class="h-full">
      </div>
      <div class="form flex flex-col w-1/2 max-h-[600px] h-full justify-center">
        <div class="w-96 ml-auto flex flex-col gap-8">
          <h1 class="text-3xl font-bold">Hello, Good to see you</h1>

          <form action="user_signup.php" method="post" class="flex flex-col gap-4">
            <div class="form-group">
              <label for="name" class="mb-2">Name</label>
              <input type="text" id="name" name="name" placeholder="Enter your name" class="p-2 border border-black" required>
            </div>
            <div class="form-group">
              <label for="email" class="mb-2">Email</label>
              <input type="email" id="email-id" name="email" placeholder="example@example.com" class="p-2 border border-black" required>
            </div>
            <div class="form-group">
              <label for="password" class="mb-2">Password</label>
              <input type="password" name="password" id="password" placeholder="Enter your password" class="p-2 border border-black" required>
            </div>
            <div class="form-group">
              <label for="cpassword" class="mb-2">Confirm Password</label>
              <input type="password" name="cpassword" id="cpassword" placeholder="Confirm your password" class="p-2 border border-black" required>
            </div>
            <button type="submit" class="px-2 py-2 mt-2 rounded-lg text-white bg-blue-500">Create Account</button>
          </form>

          <!-- Google Sign-In Button -->
          <div class="w-full flex flex-col items-center mt-4">
            <a href="https://accounts.google.com/v3/signin/identifier?authuser=0&continue=https%3A%2F%2Fmyaccount.google.com%2F&ec=GAlAwAE&hl=en_GB&service=accountsettings&flowName=GlifWebSignIn&flowEntry=AddSession&dsh=S1527110508%3A1729760212648495&ddm=0"
               class="flex items-center justify-center w-full p-2 border border-gray-300 rounded-md hover:bg-gray-200 transition-colors">
              <img src="./images/google_icon.png" alt="Google Icon" class="w-5 h-5 mr-2">
              <span>Sign up with Google</span>
            </a>
          </div>

          <p class="text-center mt-4">Already have an account? <a href="user_login.php" class="text-blue-500">Log In</a></p>
        </div>
      </div>
    </div>
  </div>
</body>

    <script>
      const eyeBtnPassword =document.getElementById("eye-btn-p");
      const eyeBtnConfirmPassword =document.getElementById("eye-btn-cp");
      const passwordField =document.getElementById("password");
      const confirmPasswordField =document.getElementById("cpassword");

      eyeBtnPassword.addEventListener('click', ()=>{
        let attr =passwordField.getAttribute('type')
        if(attr == "password"){
          passwordField.setAttribute('type','text');
          eyeBtnPassword.classList.remove("bi-eye-fill")
          eyeBtnPassword.classList.add("bi-eye-slash-fill")
        }else{
          passwordField.setAttribute('type','password');
          eyeBtnPassword.classList.add("bi-eye-fill")
          eyeBtnPassword.classList.remove("bi-eye-slash-fill")
        }
      })

      eyeBtnConfirmPassword.addEventListener('click', ()=>{
        let attr =confirmPasswordField.getAttribute('type')
        if(attr == "password"){
          confirmPasswordField.setAttribute('type','text');
          eyeBtnConfirmPassword.classList.remove("bi-eye-fill")
          eyeBtnConfirmPassword.classList.add("bi-eye-slash-fill")
        }else{
          confirmPasswordField.setAttribute('type','password');
          eyeBtnConfirmPassword.classList.add("bi-eye-fill")
          eyeBtnConfirmPassword.classList.remove("bi-eye-slash-fill")
        }
      })
    </script>
  
</body>

</html>