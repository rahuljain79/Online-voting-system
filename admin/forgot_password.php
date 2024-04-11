<?php
// Include PHPMailer library
include 'includes/session.php';
	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // SMTP configuration
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'smartelections123@gmail.com';
    $mail->Password = 'npdhbujjvwlscegk';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Sender and recipient details
    $mail->setFrom('smartelections@gmail.com', 'Smart Elections');
    $email = 'jaingarv678@gmail.com';
    $mail->addAddress($email);

    // Generate a random password reset token (you can use a more secure method)
    $token = bin2hex(random_bytes(32));

    // Store the token in the database along with the user's email address
    // (you will need to create a new table in your database to store the tokens)

    // Send an email to the user with a link to the password reset page, including the token as a parameter
    $reset_link = "https://example.com/reset_password.php?token=" . $token;
    $subject = "Password reset instructions";
    $message = "Please click on the following link to reset your password: " . $reset_link;

    // Email content
    $mail->Subject = $subject;
    $mail->Body = $message;
    $mail->AltBody = 'Please click on the following link to reset your password: ' . $reset_link;

    // Send the email
    $mail->send();

    echo "An email with password reset instructions has been sent to " . $email;
} catch (Exception $e) {
    echo "Error sending email: " . $mail->ErrorInfo;
}
?>
