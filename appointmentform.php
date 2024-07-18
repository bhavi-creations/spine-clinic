<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Adjust the path to autoload.php based on your project

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assign POST data to variables
    $name = $_POST['name'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $date = $_POST['date'] ?? '';
    $department = $_POST['department'] ?? '';
    
    $message = $_POST['message'] ?? '';


    echo $name;
    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings for Gmail SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'spine360clinic@gmail.com'; // Your Gmail email address
        $mail->Password = 'qdfxgmbkbqfdbjdv'; // Your Gmail password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('spine360clinic@gmail.com', 'Spine 360 clinic'); // Your Gmail email and name
        $mail->addAddress('spine360clinic@gmail.com', 'Spine 360 clinic'); // Recipient's email and name

// Content
        $mail->isHTML(true);
        $mail->Subject = 'New Message from Appointment form';
        $mail->Body = "
   
            <h1>New Appointment</h1>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Date:</strong> $date</p>
            <p><strong>Department:</strong> $department</p>
            <p><strong>Message:</strong>$message</p>
        ";

        $mail->send();
        echo '<script> window.alert("Message has been sent.\n\nPlease click OK."); window.location.href="index.php";</script>';

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    // If accessed directly without POST data
    echo 'Access Denied';
}


?>