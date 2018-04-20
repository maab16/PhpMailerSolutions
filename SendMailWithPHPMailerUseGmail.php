<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include Autoload File
require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);                              	// Passing `true` enables exceptions
try {

    //Server settings
    $mail->SMTPDebug = 2;                                 	// Enable verbose debug output
    $mail->isSMTP();                                     	// Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  						// Specify main and backup SMTP servers
    
    /*
    * SMTPOptions is required for sending Mail using Gmail. See Updating CA certificates(https://github.com/PHPMailer/PHPMailer/wiki/Troubleshooting)
    */
    $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
    $mail->SMTPAuth = true;                               	// Enable SMTP authentication
    $mail->Username = 'YOUR_GMAIL_EMAIL';                 // SMTP username
    $mail->Password = 'YOUR_GMAIL_EMAIL_PASS';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //$mail->SMTPSecure = "false";
    //Recipients
    $mail->setFrom('SENDER_EMAIL', 'SENDER_NAME');
    $mail->addAddress('RECEIVER_EMAIL', 'RECEIVER_NAME');     // Add a recipient

    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');


    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Password Reset';
    $mail->Body    = "This is test Body";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
