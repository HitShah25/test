<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="registration.php"> Registration</a><br>
    <?php
    if(!isset($_GET['otp']))
    {
    ?>
    
    <a href="index.php?otp=1">Login using OTP</a><br>
    <center>
    
        <form action="handle_login.php" method="post">
            <label for="email">Email :</label>
            <input type="email" name="email" placeholder="Enter your email" required><br>
            
            <label for="password">Password :</label>
            <input type="password" name="password" placeholder="Enter your password" required><br>
            
            <button type="submit" name="login_password">LOGIN</button>
        </form>
    <?php 
    }
    elseif($_GET['otp'] == 1)
    {
        ?>
        <a href="index.php">Login using Password</a><br>
        <center>
        <form action="handle_login.php" method="post">
            <label for="email">Email :</label>
            <input type="email" name="email" placeholder="Enter your email" required><br>
            <button type="submit" name="login_otp">LOGIN</button>
        </form>            

        <?php
    }
    ?>
    </center>
</body>
</html>
