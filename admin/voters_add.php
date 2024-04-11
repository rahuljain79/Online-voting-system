<?php
	include 'includes/session.php';
	
	include 'phpqrcode/qrlib.php';
	//require_once('config.php');

	require 'includes/PHPMailer.php';
	require 'includes/SMTP.php';
	require 'includes/Exception.php';
//Define name spaces
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

	if(isset($_POST['add'])){
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$email = $_POST['email'];
		$aadhar = $_POST['aadhar'];
		$pass = $_POST['password'];
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		$path = 'qrimages/';
		$file = $path.uniqid().".png";

		$ecc = 'L';
		$pixel_Size = 10;
		$frame_Size = 10;

		
		$filename = $_FILES['photo']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//generate voters id
		$set = '123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$voter = substr(str_shuffle($set), 0, 15);

		$names=array($firstname,$lastname);

		$name= implode(' ', $names);
		$values=array(
			$name,
			$aadhar,
			$voter,
			// $password,

		);

		$combinedValue = implode("\n", $values);

		$sql = "INSERT INTO voters (voters_id, password, firstname, lastname, photo, email, qrImage, aadhar) VALUES ('$voter', '$password', '$firstname', '$lastname', '$filename', '$email', '$file', '$aadhar')";
		if($conn->query($sql)){
			QRcode::png($combinedValue,$file,$ecc,$pixel_Size,$frame_Size);
			// echo '<script>alert("Voter added successfully")</script>';
			$_SESSION['success'] = 'Voter added successfully';
			$mail = new PHPMailer();

// Set up SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'smartelections123@gmail.com';
$mail->Password = 'npdhbujjvwlscegk';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Set up email content
$mail->setFrom('smartelections123@gmail.com', 'Election Committe');
$mail->addAddress($email);
$mail->addAttachment($file, 'Login');
$mail->Subject = 'Login Credentials';
$mail->Body ="Your Login Credentials are: \nAadhar No:- $aadhar \nVoter Id:- $voter  \nPassword:- $pass  \nLogin using this url:- http://localhost/votesystem/";
// Attempt to send the email
if ($mail->send()) {
    echo 'Email sent successfully!';
} else {
    echo 'Error sending email: ' . $mail->ErrorInfo;
}
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: voters.php');
?>