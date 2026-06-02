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

        // SMTP SETTINGS (HOSTINGER)
        $mail->isSMTP();
        $mail->Host = 'smtp.hostinger.com';
        $mail->SMTPAuth = true;

        // YOUR HOSTINGER EMAIL
        $mail->Username = 'info@kunduindustries.com';
        $mail->Password = 'VerifiedDomain@29';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 465;

        // EMAIL SETTINGS
        $mail->setFrom('info@kunduindustries.com', 'Kundu Industrial Website');
        $mail->addAddress('info@kunduindustries.com');

        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = "New Enquiry: $subject";

        $mail->Body = "
        <h3>New Contact Form Submission</h3>
        <p><b>Name:</b> $name</p>
        <p><b>Email:</b> $email</p>
        <p><b>Phone:</b> $phone</p>
        <p><b>Subject:</b> $subject</p>
        <p><b>Message:</b><br>$message</p>
        ";

        $mail->send();

        echo "<h2>Message sent successfully!</h2><a href='contact.html'>Back</a>";

    } catch (Exception $e) {
        echo "Message failed: {$mail->ErrorInfo}";
    }

}
?>
