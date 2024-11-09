<?php
session_start();
$login_status = false;

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $login_status = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Alimento</title>
  <link href="./output.css" rel="stylesheet">

  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <!-- Bootstrap icons  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
  <!-- navbar  -->
  <nav
    class="hidden lg:flex sm:max-w-xl md:max-w-2xl lg:max-w-5xl xl:max-w-7xl w-full items-center justify-between max-w-7xl mx-auto font-poppins py-4">
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
      <a href="contributor/contributor.html">our contributor</a>
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

  <!-- Hero section  -->
  <div
    class="mx-5 bg-[#E6E8DD] p-3 rounded-3xl font-poppins flex flex-wrap-reverse md:flex-nowrap md:py-10 lg:max-w-5xl lg:mx-auto lg:gap-10 lg:justify-around xl:max-w-7xl xl:mx-auto">
    <!-- left  -->
    <div class="mt-14 px-5 md:w-2/3 lg:w-1/2 xl:mt-20 xl:pt-10 xl:w-1/2">
      <div class="mb-4">
        <h1 class="font-bold text-3xl text-gray-800 sm:text-4xl lg:text-5xl lg:leading-tight">Discover the best
          food at your place</h1>
        <p class="text-[#919388] mt-4 text-base font-medium lg:text-lg">Craving something delicious? Explore the
          best food
          around you, from local favorites to hidden gemsall
          just a tap away!</p>
      </div>
      <!-- Search and buttons -->
      <div class="mt-10">
        <form action="pin_search.php" method="post"
          class="flex px-4 md:px-5 py-3 bg-white w-full rounded-lg md:rounded-full lg:px-6 lg:py-4">
          <input type="number" placeholder="Search by pincode" name="pincode"
            class="w-full focus:border-none focus:outline-none text-gray-700 lg:text-lg" required>
          <button type="submit"><i class="bi bi-crosshair select-none text-xl text-gray-700 lg:text-2xl"></i></button>
        </form>
        <!-- buttons  -->
        <div class="flex justify-between w-full mt-4 items-center mb-4">
          <a href="home.php"
            class="bg-[#6E725E] w-full text-[#FDFFF5] py-3 rounded-lg border border-[#585b4d] md:rounded-full hover:bg-[#585b4d] lg:px-6 lg:py-4 lg:text-lg"><button
              class="w-full">Delivery</button></a>
          <p class="mx-3 lg:text-lg">Or</p>
          <a href="home.php"
            class="bg-[#FDFFF5] w-full py-3 rounded-lg md:rounded-full border border-[#585b4d]  hover:bg-white lg:px-6 lg:py-4 lg:text-lg"><button
              class="w-full">Dine
              in</button></a>
        </div>

      </div>
    </div>
    <!-- right  -->
    <div class="flex flex-col w-full md:w-auto md:gap-5 lg:w-auto xl:w-2/5">
      <img src="./images/pizza-hero.webp" alt="hero-image"
        class="w-40 self-end bg-[#D7DACB] rounded-full p-1 sm:w-52 md:w-36 lg:w-40 xl:w-52">
      <img src="./images/dish1-hero.webp" alt="hero-image"
        class="w-72 self-start bg-[#D7DACB] rounded-full md:w-52 lg:w-80 xl:w-96">
    </div>
  </div>

  <!-- Services section  -->
  <div
    class="mt-10 mx-5 font-poppins flex flex-col gap-16 sm:flex-row sm:gap-5 sm:max-w-3xl md:max-w-4xl lg:max-w-5xl xl:max-w-7xl sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto">
    <div class="flex items-center flex-col text-center">
      <div class="bg-[#E6E8DD] w-32 h-32 rounded-full flex items-center justify-center">
        <i class="bi bi-cart-check text-4xl text-[#5C5F50]"></i>
      </div>
      <h2 class="text-gray-800 font-semibold text-2xl mt-2 sm:text-xl lg:text-2xl xl:text-3xl">Easy to order</h2>
      <p class="text-gray-600 text-base mt-1 w-3/4 mx-auto sm:text-sm lg:text-lg">Our user friendly UI makes it
        easier for you to order seamlesly.</p>
    </div>
    <div class="flex items-center flex-col text-center">
      <div class="bg-[#E6E8DD] w-32 h-32 rounded-full flex items-center justify-center">
        <i class="bi bi-truck text-4xl text-[#5C5F50]"></i>
      </div>
      <h2 class="text-gray-800 font-semibold text-2xl mt-2 sm:text-xl lg:text-2xl xl:text-3xl">Safe Delievery</h2>
      <p class="text-gray-600 text-base mt-1 w-3/4 mx-auto sm:text-sm lg:text-lg">Assured no damage to food with
        our safe delivery service.</p>
    </div>
    <div class="flex items-center flex-col text-center">
      <div class="bg-[#E6E8DD] w-32 h-32 rounded-full flex items-center justify-center">
        <i class="bi bi-award text-4xl text-[#5C5F50]"></i>
      </div>
      <h2 class="text-gray-800 font-semibold text-2xl mt-2 sm:text-xl lg:text-2xl xl:text-3xl">Best Quality</h2>
      <p class="text-gray-600 text-base mt-1 w-3/4 mx-auto sm:text-sm lg:text-lg">Collections of best rated
        restaurants maintains our quality standards.</p>
    </div>
  </div>

  <!-- Reviews section -->
  <div
    class="flex flex-wrap-reverse mx-5 my-10 sm:mt-16 sm:max-w-xl sm:mx-auto md:max-w-4xl md:px-5 md:flex-nowrap md:grid md:grid-cols-2 md:mt-32 lg:max-w-5xl xl:max-w-7xl">
    <div class="font-poppins">
      <h2 class="font-semibold text-2xl text-gray-800 md:text-3xl lg:text-4xl">Our lovely customer loves our food!
      </h2>
      <p class="text-gray-700 text-base mt-2 md:text-lg">“Donec euismod a mauris ornare posuere. Donec porttitor
        ex vitae ipsum tincidunt auctor. Pellentesque
        habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas”</p>
      <div class="mt-2 flex gap-3 md:mt-16">
        <i class="bi bi-star-fill md:text-lg text-[#FFCC01]"></i>
        <i class="bi bi-star-fill md:text-lg text-[#FFCC01]"></i>
        <i class="bi bi-star-fill md:text-lg text-[#FFCC01]"></i>
        <i class="bi bi-star-fill md:text-lg text-[#FFCC01]"></i>
        <i class="bi bi-star-half md:text-lg text-[#FFCC01]"></i>
      </div>
      <div>
        <h3 class="font-semibold text-lg text-gray-800 md:text-xl">Martin Robbin</h3>
        <p class="text-gray-500 text-sm md:text-lg">Delhi, India</p>
      </div>
      <div class="mt-5 flex items-center gap-2">
        <button
          class="w-5 h-5 p-5 rounded-full border border-gray-400 flex items-center justify-center cursor-pointer active:bg-gray-100 shadow shadow-gray-300">
          <i class="bi bi-arrow-left"></i>
        </button>
        <button
          class="w-5 h-5 p-5 rounded-full border border-gray-400 flex items-center justify-center cursor-pointer active:bg-gray-100 shadow shadow-gray-300">
          <i class="bi bi-arrow-right"></i>
        </button>
      </div>
    </div>
    <div class="mx-auto">
      <img src="./images/review.webp" alt="review-image" class="w-96 sm:w-80 md:w-96 lg:w-[500px]">
    </div>
  </div>

  <!-- List restaurant section  -->
  <div class="bg-red-400 text-white text-center font-poppins px-5 py-16 my-0 sm:py-14 lg:py-32">
    <h2
      class="font-semibold text-3xl sm:max-w-xl md:max-w-3xl lg:max-w-5xl xl:max-w-7xl mx-auto lg:text-4xl xl:text-5xl">
      Want to list your restaurant?</h2>
    <p class="text-red-100 text-base mt-5 max-w-lg mx-auto lg:text-lg xl:text-xl">"Got a restaurant? List it with us
      and reach more food lovers! Unlock new customers, boost orders all in one
      place!"</p>
    <a href="vendor/vendor_signup.php"><button
        class="bg-white px-5 py-2 text-gray-800 rounded-md mt-10 active:bg-gray-100">Register a
        vendor</button></a>
  </div>

  <!-- Membership section  -->
  <div
        class="my-10 mx-5 bg-pizza-img bg-cover rounded-3xl p-5 font-poppins text-white sm:max-w-xl md:max-w-3xl lg:max-w-5xl xl:max-w-7xl sm:mx-auto sm:h-80 lg:h-96 bg-center">
        <div class="mt-10 text-center sm:px-10 sm:py-7 md:px-16 lg:px-64">
            <h2 class="font-semibold text-xl sm:text-2xl md:text-3xl lg:text-4xl">Join our membership and get discount
                up to 50%</h2>
            <form action="#"
                class="bg-white flex items-center justify-between py-1 mt-9 px-2 rounded-xl sm:mt-16 sm:py-2 sm:px-3 sm:rounded-2xl lg:rounded-full lg:px-5">
                <input type="email"
                    class="w-full border-none outline-none text-gray-700 text-sm sm:text-base sm:ml-2 lg:text-lg"
                    name="" id="" placeholder="Enter your email" required>
                <button type="submit"
                    class="bg-gray-800 text-white rounded-xl active:bg-gray-900  py-2 px-4 text-sm sm:text-base sm:py-2 sm:px-3 lg:rounded-full lg:px-5 lg:py-3 lg:text-lg ">Subscribe</button>
            </form>
        </div>
    </div>

  <!-- Footer section  -->
  <div class="bg-[#E6E8DD;] py-12 px-5 font-poppins">
    <div class="lg:max-w-5xl lg:flex lg:justify-between mx-auto xl:max-w-7xl">
      <div class="max-w-xs mx-auto lg:mx-0 xl:mx-0">
        <img class="w-36 mx-auto" src="./images/logo/logo.webp" alt="logo">
        <p class="text-sm text-[#6A6E5C] text-center mt-2">We deliver best food to you with our quality vendors
          that
          serve you the best food in the city.</p>
        <!-- Social handles -->
        <div class="flex items-center gap-3 justify-center mt-5">
          <a href="#"
            class="bg-white flex items-center justify-center w-10 h-10 rounded-full hover:bg-[#6A6E5C]"><i
              class="bi bi-linkedin text-lg"></i></a>
          <a href="#"
            class="bg-white flex items-center justify-center w-10 h-10 rounded-full hover:bg-[#6A6E5C]"><i
              class="bi bi-instagram text-lg"></i></a>
          <a href="#"
            class="bg-white flex items-center justify-center w-10 h-10 rounded-full hover:bg-[#6A6E5C]"><i
              class="bi bi-facebook text-lg"></i></a>
          <a href="#"
            class="bg-white flex items-center justify-center w-10 h-10 rounded-full hover:bg-[#6A6E5C]"><i
              class="bi bi-twitter-x text-lg"></i></a>
        </div>
      </div>
      <div
        class="mt-8 flex flex-col gap-10 items-center justify-center sm:flex-row sm:items-baseline lg:justify-between lg:gap-16">
        <div class="block">
          <h2 class="font-semibold text-gray-800 text-lg">Support</h2>
          <div class="flex flex-col gap-2 text-[#6A6E5C] mt-2">
            <a href="profile.php">Account</a>
            <a href="#">FAQs</a>
            <a href="#">Feedback</a>
          </div>
        </div>
        <div class="block">
          <h2 class="font-semibold text-gray-800 text-lg">Get in touch</h2>
          <div class="flex flex-col gap-2 text-[#6A6E5C] mt-2">
            <a href="#">hello@tiffy.com</a>
            <a href="#">+91 9820223338</a>
          </div>
        </div>
        <div class="block">
          <h2 class="font-semibold text-gray-800 text-lg">Usefull links</h2>
          <div class="flex flex-col gap-2 text-[#6A6E5C] mt-2">
            <a href="#">Terms of service</a>
            <a href="#">Privacy policy</a>
            <a href="#">About us</a>
            <a href="contributors/contributor.html">Our contributor</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    const menu = document.querySelector(".menu");
    const navitems = document.getElementById("nav-items");

    menu.addEventListener("click", () => {
      navitems.classList.toggle("hidden")
    })
  </script>
</body>


<script
src="https://www.chatbase.co/embed.min.js"
chatbotId="gvEIQuZ1QCpui9UuF1UWX"
domain="www.chatbase.co"
defer>
</script>
</html>