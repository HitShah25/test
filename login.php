<?php 
require 'dbconnect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <a href="logout.php">Logout</a>
</body>
</html>
<?php


echo "<h1>Welcome ".$_SESSION['user_id'].$_SESSION['name']."</h1>";

echo $_SESSION['otp'];
}
else

{
    echo "<script>alert('Please login first');</script>";
    header("Location: index.php");
}
?>