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
    <link rel="stylesheet" type="text/css" href="css/style.css">

    <!--Bootstrap CDNs-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

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
            }
            else{
                $("#totalPrice").text('');
            }

            // Show/hide remove item buttons based on quantity
            for (var itemId in cart) {
                var quantity = cart[itemId];
                if (quantity > 0) {
                    $(".removeItemBtn[data-id='" + itemId + "']").show();
                } else {
                    $(".removeItemBtn[data-id='" + itemId + "']").hide();
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


    <div class="container">
        <div class="row">
            <div class="col-12">
                <img src="<?php echo $result['r_bg'];?>" style="width: 100%;height: 300px">
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
                                        } else {
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
                                    </tbody>
                                </table>
                                <div id="addVal"></div><form action="/homemade/menu.php" method="post">
                                    <input hidden value="<?php echo $id ?>" name="restaurant_id"/>
                               <a href="checkout.php"> <button id="checkoutBtn" class="btn btn-primary"><p id="totalPrice" class="text-center"></p></button></a>
                               </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
</body>
</html>
