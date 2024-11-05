<?php
$login = false;
$showError = false;
$showalert = false;
$login_status = false;

session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $login_status = true;

  header("location: home.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/_dbconnect.php';
  $email = $_POST["email"];
  $password = $_POST["password"];

  if ($email == '' || $password == '') {
    $showError = "Enter valid Email/password";
  } else {
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);

    if ($num == 1) {
      while ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
          $login = true;
          session_start();
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['loggedin'] = true;
          $_SESSION['email'] = $email;
          $_SESSION['name'] = $row['name'];
          header("location: home.php");
        } else {
          $showError = "Try again. Invalid password.";
        }
      }
    } else {
      $showalert = "Email not registered / not verified.";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HomeMade • Login</title>
  <link rel="icon" type="image/png" href="css/favicon.png">
  <link rel="stylesheet" href="./output.css">
</head>

<body>
  <div class="gtranslate_wrapper"></div>
  <script>
    window.gtranslateSettings = {
      "default_language": "en",
      "detect_browser_language": true,
      "wrapper_selector": ".gtranslate_wrapper"
    }
  </script>
  <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

  <?php
  if ($login) {
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert"> 
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </svg>
    <strong>Congratulations!</strong> Login success.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  if ($showError) {
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
    <strong>Error. </strong> ' . $showError . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }

  if ($showalert) {
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
<path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
  <strong>Error. </strong> ' . $showalert . ' <a href="user_signup.php" class="text-dark">Signup</a> to register or <a href="email_send_otp.php" class="text-dark">Verify email</a>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
  } ?>

  <div class="w-full max-w-screen-lg mx-auto">
    <nav class="hidden lg:flex sm:max-w-xl md:max-w-2xl lg:max-w-5xl xl:max-w-7xl w-full items-center justify-between max-w-7xl mx-auto font-poppins py-4">
      <a href="index.php"><img src="./images/logo/logo.webp" alt="logo" class="w-36"></a>
      <div class="flex">
        <div class="mx-3">
          <a href="user_signup.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Register</a>
        </div>
    </nav>

    <div class="w-full h-[80vh] py-8 flex">
      <div class="flex flex-col w-1/2 max-h-[600px] h-full justify-center">
        <span class="h-64">
          <img src="./images/login.png" alt="" class="h-full">
        </span>
      </div>
      <div class="form flex flex-col w-1/2 max-h-[600px] h-full justify-center">
        <div class="w-96 ml-auto flex flex-col gap-8">
          <span class="flex flex-col gap-4">
            <h1 class="text-3xl font-bold">Welcome Back,</h1>
          </span>

          <form action="user_login.php" method="post" class="flex flex-col gap-4">
            <div class="form-group flex flex-col">
              <label for="email" class="mb-2">Email</label>
              <input type="email" id="email" name="email" placeholder="example@example.com" class="p-2 form-control outline-2 border border-black w-full" required>
            </div>
            <div class="form-group flex flex-col">
              <label for="password" class="mb-2">Password</label>
              <input type="password" name="password" id="password" placeholder="Enter your password" class="p-2 form-control outline-2 border border-black w-full" required>
            </div>
            <div class="w-full my-1 flex justify-end">
              <p class="text-center">Forgot password? <a href="email_verify.php">Reset here</a></p>
            </div>
            <button class="w-full bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer transition-all ease-in-out duration-75 text-white rounded-md p-2" type="submit">Log In</button>
          </form>

          <!-- Login with Google button -->
          <div class="w-full flex flex-col items-center mt-2">
            <a href="https://accounts.google.com/v3/signin/identifier?authuser=0&continue=https%3A%2F%2Fmyaccount.google.com%2F&ec=GAlAwAE&hl=en_GB&service=accountsettings&flowName=GlifWebSignIn&flowEntry=AddSession&dsh=S1527110508%3A1729760212648495&ddm=0"
               class="flex items-center justify-center w-full p-2 mt-2 border border-gray-300 rounded-md hover:bg-gray-200 transition-colors">
              <img src="./images/google_icon.png" alt="Google Icon" class="w-5 h-5 mr-2">
              <span>Login with Google</span>
            </a>
          </div>

          <p class="text-center">Don't have an account? <a href="user_signup.php">Create account</a></p>
        </div>
      </div>
    </div>
  </div>
</body>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script>
    const eyeBtnPassword = document.getElementById("eye-btn-p");
    const eyeBtnConfirmPassword = document.getElementById("eye-btn-cp");
    const passwordField = document.getElementById("password");
    const confirmPasswordField = document.getElementById("cpassword");

    eyeBtnPassword.addEventListener('click', () => {
      let attr = passwordField.getAttribute('type')
      if (attr == "password") {
        passwordField.setAttribute('type', 'text');
        eyeBtnPassword.classList.remove("bi-eye-fill")
        eyeBtnPassword.classList.add("bi-eye-slash-fill")
      } else {
        passwordField.setAttribute('type', 'password');
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