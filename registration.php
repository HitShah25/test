<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="handle_signup.php" method="post">
        <label for="name">Name :</label>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email :</label>
        <input type="email" name="email" value="" required><br>

        <label for="password">Password :</label>
        <input type="password" name="password" value="" required><br>

        <button type="submit" name="send">send</button>
    </form>
</body>

</html>