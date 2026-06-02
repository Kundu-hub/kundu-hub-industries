<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer(true);

    try {
        // SMTP SETTINGS
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // YOUR EMAIL (CHANGE THIS)
        $mail->Username = 'yourgmail@gmail.com';
        $mail->Password = 'your-app-password'; // NOT normal password

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // EMAIL SETTINGS
        $mail->setFrom('yourgmail@gmail.com', 'Kundu Industrial Website');
        $mail->addAddress('info@kunduindustries.com');

        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New Contact Form: $subject";

        $mail->Body = "
        <h3>New Contact Message</h3>
        <p><b>Name:</b> $name</p>
        <p><b>Email:</b> $email</p>
        <p><b>Phone:</b> $phone</p>
        <p><b>Subject:</b> $subject</p>
        <p><b>Message:</b><br>$message</p>
        ";

        $mail->send();

        echo "<h2>Message sent successfully!</h2><a href='contact.html'>Back</a>";

    } catch (Exception $e) {
        echo "Message could not be sent. Error: {$mail->ErrorInfo}";
    }

} else {
    echo "Invalid request.";
}
?>
