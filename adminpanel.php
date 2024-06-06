    <?php
    session_start();
    require 'dbconnect.php';
    $id = $_SESSION['user_id'];
    $name = $_SESSION['name'];

    if (isset($_SESSION['user_id'])) {
    ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <style>
            table {
                width: auto;
                text-align: left;
            }

            th,
            td {
                padding: 12px;
                border-bottom: 1px solid #ddd;
            }
        </style>

        <body>
            <a href="logout.php">Logout</a>
            <h1>Welcome admin</h1>
            <h2>User Data Table</h2>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date of Joining</th>
                    <th>Last Joining</th>
                    <th></th>
                </tr>
                <tr>

                    <?php
                    $fetch_data = "select * from users where is_admin='0'";
                    $res_fetch_data = $conn->query($fetch_data);
                    if ($res_fetch_data->num_rows > 0) {
                        while ($row = $res_fetch_data->fetch_assoc()) {
                            $user_id = $row['id'];
                            $user_name = $row['name'];
                            $user_email = $row['email'];
                            $user_doj = $row['dat_expiry'];
                            $last_login = $row['last_login'];

                            $date_joining = new DateTime($user_doj);
                            $formatted_date_joining = $date_joining->format('F j, Y');

                            $last_login = new DateTime($last_login);
                            $formatted_last_login = $last_login->format('F j,Y  H:i');
                    ?>
                            <td><?php echo $user_id; ?></td>
                            <td><?php echo $user_name; ?></td>
                            <td><?php echo $user_email; ?></td>
                            <td><?php echo $formatted_date_joining; ?></td>
                            <td><?php echo $formatted_last_login; ?></td>
                            <td><a href="handle_user.php?id=<?php echo $user_id ?>&task=delete">Delete</a>&nbsp;&nbsp;&nbsp;<a href="handle_user.php?id=<?php echo $user_id ?>&task=edit">Edit</a></td>
                </tr>
        <?php
                        }
                    }
        ?>
            </table>

        </body>

        </html>

    <?php
    } else {
        echo "<script>alert('Please login first');window.location.href='index.php';</script>";
    }
    ?>