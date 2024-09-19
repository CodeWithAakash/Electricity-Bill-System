<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_escape_string($con, $_POST['email']);
    $password = mysqli_escape_string($con, $_POST['password']);
    $cpassword = mysqli_escape_string($con, $_POST['cpassword']);
    if ($password == $cpassword) {
        if (strlen($password) >= 5) {
            $query = "select * from user where email = '$email'";
            $exe_query = mysqli_query($con, $query);
            $num = mysqli_num_rows($exe_query);
            if ($num == 1) {
                echo 'Existing_User';
            } else {
                $hash_password = password_hash($password, PASSWORD_BCRYPT);
                $insq = "insert into user(`email`, `password`,`is_active`) values ('$email','$hash_password',0)";
                $exe_insq = mysqli_query($con, $insq);
                if ($exe_insq) {
                    echo 'Registered:' . $email;
                } else {
                    echo 'Failed';
                }
            }
        } else {
            echo 'Password_length';
        }
    } else {
        echo 'Incorrect_Password';
    }
}
