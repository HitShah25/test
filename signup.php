

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require  'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

if (isset($_POST['send'])) 
{
$mail=new PHPMailer(true);
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->SMTPAuth=true;
$mail->Username='shahhit18@gmail.com';
$mail->Password='jtcpqylsdnpyvjyp';
$mail->SMTPSecure='ssl';
$mail->Port=465;
$mail->setFrom('shahhit18@gmail.com');
$mail->addAddress($_POST['email']);
$mail->isHTML(true);
$mail->Subject="HELLO";
$mail->Body="http://localhost/intern/test/verify.php";
$mail->send();

}
?>