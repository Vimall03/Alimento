<?php
session_start();
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $email = $_SESSION['email'];
    $password = $_POST["password"];
    //to check if the password/ email is blank
    if ($password == '') {
        $showError = "Enter valid Email/password";
    }
    //if not blank then go to else
    else {
        $sql = "SELECT * FROM `users` WHERE email = '$email' ";
        $result = mysqli_query($conn, $sql);
        // mysqli_query() - $conn is used to start connection to the server and runs
        // the query $sql and the result is stored in $result
        $num = mysqli_num_rows($result);
        //mysqli_num_rows() - fetches the number of rows present in $result
        if ($num == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                //mysqli_fetch_assoc() - fetches the associated value from t$result
                // and stores it as associate array in $row
                if (password_verify($password, $row['resetcode'])) {
                    //password_verify() - function is used to verify the the hash of the entered password
                    // by matching it with the password hash stored in the database.
                    $sql = "UPDATE `users`
        SET `account_status` = 'Verified' , `resetcode` = '0'
        WHERE `email` = '$email';";
                    $result = mysqli_query($conn, $sql);
                    $_SESSION['loggedin'] = true;
                    header("location: user_login.php");
                } else {
                    $showError = "Invalid OTP";
                }
            }
        } else {
            $showError = "Email not registered. Click on sign up to register";
        }
    }
}
?>

<!-- source html code -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification - etiffy</title>
    <link rel="stylesheet" href="./output.css">
</head>

<body>
<div class="gtranslate_wrapper"></div>
      <script>window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper"}</script>
      <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>

    <!-- Alert bootstrap -->

    <?php
if ($login) {
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert"> 
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </svg>
    <strong>Congratulations!</strong> Login success.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
';
}
if ($showError) {
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg>
    <strong>Error. </strong> ' . $showError . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
';
} ?>



<body>
 

    <div class="w-full max-w-screen-lg mx-auto" style="max-width: 1024px;">
    <nav
      class="hidden  lg:flex sm:max-w-xl md:max-w-2xl lg:max-w-5xl xl:max-w-7xl w-full items-center justify-between max-w-7xl mx-auto font-poppins py-4">
      <a href="index.php"><img src="./images/logo/logo.webp" alt="logo" class="w-36"></a>

      <div class="flex">

        <div class="mx-3">
          <a href="user_login.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Login</a>
          <a href="user_signup.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Register</a>
        </div>

    </nav>

      <div class="w-full h-[80vh] py-8 flex">
          <div class="flex flex-col w-1/2 max-h-[600px] h-full justify-center">
              <span class="flex flex-col gap-4">
                <h1 class="text-5xl font-bold">Verify your email id</h1>
              </span>
              <span class="my-8">
                <p class="text-sm">
                Please enter the 8-digit code sent to your email to complete the verification process. If you haven't received the code, check your spam folder or request a new one.
                </p>
              </span>
              <span class="h-56">
                <img src="./images/Frame.png" alt="" class="h-full">
              </span>
          </div>
          <div class="form flex flex-col w-1/2 max-h-[600px] h-full justify-center">
              <div class="w-96 ml-auto flex flex-col gap-8">
                <span class="flex flex-col gap-4">
                  <h1 class="text-2xl font-bold">Enter the 8 digit code</h1>
                </span>

                <form action="email_verify.php" method="post" class="flex flex-col gap-4">
                  <div class="form-group flex flex-col">
                    <input type="password" id="password" name="password" placeholder="OTP" class="p-2 form-control outline-2 border border-black w-full" required>
                  </div>
                  <button type="submit" class="px-2 py-2 mt-2 rounded-lg text-white bg-blue-500">submit</button>
              </form>
              </div>
          </div>
      </div>
    </div>
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
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
