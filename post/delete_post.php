<?php
include '../db.php';
session_start();
if (isset($_GET['id'])) {
    $id_user = (int)$_GET['id_user'];
    $id = (int)$_GET['id'];
    $result = mysqli_query($conn, "Delete from posts where id = '$id'");
    if ($result) {
        header("Location: my_post.php?id_user=" . $id_user);
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
