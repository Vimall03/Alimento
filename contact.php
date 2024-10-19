<?php
// If you have changed the path, then update the path here too
require 'C:\xampp\htdocs\Alimento\phpmailer\Exception.php';
require 'C:\xampp\htdocs\Alimento\phpmailer\PHPMailer.php';
require 'C:\xampp\htdocs\Alimento\phpmailer\SMTP.php';
//dont change the below use conditions
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    
    $mail = new PHPMailer(true);

    try {
        // SMTP Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  
        $mail->SMTPAuth = true;
        $mail->Username = 'atomdynoxfarlight84@gmail.com';  // Your email address
        $mail->Password = 'pdiiozxxjwetwvtw';  // Your email app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;  
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);  // From the form sender's email and name
        $mail->addAddress('aftereditofficial@gmail.com');  // Your email to receive the message

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Alimento Contact Form';
        $mail->Body = nl2br("Name: $name\nEmail: $email\nMessage:\n$message");
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage:\n$message";  // Plain message edit this for custom message

        // Send email
        $mail->send();
        header('Location: index.php?success=true');
        exit();
        //echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
