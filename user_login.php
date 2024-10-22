<?php 
$login= false;
$showError = false;
$showalert = false;

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
  header("location: home.php");
}

if ($_SERVER["REQUEST_METHOD"]=="POST"){
  include 'partials/_dbconnect.php';
  $email = $_POST["email"];
  $password = $_POST["password"];
 
//to check if the password/ email is blank
    if($email == '' || $password == ''){
      $showError = "Enter valid Email/password";
    }
    //if not blank then go to else
    else {
        $sql = "select * FROM users  where email = '$email'";
        $result = mysqli_query($conn, $sql);
        // mysqli_query() - $conn is used to start connection to the server and runs
        // the query $sql and the result is stored in $result
        $num = mysqli_num_rows($result);
        //mysqli_num_rows() - fetches the number of rows present in $result
          if($num==1){
            while ($row = mysqli_fetch_assoc($result)){
              //mysqli_fetch_assoc() - fetches the associated value from t$result
              // and stores it as associate array in $row
              if(password_verify($password, $row['password'])){
                //password_verify() - function is used to verify the the hash of the entered password 
                // by matching it with the password hash stored in the database.
                $login = true;
                session_start();
                $_SESSION['user_id']= $row['user_id'];
                $_SESSION['loggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['name'] = $row['name'];
                header("location: home.php");
              }
              else{
                $showError = "Try again. Invalid password.";
              }
            }
          }
          else{
            $showalert = "Email not registered / not verified.";
          }
      }
    
}
?>

<!-- source html code -->
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- Google Fonts (aBeeZee) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=ABeeZee&display=swap');
    </style>
    <!-- css link -->
    <link rel="stylesheet" href="main.css">

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeMade • Login</title>
    <link rel="icon" type="image/png" href="css/favicon.png">

</head>

<body>
<div class="gtranslate_wrapper"></div>
      <script>window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper"}</script>
      <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <?php
  if ($login) {
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert"> 
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </svg>
    <strong>Congratulations!</strong> Login success.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
';}
  if ($showError) {
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
    <strong>Error. </strong> '.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
';}

if ($showalert) {
  echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
  <strong>Error. </strong> '.$showalert.' <a href="user_signup.php" class="text-dark">Signup</a> to register or <a href="email_send_otp.php" class="text-dark">Verify email</a>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';

}?>


  <section class="login-signup">
        <div class="login-signup__message-container login-signup__small">
            <div class="login-signup__logo">
                <a href="index.php">
                    <img src="images/logo/Logo - White.webp" alt="Logo">                
                </a>
            </div>

            <div class="login-signup__message-content">
                <h3 class="login-signup__message-heading u-margin-bottom-medium">Hello, Friend</h3>
                <p class="login-signup__message-para">Hey foodie! We are waiting to kill you hunger with our delicious dabbas. Create your account and enjoy out mouth watering food.</p>
                
                <br><br>

                <button class="login-signup__button u-margin-top-extra-large" style="display:block; margin: 0 auto;">
                    <a href="user_signup.php">Sign Up</a>
                </button>
            </div>
        </div>
        <div class="login-signup__form-container login-signup__big">
            <div class="login-signup__logo u-show-after-tab-port">
                <img src="images/logo/logo.webp" alt="Logo">
            </div>

            <div class="login-signup__back-button">
            <a href="index.php">
                <img src="images/favicons/back_50px-red.webp" alt="Back Button">
                Back</a>
            </div>

            <div class="login-signup__form-content">
                <h3 class="login-signup__form-heading u-margin-bottom-small">Welcome Back!</h3>
                <h5 class="login-signup__form-subheading">Glad to see you again</h5>

                <form class="login-signup-form u-margin-top-small" action="/alimento/user_login.php" method="post">
                    <div class="login-signup-form__input-group login-signup-form__input-group--full">
                        <input type="email" class="login-signup-form__input" id="email" name="email" placeholder="example@example.com">
                    </div>
                    <div class="login-signup-form__input-group">
                      <div class="login-signup-form__input" onclick="document.getElementById('password').focus()">
                          <input type="password" name="password" class="login-signup-form__inputfield" id="password" placeholder=".......">
                          <i class="bi bi-eye-fill eye-open" id="eye-btn-p"></i>
                      </div>
                    </div>                    
                    <button class="login-signup-form__submit u-margin-top-large" type="submit" id="submit-login">Sign In</button>
                </form>
            </div>

            <div class="login-signup__text-content">
                <p class="paragraph paragraph text-algin-center">Not a member yet?</p>
                <a href="user_signup.php" class="login-signup__alt-link">Sign Up</a>
                <p class="paragraph paragraph text-algin-center">  Forget Password?</p>
            </div>
        </div>
    </section>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    </script>
</body>
</html>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
