<?php
require 'dbconnect.php';
$task = $conn->real_escape_string($_GET['task']);
$id = $conn->real_escape_string($_GET['id']);


if ($task == 'edit') {
    $fetch_user = "select * from users where id='$id' and is_user_verified='1' and is_admin='0'";
    $res_fetch_user = $conn->query($fetch_user);
    if ($res_fetch_user->num_rows > 0) {
        while ($row = $res_fetch_user->fetch_assoc()) {
            $name = $row['name'];
            $email = $row['email'];
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <a href="adminpanel.php">Home</a>
        <center>

            <form action="#" method="POST">
                <label for="edit_name">Name </label>
                <input type="text" value="<?php echo $name; ?>" name="edit_name" /><br>
                <label for="edit_email">Email</label>
                <input type="text" value="<?php echo $email; ?>" name="edit_email" />
                <button type="submit" name="edit_completed">Submit</button>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_completed'])) {
                $edited_name = $_POST['edit_name'];
                $edited_email = $_POST['edit_email'];
                $update_user_info = "update users set name='$edited_name' , email='$edited_email' where id='$id';";
                $res_update_user_info = $conn->query($update_user_info);
                echo "<script>alert('user information updated');window.location.href='handle_user.php?id=$id&task=$task';</script>";
            }
            ?>
    </body>

    </html>


<?php
} else if ($task == 'delete') {
    $del_user = "delete from users where id='$id'";
    $res_del_user = $conn->query($del_user);
    if ($res_del_user) {
        echo "<script>alert('user deleted successfully');</script>";
        echo "<script>window.location.href='adminpanel.php';</script>";
    }
}
?>