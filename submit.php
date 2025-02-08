<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['bb-name'];
    $phone = $_POST['bb-phone'];
    $time = $_POST['bb-time'];
    $date = $_POST['bb-date'];
    $children = $_POST['bb-number'];
    $babysitter = $_POST['bb-branch'];
    $message = $_POST['bb-message'];

    $mail = new PHPMailer(true);

    try {
        // Enable detailed debugging
        $mail->SMTPDebug = 3; // Show detailed SMTP errors
        $mail->Debugoutput = 'html';

        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'mission101commision@gmail.com';  
        $mail->Password = 'uoqr rlou vcou feqi'; // Replace with an App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email Settings
        $mail->setFrom('mission101commision@gmail.com', 'Babysitting Service');
        $mail->addAddress('lshteynblik@gmail.com', 'Booking Admin');

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Babysitting Booking Request";
        $mail->Body = "
            <h2>New Booking Request</h2>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Date:</strong> $date at $time</p>
            <p><strong>Babysitter:</strong> $babysitter</p>
            <p><strong>Number of Children:</strong> $children</p>
            <p><strong>Message:</strong> $message</p>
        ";

        // Send Email
        if ($mail->send()) {
            ob_start(); // Fix redirect issues
            header("Location: index.html?success=1");
            ob_end_flush();
            exit();
        } else {
            echo "Error sending your request.";
        }
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
