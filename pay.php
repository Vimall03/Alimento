<?php

require('config.php');
require('razorpay-php/Razorpay.php');
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("location: user_login.php");
    exit;
}


// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'partials/_dbconnect.php';
  $name = $_SESSION["name"];
  $email = $_SESSION['email']; 
  $phoneNO = $_POST['phone']; 
  $_SESSION['Billing_phone']=$_POST['phone']; 
  $address = $_POST["address1"] . " " . $_POST["address2"] . " " . $_POST["address3"] ;
  $_SESSION['Billing_address'] = $address;
  $amount = $_SESSION['amount'] ;
  $tranStatus = "PENDING";

//   $sql = "UPDATE `orders`
//   SET `Name` ='$name'
//   WHERE `Order_id` = '{$_SESSION['orderid']}';";
  
//   $result = mysqli_query($conn, $sql);

//   $sql= "INSERT INTO `billing` (`email`, `address`, `Transaction_status`, `Order_id`,  `phone`, `amount`)
//          VALUES ('$email', '$address', '$tranStatus', '{$_SESSION['orderid']}',  '$phoneNO', '$amount'  );";
//   $result = mysqli_query($conn, $sql);
}
$orderData = [
    'receipt'         => $_SESSION['orderid'],
    'amount'          => $amount * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}



$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "homemade",
    "description"       => "desc",
    "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
    "prefill"           => [
    "name"              => $name,
    "email"             => $email,
    "contact"           => $phoneNO,
    ],
    "notes"             => [
    "address"           => $address,
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);
?>
<script src="https://code.jquery.com/jquery-3.5.0.js"></script>

<form action="/homemade/verify.php" method="POST">
    <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $data['key']?>"
        data-amount="<?php echo $data['amount']?>" data-currency="INR" data-name="<?php echo $data['name']?>"
        data-image="<?php echo $data['image']?>" data-description="<?php echo $data['description']?>"
        data-prefill.name="<?php echo $data['prefill']['name']?>"
        data-prefill.email="<?php echo $data['prefill']['email']?>"
        data-prefill.contact="<?php echo $data['prefill']['contact']?>"
        data-notes.shopping_order_id="<?php echo $_SESSION['orderid'] ?>" data-order_id="<?php echo $data['order_id']?>"
        <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
        <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>"
        <?php } ?>>
    </script>
    <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
    <input type="hidden" name="shopping_order_id" value="<?php echo $_SESSION['orderid'] ?>">
</form>

<style>
.razorpay-payment-button {
    display: none;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
    let options = {
        key: "<?php echo $data['key']?>", // Your Razorpay Key
        amount: "<?php echo $data['amount']?>", // Amount is in currency subunits
        currency: "INR",
        name: "<?php echo $data['name']?>",
        description: "<?php echo $data['description']?>",
        image: "<?php echo $data['image']?>",
        order_id: "<?php echo $data['order_id']?>",
        handler: function (response){
            window.location.href = "/alimento/verify.php?razorpay_payment_id=" + response.razorpay_payment_id;
        },
        prefill: {
            name: "<?php echo $data['prefill']['name']?>",
            email: "<?php echo $data['prefill']['email']?>",
            contact: "<?php echo $data['prefill']['contact']?>"
        },
        notes: {
            shopping_order_id: "<?php echo $_SESSION['orderid'] ?>"
        }
    };
    
    let razorpay = new Razorpay(options);
    razorpay.open();
});
</script>