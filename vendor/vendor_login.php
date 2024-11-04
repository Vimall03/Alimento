<?php 
$showError = false;
$showalert = false;
$vendorlogin = false;


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
        $sql = "select * FROM restaurant  where `p_email` = '$email'";
        $result = mysqli_query($conn, $sql);
        // mysqli_query() - $conn is used to start connection to the server and runs
        // the query $sql and the result is stored in $result
        $num = mysqli_num_rows($result);
        //mysqli_num_rows() - fetches the number of rows present in $result
          if($num==1){
            while ($row = mysqli_fetch_assoc($result)){
              //mysqli_fetch_assoc() - fetches the associated value from t$result
              // and stores it as associate array in $row
              if(password_verify($password, $row['p_password'])){
                //password_verify() - function is used to verify the the hash of the entered password 
                // by matching it with the password hash stored in the database.
                $vendorlogin= true;
                session_start();
                $_SESSION['r_id']= $row['r_id'];
                $_SESSION['vendorloggedin'] = true;
                $_SESSION['p_email'] = $email;
                $_SESSION['r_name'] = $row['r_name'];
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=ABeeZee&display=swap');
    
    </style>
    
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HomeMade • Login</title>
    <link rel="icon" type="image/png" href="css/favicon.png">
    <link rel="stylesheet" href="../output.css">

</head>

<body>
    <!-- Alert bootstrap -->

    <?php
  if ($vendorlogin){
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
  <strong>Error. </strong> '.$showalert.' <a href="signup.php" class="text-dark">Signup</a> to register or <a href="email_send_otp.php" class="text-dark">Verify email</a>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
';

  } ?>

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
        <div class="form flex flex-col w-1/2 max-h-[600px] h-full justify-center">
            <div class="w-96 ml-auto flex flex-col gap-8">
              <span class="flex flex-col gap-4">
                <h1 class="text-2xl font-bold">Login</h1>
              </span>

              <form action="vendor_login.php" method="post" class="flex flex-col gap-4">
                <div class="form-group flex flex-col">
                  <label for="vendorEmail" class="mb-2">Email</label>
                  <input type="email" id="vendorEmail" name="email" placeholder="Enter your email" class="p-2 form-control outline-2 border border-black w-full" required>
                </div>
                <div class="form-group flex flex-col">
                  <label for="vendorPassword" class="mb-2">Password</label>
                  <input type="password" id="vendorPassword" name="password" placeholder="Enter your password" class="p-2 form-control outline-2 border border-black w-full" required>
                </div>
                <div class="w-full my-1 flex justify-end">
                  <p class="text-center">Forgot password? <a href="email_verify.php">Reset here</a></p>
                </div>
                <button type="submit" class="px-2 py-2 mt-2 rounded-lg text-white bg-blue-500">Log In</button>
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






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script> -->
</body>

</html>