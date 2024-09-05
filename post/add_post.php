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
        <title>Post</title>
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
        <div class="container">
            <div class="box form-box ">
                <header>Add Post</header>
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $title = mysqli_real_escape_string($conn, $_POST['title']);
                    $context = mysqli_real_escape_string($conn, $_POST['context']);
                    $result = mysqli_query($conn, "Insert into posts (title, context, user_id) values('$title', '$context', '$id_user')");
                    if ($result) {
                        echo "<div>Add successfully</div><br>";
                        echo "<div><a href='my_post.php?id_user=" . $id_user . "' class='btn'>Go back</a></div>";
                    } else {
                        echo "<div>Failed, Try again!</div><br>";
                        echo "<div><a href='add_post.php?id_user=" . $id_user . "' class='btn'>Go back</a></div>";
                    }
                } else {
                ?>
                    <form action="" method="post">
                        <div class="field input">
                            <label for="title"><b>Title</b></label>
                            <input type="text" name="title" id="title" required />
                        </div>
                        <div class="field input">
                            <label for="context"><b>Context</b></label>
                            <input type="text" name="context" id="context" required />
                        </div>
                        <div class="field">
                            <input type="submit" class="btn" name="submit" value="Add" required />
                        </div>

                    </form>
                <?php } ?>
            </div>

        </div>
    </body>

    </html>

<?php } ?>