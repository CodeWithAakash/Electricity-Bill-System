<?php
include 'config.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pid = $_POST['pid'];
    $email = $_SESSION['email'];
    $user_id = $_SESSION['user_id'];
    $del_query = "delete from bill where phone = '$pid' and user_id = '$user_id' ";
    $exe_del_query = mysqli_query($con, $del_query);

    $his_query = "delete from history where phone='$pid' and user_id = '$user_id' ";
    $exe_his_query = mysqli_query($con, $his_query);
    if ($exe_del_query && $exe_his_query) {
        echo 'Deleted';
    } else {
        echo 'Failed';
    }
}
