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
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $email = mysqli_real_escape_string($conn, $_POST['email']);
                $password = mysqli_real_escape_string($conn, $_POST['password']);
                $age = (int)$_POST['age'];
                $level = 2;

                $verify_query = mysqli_query($conn, "Select * from users where email = '$email'");
                if (mysqli_num_rows($verify_query) != 0) {
                    echo "<div>This email is used, Try another one, Please</div><br>";
                    echo "<div><a href='register.php' class='btn'>Go Back</a></div>";
                } else {
                    mysqli_query($conn, "Insert into users (username, email, age, password, level) values('$username', '$email', '$age',  '$password', '$level')");
                    echo "<div>Registration successfully</div><br>";
                    echo "<div><a href='index.php' class='btn'>Login Now</a></div>";
                }
            } else {
            ?>
                <header>Sign up</header>
                <form action="" method="post">
                    <div class="field input">
                        <label for="username"><b>Username</b></label>
                        <input type="text" name="username" id="username" required />
                    </div>
                    <div class="field input">
                        <label for="email"><b>Email</b></label>
                        <input type="email" name="email" id="email" required />
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
                        <input type="submit" class="btn" name="submit" value="Register" required />
                    </div>

                </form>
                <div class="links">
                    Already a member?<a href="index.php">Sign In</a>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>