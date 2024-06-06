<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="#" method="post">
        <label for="otp">One time password :</label>
        <input type="number" name="otp" placeholder="Enter your one time password"><br>
        <button type="submit" name="verify_otp">login</button>
    </form>
</body>

</html>

<?php
require 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verify_otp'])) {
    $otp = $_POST['otp'];
    $email = $_GET['email'];

    $otp_check = "select * from users where email='$email';";
    $res_otp_check = $conn->query($otp_check);
    if ($res_otp_check->num_rows > 0) {
        while ($row = $res_otp_check->fetch_assoc()) {
            $user_id = $row['id'];
            $db_otp = $row['token'];
            $name = $row['name'];
            $is_admin = $row['is_admin'];
        }

        if ($db_otp == $otp) {
            session_start();
            $_SESSION['user_id'] = $user_id;
            $_SESSION['name'] = $name;
            if ($is_admin) {
                //admin
                echo "<script>alert('loginned succefully');window.location.href='adminpanel.php';</script>";
                //set token free for next time
                $otp_free = "update users set token='0', last_login=NOW() where id='$user_id';";
                $res_otp_free = $conn->query($otp_free);
            } else {
                echo "<script>alert('loginned succefully');window.location.href='login.php';</script>";
                //set token free for next time
                $otp_free = "update users set token='0' where id='$user_id';";
                $res_otp_free = $conn->query($otp_free);
            }
        } else {
            echo "<script>alert('OTP not matched');window.location.href='handle_otp.php?email=$email';</script>";
        }
    } else {
        echo "<script>alert('Please enter correct email-id');window.location.href='index.php';</script>";
    }
}

?>