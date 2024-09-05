<?php
include '../db.php';
session_start();
if (isset($_GET['id_user'])) {
    $id_user = (int)$_GET['id_user'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User</title>
        <link rel="stylesheet" href="../styles/styles.css">
    </head>

    <body>
        <div class="nav">
            <?php
            echo "<a href='user.php?id_user=" . $id_user . "' class='logo'>Logo</a>";
            ?>

            <div class="right-links">
                <?php
                echo "<a href='../post/add_post.php?id_user=" . $id_user . "' class='btn'>Add Post</a>";
                ?>
                <?php
                echo "<a href='../post/my_post.php?id_user=" . $id_user . "' class='btn'>My Post</a>";
                ?>
                <?php
                echo "<a href='edit.php?id_user=" . $id_user . "' class='btn'>Change Profile</a>";
                ?>
                <a href="../index.php" class="btn">Log Out</a>
            </div>
        </div>
        <div class="container">
            <div class="box form-box ">
                <header>Change Info</header>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $username = mysqli_real_escape_string($conn, $_POST['username']);
                    $age = (int)$_POST['age'];
                    $old_password = mysqli_real_escape_string($conn, $_POST['old_password']);
                    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
                    $result = mysqli_query($conn, "select password from users where id = '$id_user'");
                    $row = mysqli_fetch_assoc($result);
                    if ($row['password'] == $old_password) {
                        $req = mysqli_query($conn, "Update users set username = '$username', age = '$age', password = '$new_password' where id = '$id_user'");
                        if ($req) {
                            echo "<div>Edit Successfully</div>";
                            echo "<a href='user.php?id_user=" . $id_user . "' class='btn'>Go Back</a>";
                        } else {
                            echo "<div>Failed, Try again!</div>";
                            echo "<a href='edit.php?id_user=" . $id_user . "' class='btn'>Go Back</a>";
                        }
                    } else {
                        echo "<div>Password is incorrect</div>";
                        echo "<a href='edit.php?id_user=" . $id_user . "' class='btn'>Try again</a>";
                    }
                } else {
                ?>
                    <form action="" method="post">
                        <div class="field input">
                            <label for="username"><b>Username</b></label>
                            <input type="text" name="username" id="username" required />
                        </div>
                        <div class="field input">
                            <label for="age"><b>Age</b></label>
                            <input type="number" name="age" id="age" required />
                        </div>
                        <div class="field input">
                            <label for="old_password"><b>Old Password</b></label>
                            <input type="password" name="old_password" id="old_password" required />
                        </div>
                        <div class="field input">
                            <label for="mew_password"><b>New Password</b></label>
                            <input type="password" name="new_password" id="new_password" required />
                        </div>
                        <div class="field">
                            <input type="submit" class="btn" name="submit" value="Update" required />
                        </div>
                    </form>
                <?php }
                ?>
            </div>
        </div>

    </body>

    </html>

<?php }
?>