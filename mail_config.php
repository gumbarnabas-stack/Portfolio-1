<?php
// Mail Configuration for Portfolio Contact Form
// Add this to your server's PHP configuration or .htaccess

// For shared hosting, you might need to configure these in your hosting panel
// or contact your hosting provider for SMTP settings

// Basic PHP mail() function settings (works on most shared hosting)
ini_set('sendmail_from', 'noreply@yourdomain.com');

// If you need SMTP configuration (for better delivery), use PHPMailer instead:
/*
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function sendEmailSMTP($to, $subject, $body, $replyTo) {
    $mail = new PHPMailer(true);
    
    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // or your hosting provider's SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';
        $mail->Password = 'your-app-password';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Recipients
        $mail->setFrom('noreply@yourdomain.com', 'Portfolio Contact');
        $mail->addAddress($to);
        $mail->addReplyTo($replyTo);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
*/
?>
