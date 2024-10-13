<?php

require('config.php');

session_start();
include 'partials/_dbconnect.php';
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false) {
    $api = new Api("rzp_test_KvVwa75VGRseJn", "Sw64vDNjVtBESxJq6YJbbPzd");

    try {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    } catch (SignatureVerificationError $e) {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true) {
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_signature = $_POST['razorpay_signature'];

    $tranStatus = 'SUCCESS';
    $order = $_SESSION['Order'];
    $orderId = $_SESSION['orderid'];
    $restId = $_SESSION['rest_id'];
    $userId = $_SESSION['user_id'];
    $amount = $_SESSION['amount'];
    $address = $_SESSION['Billing_address'];
    $phone = $_SESSION['Billing_phone'];
    $name = $_SESSION['name'];

    // Added $order in the query as it is set to 'NOT NULL' and no DEFAULT value is provided. Later it is updated in below forEach loop.
    $sql = "INSERT INTO `orders` ( `order_id`, `r_id`, `user_id`, `order`, `amount`, `address`, `phone`, `payment`, `order_status`, `rating`, `name`) 
    VALUES ('$orderId', '$restId', '$userId', '$order', '$amount', '$address', '$phone', '$tranStatus', 'Accecpted', '0', '$name');";
    $result = mysqli_query($conn, $sql);

    foreach ($order as $item) {
        $sql = "UPDATE `orders` SET `order` = CONCAT(`order`, '$item') WHERE `order_id` = '$orderId';";
        $result = mysqli_query($conn, $sql);
    }

    if ($result) {
        header("location: new_track_order.php");
    }
}


// $sql = "UPDATE `billing`
// SET 
// `Transaction_status` = '$tranStatus',
// `razorpay_signature` =' $razorpay_signature' ,
// `razorpay_payment_id` = '$razorpay_payment_id' ,
// `razorpay_order_id` = '$razorpay_order_id'
// WHERE 
// `Order_id` = '{$_SESSION['orderid']}';";
// $result = mysqli_query($conn, $sql);                                    
//             if ($result) {
//             header("location: thankyou.php");
//             }         
else {
    $html = "<p>Your payment failed</p>
            <p>{$error}</p>";


    $tranStatus = "FAILED";
    $sql = "UPDATE `orders`
            SET `Transaction_status` = '$tranStatus'
            WHERE `Order_id` = '{$_SESSION['orderid']}';";
    $result = mysqli_query($conn, $sql);
}


