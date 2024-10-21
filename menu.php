<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
    exit;
}
else {
    $id = $_GET['id'];
    include 'partials/_dbconnect.php';
    $query1 = "SELECT * FROM `restaurant` WHERE `r_id` LIKE '$id'";
    $res = mysqli_query($conn, $query1);
    $result = mysqli_fetch_assoc($res);
    $rid = $result['r_id'];
    
}

if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $_SESSION['rest_id']= $_POST['restaurant_id'];

}


if (isset($_POST['itemsInCart'])) {
    $_SESSION['Order'] = $_POST['itemsInCart'];
    $_SESSION['amount']=$_POST['amount'];
}
?>


<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="stylesheet" type="text/css" href="./main.css">



    <!--Bootstrap CDNs-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="output.css">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
   <link rel="stylesheet" href="menu.css">
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
                cartName += "<p>" + itemName +  "</p>";
                //cartQuantity += "<input readonly value='"+ quantity + "'";
                cartQuantity += "<p>" + quantity + "</p>";
                cartPrice += "<p>" + itemTotalPrice + "</p>";
                cartTotalPrice += itemTotalPrice;


            }
            
            $("#cart").html(cartName);
            $("#quantity").html(cartQuantity);
            $("#price").html(cartPrice);
            //$.post("menu.php", {"itemsInCart": itemName + ' - ' + quantity})
            if(cartTotalPrice>0){
            $("#totalPrice").text( cartTotalPrice);
            $("#tpText").text('TOTAL PRICE');
            }
            else{
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
            console.log("remove dataid " , itemId)
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
                if(cart[itemId] <1){
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



<body style="background-color:#f2f2f2" onload="myLoading()">
    <div id="loadingScreen"></div>
    <div class="gtranslate_wrapper"></div>
      <script>window.gtranslateSettings = {"default_language":"en","detect_browser_language":true,"wrapper_selector":".gtranslate_wrapper"}</script>
      <script src="https://cdn.gtranslate.net/widgets/latest/float.js" defer></script>

      <nav
        class="hidden  sm:flex sm:max-w-xl md:max-w-2xl lg:max-w-5xl xl:max-w-7xl       w-full items-center justify-between max-w-7xl mx-auto font-poppins py-4">
        <a href="index.php"><img src="./images/logo/logo.png" alt="logo" class="w-36"></a>
        <div class="flex sm:gap-1 md:gap-2">
            <a href="orders.php"
                class="hover:bg-gray-200 transition-all flex gap-1 ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4 text-black">
                <img class="nav__link-icon h-6" src="images/favicons/tableware_50px.png">
                <span class="nav__link-item px-2">Orders</span> 
            </a>
            <a href="#"
                class="hover:bg-gray-200 transition-all flex gap-1 ease-in-out duration-100 active:bg-gray-300 focus:bg-gray-300 rounded-full hover:text-black py-2 px-4 text-black">
                <img class="nav__link-icon h-6"  src="images/favicons/phone_32px.png">
                <span class="nav__link-item px-2">Contact </span>
            </a>
            <form action="pin_search.php" method="post" class="flex gap-2">
                <input type="text" class=" h-12 border-2 border-black w-48 p-2 rounded-full" id="searchBar" name="pincode" placeholder="Search by Pincode" required style="border: 1px solid black;"> 
                <input type="submit" class="btn-dark py-1 px-2 text-white rounded-xl cursor-pointer" style="background-color: black;" value="Search">
            </form>
            
        </div>

        <div>
            <!-- <?php 
                echo '<a href="user_login.php" class="bg-red-500 hover:bg-red-600 transition-all ease-in-out duration-75 cursor-pointer w-max px-6 py-2 text-white rounded-full">Logout</a>';
             ?> -->
             <li class="nav__link dropdown h-full flex items-center relative"  onclick="toggle()">
                      <a class="nav__link-item flex gap-2" href="#" id="navbarDropdown" role="button">
                          <img class="nav__link-icon h-8" src="images/favicons/user_male_circle_32px.png">
                          <span class="nav__link-item h-8 flex justify-center items-center">
                            <p>
                                <?php echo $_SESSION['name']; ?>
                            </p>
                          </span>
                      </a>
                      <div class="hidden absolute flex-col right-1/2 translate-x-1/2 top-12 w-48 border-2 rounded-md p-2 border-black" id="options" style="right: 50%; transform: translateX(50%);">
                          <a class="dropdown-item border-b-2 border-black text-center" href="profile.php">Profile</a>
                          <a class="dropdown-item border-b-2 border-black text-center" href="new_track_order.php">Track Order</a>
                          <a class="dropdown-item border-b-2 border-black text-center" href="change_password.php">Change Password</a>
                          <a class="dropdown-item text-center" href="user_logout.php">Logout</a>
                      </div>
            </li>

        </div>
    </nav>

<br>
<br>

 <div class="container-width">
 <div id="hero-bg" class="hero-section">
        <div class="overlay">
            <h1><i><?php echo $result['r_name'];?></i></h1>
            <p>Umaria, Rau</p>
        </div>
    </div>
<script>
    document.getElementById('hero-bg').style.backgroundImage = "url('vendor/<?php echo $result['r_bg']; ?>')";
</script>

    <h2>Items:</h2>
    <div class="big-container">
         <div class="item-grid">
        <?php
                                    $query2 = "SELECT * FROM `menu` WHERE `r_id` LIKE '$id'";
                                    $result2 = mysqli_query($conn, $query2);
                                    $counter = 0;

                                    while ($row = mysqli_fetch_array($result2)) {
                                        $counter++;
                                        echo '
                                            <div class="item-card">
                                                <img src="./images/download (1).jpg" alt="Cheese Burger">
                                                <h3> <b id="item' . $counter . '">' . $row['m_name'] . '</b></h3>
                                                <p id="price' . $counter . '">₹' . $row['m_price'] . '</p>
                                                <button data-id="' . $counter . '" id="' . $counter . '" class="mybtn btn btn-success btn-sm rounded">Add To Cart</button>
                                           </div>
                                        ';
                                        

                                    }
                                    
                                    ?>
                
        
        </div>

     <!-- cart design  -->
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
                                            <td id="cart" class="text-left" scope="row">No item Add to Cart</td>
                                            <td id="quantity" class="text-left"></td>
                                            <td id="price" class="text-left"></td>
                                        </tr>
                                        <hr>
                                            <td id="" class="text-left" scope="row"><b id="tpText"></b></td>
                                            <td id="" class="text-left"></td>
                                            <td id="" class="text-left"><b id="totalPrice"></b></td>
                                    </tbody>
                                </table>
                                <div id="addVal"></div><form action="/homemade/menu.php" method="post">
                                    <input hidden value="<?php echo $id ?>" name="restaurant_id"/>
                               <a href="checkout.php"> <button id="checkoutBtn" class="check-out-btn checkOutBtn" style="display:none;background-color:#e64a19;border:none;color:white;height:40px;width:100%;font-size:14px">CHECKOUT</button></a>
                               </form>
                            </div>
                        </div>
        </div>
    </div>
       
    



 </div>
    


     <div class="container">

        <!-- <div class="row">
            <div class="col-12">
                <img src="vendor/<?php echo $result['r_bg'];?>" style="width: 100%;height: 300px">
                <h1 class="" style="z-index:10000; margin-top: -100px; margin-left: 60px; font-family:verdana;color: #ffe000"> <b><i><?php echo $result['r_name'];?></i></b></h1>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- ... (rest of the modal content remains unchanged) ... -->
    </div>

    <script>
        var preloader = document.getElementById('loadingScreen');
        function myLoading() {
            preloader.style.display = 'none';
        }
    </script>

    <script src="./darkMode.js"></script>
    
</body>
</html>
