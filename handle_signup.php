

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

if (isset($_POST['send'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $password=$conn->real_escape_string($_POST['password']);
    $token = rand(1000, 9999);
    $search_email = "select email from users where is_user_verified='1';";
    $result_search_email = $conn->query($search_email);

    if ($result_search_email->num_rows > 0) {
        while ($row = $result_search_email->fetch_assoc()) {
            if ($email == $row['email']) {
                echo "<script>alert('email-id already exist');</script>";
            } 
        }
    }else {

                $insert_user = "INSERT INTO users (name, email, password, token,is_user_verified) VALUES ('$name', '$email', '$password', '$token',0)";
                if ($conn->query($insert_user) === TRUE) {
                    try {
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
                        $mail->Subject = "HELLO";
                        $mail->Body = "http://localhost/intern/test/handle_regis_verification.php?token=$token";
                        $mail->send();
                        echo "<script>alert('Verification link sent');window.location.href='index.php';</script>";
                    } catch (Exception $e) {
                    }
                }
            }
        }
?>