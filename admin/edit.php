<?php
include '../db.php';
session_start();
if (isset($_GET['id_admin'])) {
    $id = (int)$_GET['id'];
    $id_admin = (int)$_GET['id_admin'];
    if ($id == 0) $id = $id_admin;
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link rel="stylesheet" href="../styles/styles.css">
    </head>

    <body>
        <div class="nav">
            <?php
            echo "<a href='admin.php?id_admin=" . $id_admin . "' class='logo'>Logo</a>";
            ?>
            <div class="right-links">
                <?php
                echo "<a href='edit.php?id_admin=" . $id_admin . "' class='btn'>Change Profile</a>";
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
                    $password = mysqli_real_escape_string($conn, $_POST['password']);

                    $req = mysqli_query($conn, "Update users set username = '$username', age = '$age', password = '$password' where id = '$id'");
                    if ($req) {
                        echo "<div>Edit Successfully</div>";
                        echo "<a href='admin.php?id_admin=" . $id_admin . "' class='btn'>Go Back</a>";
                    } else {
                        echo "<div>Failed</div>";
                        echo "<a href='edit.php?id=" . $id . "&id_admin=" . $id_admin . "' class='btn'>Go Back</a>";
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
                            <label for="password"><b>Password</b></label>
                            <input type="password" name="password" id="password" required />
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