<?php
include '../db.php';
session_start();
if (isset($_GET['id_user'])) {
    $id_user = (int)$_GET['id_user'];
    $result = mysqli_query($conn, "Select title, context, posts.id as id_post from posts INNER JOIN users ON posts.user_id = users.id Where users.id = $id_user");
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
            echo "<a href='../user/user.php?id_user=" . $id_user . "' class='logo'>Logo</a>";
            ?>

            <div class="right-links">
                <?php
                echo "<a href='add_post.php?id_user=" . $id_user . "' class='btn'>Add Post</a>";
                ?>
                <?php
                echo "<a href='my_post.php?id_user=" . $id_user . "' class='btn'>My Post</a>";
                ?>
                <?php
                echo "<a href='../user/edit.php?id_user=" . $id_user . "' class='btn'>Change Profile</a>";
                ?>
                <a href="../index.php" class="btn">Log Out</a>
            </div>
        </div>
        <div>
            <?php
            $tmp = mysqli_query($conn, "select * from users where id = '$id_user'");
            if (mysqli_num_rows($tmp)) {
                $user = mysqli_fetch_assoc($tmp);
                echo "<h1>Hello, $user[username]</h1>";
            }
            ?>
        </div>
        <div>
            <form action="" method="GET">
                <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" />
                <input type="text" name="search" placeholder="Search..." />
                <input type="submit" value="Search" />
            </form>
        </div>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Context</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (isset($_GET['search'])) {
                        $title = mysqli_real_escape_string($conn, $_GET['search']);
                        $result = mysqli_query($conn, "Select title, context, posts.id as id_post from posts INNER JOIN users ON posts.user_id = users.id Where users.id = $id_user and posts.title LIKE '%$title%'");
                    }

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<th>" . $row['title'] . "</th>";
                            echo "<th>" . $row['context'] . "</th>";
                            echo "<th>";
                            echo "<a href='edit_post.php?id=" . $row['id_post'] . "&id_user=" . $id_user . "'class='btn'>Edit</a>";
                            echo "<a href='delete_post.php?id=" . $row['id_post'] . "&id_user=" . $id_user . "'class='btn'>Del</a>";
                            echo "</th>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

        </main>
    <?php } ?>
    </body>

    </html>