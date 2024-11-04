<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
  header("location: user_login.php");
  exit;
} else {
  $id = $_GET['id'];
  include 'partials/_dbconnect.php';
  $query1 = "SELECT * FROM `restaurant` WHERE `r_id` LIKE '$id'";
  $res = mysqli_query($conn, $query1);
  $result = mysqli_fetch_assoc($res);
  $rid = $result['r_id'];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['rest_id'] = $_POST['restaurant_id'];
}


if (isset($_POST['itemsInCart'])) {
  $_SESSION['Order'] = $_POST['itemsInCart'];
  $_SESSION['amount'] = $_POST['amount'];
}
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
  $login_status = true;
}
?>


<html>

<head>
  <title>Home</title>
  <!-- <link rel="stylesheet" type="text/css" href="./style.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="./main.css"> -->


  <!-- Bootstrap CDNs -->
   <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
  <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>  -->

  
  <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
  <!-- Bootstrap icons  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <!-- <link rel="stylesheet" href="menu.css"> -->
  <link rel="stylesheet" href="output.css">

</head>
<script type="text/javascript">
  $(document).ready(function () {
    var cart = {};

    function addItemToCart(itemId) {
      if (cart.hasOwnProperty(itemId)) {
        cart[itemId]++;

      } else {
        cart[itemId] = 1;
      }
      updateCartDisplay();
    }



    function updateCartDisplay() {
      var cartName = "";
      var cartQuantity = "";
      var cartPrice = "";
      var cartTotalPrice = 0;


      for (var itemId in cart) {
        var quantity = cart[itemId];
        var itemElement = $("#item" + itemId);
        var itemName = itemElement.text();
        var itemPriceText = $("#price" + itemId).text();
        var itemPrice = parseInt(itemPriceText.replace(/\D/g, ""));
        var itemTotalPrice = itemPrice * quantity;

        //cartName += "<input readonly value='"+ itemName + "'";
        cartName += "<p>" + itemName + "</p>";
        //cartQuantity += "<input readonly value='"+ quantity + "'";
        cartQuantity += "<p>" + quantity + "</p>";
        cartPrice += "<p>" + itemTotalPrice + "</p>";
        cartTotalPrice += itemTotalPrice;


      }

      $("#cart").html(cartName);
      $("#quantity").html(cartQuantity);
      $("#price").html(cartPrice);
      //$.post("menu.php", {"itemsInCart": itemName + ' - ' + quantity})
      if (cartTotalPrice > 0) {
        $("#totalPrice").text(cartTotalPrice);
        $("#tpText").text('TOTAL PRICE');
      } else {
        $("#totalPrice").text('');
        $("#tpText").text('');
      }

      // Show/hide remove item buttons based on quantity
      for (var itemId in cart) {
        var quantity = cart[itemId];
        if (quantity > 0) {
          $(".removeItemBtn[data-id='" + itemId + "']").show();
          $(".checkOutBtn").show();
        } else {
          $(".removeItemBtn[data-id='" + itemId + "']").hide();
          $(".checkOutBtn").hide();
        }
      }
    }

    // Add item button click handler
    $(document).on("click", ".mybtn", function () {
      var itemId = $(this).data("id");
      addItemToCart(itemId);
    });

    // Remove item button click handler
    $(document).on("click", ".removeItemBtn", function () {
      var itemId = $(this).data("id");
      console.log("remove dataid ", itemId)
      reduceCartQuantity(itemId);
    });


    // Function to reduce the cart item quantity by 1
    function reduceCartQuantity(itemId) {
      if (cart.hasOwnProperty(itemId)) {
        if (cart.hasOwnProperty(itemId) && cart[itemId] > 0) {
          cart[itemId]--;
          if (cart[itemId] === 0) {
            $(".removeItemBtn[data-id='" + itemId + "']").hide();
            $(".checkOutBtn").hide();
            delete cart[itemId];
          }
        }
        if (cart[itemId] < 1) {
          cart = {};
        }
      }
      updateCartDisplay(); // Update the cart display
    }

    function convertCartToArray(cart) {
      var itemsInCart = [];
      for (var itemId in cart) {
        var itemName = $("#item" + itemId).text();
        var quantity = cart[itemId];
        itemsInCart.push(' ' + itemName + ' - ' + quantity + ' ');
      }
      return itemsInCart;
    }

    // Checkout button click handler
    $(document).on("click", "#checkoutBtn", function () {
      var itemsInCart = convertCartToArray(cart);

      var cartTotalPrice = $("#totalPrice").text(); // Get the cart total price from the element

      // Create a data object to send both itemsInCart and cartTotalPrice
      var postData = {
        "itemsInCart": itemsInCart,
        "amount": cartTotalPrice
      };

      $.post("menu.php", postData, function () {
        window.location.href = "checkout.php"; // Redirect to the order validation page
      });
    });
  });
