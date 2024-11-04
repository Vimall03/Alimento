<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: user_login.php");
  exit;
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $login_status = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restaurant Finder</title>
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> -->

  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <!-- Bootstrap icons  -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"> -->
  <!-- <link rel="stylesheet" href="main.css"> -->
  <link rel="stylesheet" href="output.css">
  <!-- <link rel="stylesheet" href="home.css"> -->
</head>

<body class="m-0 p-0 box-border">
  <div class="gtranslate_wrapper"></div>
  <script>window.gtranslateSettings = { "default_language": "en", "detect_browser_language": true, "wrapper_selector": ".gtranslate_wrapper" }</script>
  <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

  <nav
    class="hidden  lg:flex sm:max-w-xl md:max-w-2xl lg:max-w-5xl xl:max-w-7xl w-full items-center justify-between max-w-7xl mx-auto font-poppins py-4">
    <a href="index.php"><img src="./images/logo/logo.webp" alt="logo" class="w-36"></a>
    <div class="flex sm:gap-1 md:gap-2">
      <a href="home.php"
        class="hover:bg-gray-200 transition-all ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4">Restaurants</a>
      <a href="new_track_order.php"
        class="hover:bg-gray-200 transition-all ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4">Orders</a>
      <a href="#"
        class="hover:bg-gray-200 transition-all ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4">Contact</a>
      <?php if ($login_status == true) {
        echo '<a href="profile.php" class="hover:bg-gray-200 transition-all ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4">Account</a>';
      } ?>
    </div>
    <div class="flex">

      <div class="mx-3">
        <?php if ($login_status == true) {
          echo '<a href="user_logout.php" class="bg-red-500 hover:bg-red-600 transition-all ease-in-out duration-75 cursor-pointer w-max px-6 py-2 text-white rounded-full">Logout</a>';
        } else {
          echo '<a href="user_login.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Login</a>';
        } ?>
      </div>

  </nav>

  <!-- nav for small device  -->
  <div class="flex items-center justify-between max-w-7xl mx-auto font-poppins bg-white py-3 px-5 lg:hidden">
    <a href="index.php"><img src="./images/logo/logo.webp" alt="logo" class="w-36 "></a>
    <i class="bi bi-list menu select-none text-3xl"></i>
  </div>
  <div class="bg-gray-200 w-full top-5 font-poppins overflow-hidden px-5 py-3 hidden lg:hidden mb-5" id="nav-items">
    <div class="flex flex-col gap-4">
      <a href="#"
        class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Restaurants</a>
      <a href="new_track_order.php"
        class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Orders</a>
      <a href="#"
        class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Contact</a>
      <?php if ($login_status == true) {
        echo '<a href="profile.php" class="hover:bg-white focus:bg-white transition-all ease-in-out duration-100 py-2 px-3 rounded-md hover:text-black">Account</a>';
      } ?>
      <div>
        <h2 class="text-base text-gray-400 mt-3">User actions</h2>
        <div class="h-[1px] bg-gray-300 w-full"></div>
      </div>
      <?php if ($login_status == true) {
        echo '<a href="user_logout.php" class="bg-red-500 hover:bg-red-600 transition-all ease-in-out duration-75 cursor-pointer w-max px-6 py-2 text-white rounded-full">Logout</a>';
      } else {
        echo '<a href="user_login.php" class="bg-gray-900 hover:bg-gray-800 focus:border-white cursor-pointer w-max transition-all ease-in-out duration-75 px-6 py-2 text-white rounded-full">Login</a>';
      }
      ?>
    </div>
  </div>



  <div id="hero-bg mt-0" class="hero-section bg-cover bg-center h-[400px] relative flex rounded-lg justify-center items-center mx-auto my-5 max-h-[400px]" style="background-image: url('images/10\ restaurants\ in\ Mumbai\ that\ offer\ the\ best\ sunset\ views.webp');">
    <div class="overlay text-white p-36 h-full text-center w-full rounded-lg items-center" style="background-color: rgba(0, 0, 0, 0.4);">
      <h1 class="text-5xl mb-[10px]"><i>Alimento</i></h1>
      <p class="text-white text-xl">Home</p>
    </div>
  </div>


  <!-- Restaurant Section -->
  <section class="restaurants p-5 text-center">
    <h2 class="text-3xl mb-5 font-bold">Restaurants:</h2>
    <div class="restaurant-cards flex-col sm:flex-row flex justify-around flex-wrap">
      <!-- Restaurant Card -->

      <?php
      include 'partials/_dbconnect.php';
      $query = "SELECT * FROM `restaurant` ORDER BY `r_rating` DESC";
      $result = mysqli_query($conn, $query);
      $num = mysqli_num_rows($result);

      if ($num >= 1) {
        while ($row = mysqli_fetch_array($result)) {
          echo '
                        <div class="card w-[80%] flex flex-col justify-between bg-white sm:w-[22%] border border-[#ddd] rounded-lg shadow-md my-5 mx-0 text-center p-4 ">
                          <div class="flex flex-col">
                            <img class="w-full rounded-t-md" src="vendor/' . $row['r_bg'] . '" alt="' . $row['r_name'] . '">
                            <div style="display:flex;">
                                       <div style="text-align:left;width:50%">
                                            <h3 class="text-lg mt-[10px]" style="font-weight:bold;margin-top:8px">' . $row['r_name'] . '</h3>
                                            <p class="cuisine text-gray-400 mb-1 text-sm">Cuisine: ' . $row['r_cuisine'] . '</p>
                                        </div>

                                        <div style="text-align:right;width:50%">
                                            <p class="discount font-bold text-[#FF4500] mt-1">30% Discount</p>
                                            <p class="rating mt-0 text-[#FFD700]">' . (empty($row['r_rating']) ? '-' : str_repeat('★', (int) $row['r_rating'])) . '</p>
                                        </div>
                            
                            </div>
                          </div>
                           <a href="menu.php?id=' . $row['r_id'] . '" class="menu-btn bg-[#FF4500] text-white border-none py-[10px] px-5 mt-[10px] rounded-md cursor-pointer text-sm hover:bg-[#e63900] hover:text-white">View Menu</a>
                        </div>

                          


                    ';

        }
      } else {
        echo '<div class="col">
                      <p class="text-xl">No restaurants found.</p>
                  </div>';
      }
      ?>



      <!-- Duplicate these cards as needed -->
      <!--             
             <div class="card">
                <img src="restaurant1.webp" alt="Restaurant 1">
                <h3>Restaurant 1</h3>
                <p class="discount">30% Discount</p>
                <p class="cuisine">Cuisine: Global Fusion Cuisine</p>
                <p class="rating">★★★★★</p>
                <button class="menu-btn">View Menu</button>
            </div> -->
    </div>
  </section>

  <script>
    window.embeddedChatbotConfig = {
      chatbotId: "gvEIQuZ1QCpui9UuF1UWX",
      domain: "www.chatbase.co"
    }
  </script>
  <script src="https://www.chatbase.co/embed.min.js" chatbotId="gvEIQuZ1QCpui9UuF1UWX" domain="www.chatbase.co" defer>
  </script>
  <script>
    const menu = document.querySelector(".menu");
    const navitems = document.getElementById("nav-items");

    menu.addEventListener("click", () => {
      navitems.classList.toggle("hidden")
    })
  </script>
</body>

</html>
</body>

</html>