<?php
require_once '../../package/vendor/autoload.php';

use Dotenv\Dotenv;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();


function sendTurnNotification($ticketNumber, $email)
{
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = $_ENV['MAIL_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['MAIL_USERNAME'];
        $mail->Password   = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = (int) $_ENV['MAIL_PORT'];

        $mail->setFrom(
            $_ENV['MAIL_FROM'],
            $_ENV['MAIL_FROM_NAME']
        );

        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Your Queue Number Is Being Called";

        $safeTicket = htmlspecialchars(
            (string) $ticketNumber,
            ENT_QUOTES,
            'UTF-8'
        );

        $mail->Body = "
            <h2>It's Your Turn!</h2>
            <p>Your queue number <strong>{$safeTicket}</strong>
            is now being called.</p>
            <p>Please proceed to the Student Accounting Office.</p>
            <p>Thank you for waiting.</p>
            <p>Technological Institute of the Philippines</p>
        ";

        $mail->AltBody =
            "Your queue number {$ticketNumber} is now being called. "
            . "Please proceed to the Student Accounting Office.";

        $mail->send();

        return true;
    } catch (Exception $e) {
        error_log(
            "Turn notification failed: " . $mail->ErrorInfo
        );

        return false;
    }
}
