<?php
include '../db.php';
session_start();

if (isset($_GET['id_admin'])) {
    $id = (int)$_GET['id'];
    $id_admin = (int)$_GET['id_admin'];
    $req = mysqli_query($conn, "Delete from users where id = '$id'");
    if ($req) {
        header("Location: admin.php?id_admin=" . $id_admin);
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
