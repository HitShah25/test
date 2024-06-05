<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require  'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/autoload.php';
require 'dbconnect.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_password'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $email_verify = "select * from users where email='$email' and is_user_verified='1';";
    $res_email_verify = $conn->query($email_verify);
    if ($res_email_verify->num_rows > 0) {
        while ($row = $res_email_verify->fetch_assoc())
        {
            $user_id=$row['id'];
            $db_password=$row['password'];
            $name=$row['name'];
        }
    
        if ($password==$db_password) {
        session_start();
        $_SESSION['user_id']=$user_id;
        $_SESSION['name']=$name;
        echo "<script>alert('loginned succefully');window.location.href='login.php';</script>";
        }
        else
        {
            echo "<script>alert('Password not matched');window.location.href='index.php';</script>";
        }
    }
    else
    {
        echo "<script>alert('Please enter correct email-id');window.location.href='index.php';</script>";
    }
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_otp'])) {
    $otp=rand(100000,1000000);
    $_SESSION['otp']=$otp;
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['SMTP_USER'];
    $mail->Password = $_ENV['SMTP_PASSWORD'];
    $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
    $mail->Port = $_ENV['SMTP_PORT'];
    $mail->setFrom('shahhit18@gmail.com');
    $mail->addAddress($_POST['email']);
    $mail->isHTML(true);
    $mail->Subject = "One time password";
    $mail->Body = "One time password is : $otp";
    $mail->send();
    echo "<script>window.location.href='index.php?otp=1';</script>";
}
