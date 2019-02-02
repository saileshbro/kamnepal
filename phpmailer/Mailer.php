<?php
// MAILER CONFIGURATION USING PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    public function sendMail($email, $subject, $message)
    {
        require_once "PHPMailer.php";
        require_once 'SMTP.php';
        require_once 'POP3.php';
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = 'ssl';
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->addAddress($email);
        $mail->Username = "groupkuproject@gmail.com";
        $mail->Password = "tan(45)=1";
        $mail->setFrom("groupkuproject@gmail.com", "Kam Nepal");
        $mail->addReplyTo("groupkuproject@gmail.com");
        $mail->Subject = $subject;
        $mail->msgHTML($message);
        $mail->send();
    }
}