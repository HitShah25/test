<?php
require 'dbconnect.php';
if (isset($_GET['token'])) {
    $token = $conn->real_escape_string($_GET['token']);
    $select_user = "SELECT * FROM users WHERE token = '$token' AND dat_expiry > NOW() - INTERVAL 10 MINUTE LIMIT 1;";
    $result = $conn->query($select_user);
    $res = mysqli_num_rows($result);
    if ($res == 1) {
        $update_user = "UPDATE users SET is_user_verified=1,token=null WHERE token='$token' ";
        if ($conn->query($update_user) === TRUE) {
            echo "<script>alert('Your email has been verified!');window.location.href('index.php');</script>";
        } else {
            echo "<script>alert('Error upadting records');window.location.href('index.php');</script>";
        }
    } else {
        echo "<script>alert('Invalid or expired token!');</script>";
    }
}
