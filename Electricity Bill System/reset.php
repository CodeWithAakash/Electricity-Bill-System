<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $email = $_POST['email'];
    $token = $_POST['token'];

    if ($password == $cpassword) {
        if (strlen($password) >= 5) {
            $hash_password = password_hash($password, PASSWORD_BCRYPT);
            $upd = "update user set `password` = '$hash_password' where email = '$email' ";
            $exe_upd = mysqli_query($con, $upd);
            if ($exe_upd) {
                echo "Reset";
            } else {
                echo "Failed";
            }
        } else {
            echo "Length";
        }
    } else {
        echo "Password";
    }
}
