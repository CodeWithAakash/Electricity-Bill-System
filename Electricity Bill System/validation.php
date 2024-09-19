<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_escape_string($con, $_POST['email']);
    $password = mysqli_escape_string($con, $_POST['password']);
    $query = "select * from user where email = '$email'";
    $exe_query = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($exe_query);
    $num = mysqli_num_rows($exe_query);
    if ($num == 1) {
        $user_password = $data['password'];
        $id = $data['id'];
        if ($data['is_active'] == 1) {
            if (password_verify($password, $user_password)) {
                session_start();
                $_SESSION['user_id'] = $id;
                $_SESSION['email'] = $email;
                echo 'Success';
            } else {
                echo 'Password_Failed';
            }
        } else {
            echo 'Verify:' . $email;
        }
    } else {
        echo 'Email_Failed';
    }
}
