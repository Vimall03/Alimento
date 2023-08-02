<?php

require('config.php');

session_start();
include 'partials/_dbconnect.php';
require('razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

$success = true;

$error = "Payment Failed";

if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}

if ($success === true)
{
    $razorpay_order_id = $_SESSION['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_signature = $_POST['razorpay_signature'];  

    $tranStatus  = "SUCCESS";
    $sql = "UPDATE `orders`
        SET `Transaction_status` = '$tranStatus',
        `edit_status` = 'Processing'
        WHERE `Order_id` = '{$_SESSION['orderid']}';";
    $result = mysqli_query($conn, $sql);

    $sql = "UPDATE `billing`
    SET 
    `Transaction_status` = '$tranStatus',
    `razorpay_signature` =' $razorpay_signature' ,
    `razorpay_payment_id` = '$razorpay_payment_id' ,
    `razorpay_order_id` = '$razorpay_order_id'
    WHERE 
    `Order_id` = '{$_SESSION['orderid']}';";
    $result = mysqli_query($conn, $sql);                                    
                if ($result) {
                header("location: thankyou.php");
                }         
}
else
{
    $html = "<p>Your payment failed</p>
            <p>{$error}</p>";


    $tranStatus  = "FAILED";
    $sql = "UPDATE `orders`
            SET `Transaction_status` = '$tranStatus'
            WHERE `Order_id` = '{$_SESSION['orderid']}';";
            $result = mysqli_query($conn, $sql);   
}

echo $html;