</script>



<body style="background-color:#f2f2f2" onload="myLoading()" class="h-[100vh] m-0 p-0">
  <div id="loadingScreen"></div>
  <div class="gtranslate_wrapper"></div>
  <script>
    window.gtranslateSettings = {
      "default_language": "en",
      "detect_browser_language": true,
      "wrapper_selector": ".gtranslate_wrapper"
    }
  </script>
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


  <div class="container-width w-[90%] max-w-[1400px] my-10 mx-auto">
    <div id="hero-bg mt-0" class="hero-section bg-cover bg-center h-[400px] relative flex rounded-lg justify-center items-center mx-auto my-5 max-h-[400px]" style="background-image: url('images/10\ restaurants\ in\ Mumbai\ that\ offer\ the\ best\ sunset\ views.webp');">
      <div class="overlay text-white p-36 h-full text-center w-full rounded-lg items-center" style="background-color: rgba(0, 0, 0, 0.4);">
        <h1 class="text-5xl mb-[10px]"><i><?php echo $result['r_name']; ?></i></h1>
        <p class="text-white text-xl">Umaria, Rau</p>
      </div>
    </div>
    <script>
      document.getElementById('hero-bg').style.backgroundImage = "url('vendor/<?php echo $result['r_bg']; ?>')";
    </script>

    <h2 class="mb-5 text-3xl font-semibold">Items:</h2>
    <div class="big-container flex justify-between flex-wrap">
      <div class="item-grid sm:grid-cols-[repeat(auto-fill,_minmax(200px,_1fr))] grid gap-5 max-w-[900px] md:grid-cols-[repeat(auto-fill,_minmax(250px,_1fr))] grid-cols-[repeat(auto-fill,_minmax(150px,_1fr))]">
        <?php
          $query2 = "SELECT * FROM `menu` WHERE `r_id` LIKE '$id'";
          $result2 = mysqli_query($conn, $query2);
          $counter = 0;
          while ($row = mysqli_fetch_array($result2)) {
            $counter++;
            echo '
                <div class="item-card bg-white rounded-lg shadow-md text-center p-4 mb-5 transition-transform duration-300 ease hover:scale-105">
                  <img class="w-full h-auto rounded-lg" src="./images/download (1).webp" alt="Cheese Burger">
                  <h3 class="mx-0 mt-3 mb-3 text-left h-10"> <b id="item' . $counter . '">' . $row['m_name'] . '</b></h3>
                  <p class="text-lg pt-2 mb-4 text-left" id="price' . $counter . '">₹' . $row['m_price'] . '</p>
                  <button data-id="' . $counter . '" id="' . $counter . '" class="bg-[#ff5722] text-white border-none py-3 px-5 rounded-md cursor-pointer text-base w-full transition-all duration-300 mybtn ease-in hover:bg-[#e64a19]">Add To Cart</button>
                </div>
            ';
          }
        ?>


      </div>

      <div class="w-1/3">
        <div class="card mt-5">
          <div class="card-body" style="min-height: 200px;">
            <table class="table-auto w-full border-separate border-spacing-0">
              <thead>
                <tr>
                  <th class="text-center border-b border-gray-200 py-2">Name</th>
                  <th class="text-center border-b border-gray-200 py-2">Quantity</th>
                  <th class="text-center border-b border-gray-200 py-2">Price</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td id="cart" class="text-center py-2">No item Add to Cart</td>
                  <td id="quantity" class="text-center"></td>
                  <td id="price" class="text-center"></td>
                </tr>
                <tr>
                  <td class="text-center py-2 font-bold" id="tpText"></td>
                  <td class="text-center py-2"></td>
                  <td class="text-center py-2 font-bold" id="totalPrice"></td>
                </tr>
              </tbody>
            </table>
            <div id="addVal"></div>
            <form action="/alimento/checkout.php" method="post">
              <input type="hidden" value="<?php echo $id ?>" name="restaurant_id" />
              <a href="checkout.php">
                <button id="checkoutBtn" class="check-out-btn checkOutBtn bg-[#e64a19] text-white w-full h-10 text-sm hidden"
                  style="border:none;">CHECKOUT</button>
              </a>
            </form>
          </div>
        </div>
      </div>

    </div>





  </div>



  <div class="container">

    <!-- <div class="row">
            <div class="col-12">
                <img src="vendor/<?php echo $result['r_bg']; ?>" style="width: 100%;height: 300px">
                <h1 class="" style="z-index:10000; margin-top: -100px; margin-left: 60px; font-family:verdana;color: #ffe000"> <b><i><?php echo $result['r_name']; ?></i></b></h1>
            </div>
            <div class="col-12">
                <div class="row mt-100">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mt-20">
                                    <?php
                                    $query2 = "SELECT * FROM `menu` WHERE `r_id` LIKE '$id'";
                                    $result2 = mysqli_query($conn, $query2);
                                    $counter = 0;

                                    while ($row = mysqli_fetch_array($result2)) {
                                      $counter++;
                                      echo '
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-2 text-center">';
                                      if ($row['m_type'] == "Veg") {
                                        echo '<i class="fa fa-minus-circle fa-2x text-success"></i>';
                                      } else if ($row['m_type'] == "Non-Veg") {
                                        echo '<i class="fa fa-minus-circle fa-2x text-danger"></i>';
                                      }
                                      echo '</div>
                                                <div class="col-6">
                                                    <h5><b id="item' . $counter . '">' . $row['m_name'] . '</b></h5>
                                                    <p class="text-grey">Rs.<span class="text-grey" id="price' . $counter . '">' . $row['m_price'] . '</span></p>
                                                </div>
                                                <div class="col-2">
                                                    <button data-id="' . $counter . '" id="' . $counter . '" class="mybtn btn btn-success btn-sm rounded">Add Item</button>
                                                </div>
                                                <div class="col-2">
                                                    <button data-id="' . $counter . '"  class="removeItemBtn btn btn-danger btn-sm rounded" style="display:none">Remove Item</button> 
                                                </div>
                                                
                                            </div>
                                        </div><hr>';
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card bt-20">
                            <div style="min-height: 200px;" class="card-body">
                                <table class="table table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">Name<hr></th>
                                            <th scope="col" class="text-center">quantity<hr></th>
                                            <th scope="col" class="text-center">price<hr></th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td id="cart" class="text-center" scope="row"></td>
                                            <td id="quantity" class="text-center"></td>
                                            <td id="price" class="text-center"></td>
                                        </tr>
                                        <hr>
                                            <td id="" class="text-center" scope="row"><b id="tpText"></b></td>
                                            <td id="" class="text-center"></td>
                                            <td id="" class="text-center"><b id="totalPrice"></b></td>
                                    </tbody>
                                </table>
                                <div id="addVal"></div><form action="/alimento/menu.php" method="post">
                                    <input hidden value="<?php echo $id ?>" name="restaurant_id"/>
                               <a href="checkout.php"> <button id="checkoutBtn" class="btn btn-primary checkOutBtn" style="display:none">CHECKOUT</button></a>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <!-- ... (rest of the modal content remains unchanged) ... -->
  </div>

  <script>
    var preloader = document.getElementById('loadingScreen');

    function myLoading() {
      preloader.style.display = 'none';
    }

    const menu = document.querySelector(".menu");
    const navitems = document.getElementById("nav-items");

    menu.addEventListener("click", () => {
      navitems.classList.toggle("hidden")
    })
  </script>

  <script src="./darkMode.js"></script>

</body>

</html>