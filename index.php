<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <div class="container">
        <div class="box form-box ">
            <?php
            include 'db.php';
            session_start();
            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);

                $vetify_user = mysqli_query($conn, "Select * from users where email='$email' and password='$password'");
                $user = mysqli_fetch_assoc($vetify_user);

                if (is_array($user) && !empty($user)) {
                    $_SESSION['valid'] = $email;
                    $_SESSION['level'] = (int)$user['level'];
                    if ($_SESSION['level'] == 1) {
                        header("Location: /admin/admin.php?id_admin=" . $user['id']);
                        exit();
                    } else {
                        header("Location: user/user.php?id_user=" . $user['id']);
                        exit();
                    }
                } else {
                    echo "<div>Wrong Email or Password</div><br>";
                    echo "<div><a href='index.php' class='btn'>Go Back</a></div>";
                }
            } else {
            ?>
                <header>Login</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="email"><b>Email</b></label>
                        <input type="email" name="email" id="email" required />
                    </div>
                    <div class="field input">
                        <label for="password"><b>Password</b></label>
                        <input type="password" name="password" id="password" required />
                    </div>
                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Login" required />
                    </div>
                </form>
                <div class="links">
                    Don't have account?<a href="register.php">Sign Up Now</a>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>