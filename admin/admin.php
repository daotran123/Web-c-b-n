<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../db.php';
session_start();
if (isset($_GET['id_admin'])) {
    $id_admin = (int)$_GET['id_admin'];
    $result = mysqli_query($conn, "Select * from users");

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
                echo "<a href='add.php?id_admin=" . $id_admin . "' class='btn'>Add</a>";
                ?>
                <?php
                echo "<a href='edit.php?id_admin=" . $id_admin . "' class='btn'>Change Profile</a>";
                ?>
                <a href="../index.php" class="btn">Log Out</a>
            </div>
        </div>

        <main>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Password</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            if ((int)$row['level'] == 2) {
                                echo "<tr>";
                                echo "<th>" . $row['username'] . "</th>";
                                echo "<th>" . $row['email'] . "</th>";
                                echo "<th>" . $row['age'] . "</th>";
                                echo "<th>" . $row['password'] . "</th>";
                                echo "<th>";
                                echo "<a href='edit.php?id=" . $row['id'] . "&id_admin=" . $id_admin . "' class='btn'>Edit</a>";
                                echo "<a href='delete_user.php?id=" . $row['id'] .  "&id_admin=" . $id_admin . "' class='btn'>Del</a>";
                                echo "</th>";
                                echo "</tr>";
                            }
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

        </main>

    </body>

    </html>
<?php } else {
    echo "PHP isn't working!";
} ?>