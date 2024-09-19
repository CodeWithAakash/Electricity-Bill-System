<?php
include 'config.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $token = $_POST['token'];

    $q = "select * from verify_user where email = '$email' and token = '$token'";
    $eq = mysqli_query($con, $q);
    $res_data = mysqli_fetch_assoc($eq);
    $dbtimestamp = $res_data['created_time'];
    $num = mysqli_num_rows($eq);

    $qry = "select TIMESTAMPDIFF(MINUTE,'$dbtimestamp',NOW()) as minute_difference from forgot where email = '$email'";
    $exe_q = mysqli_query($con, $qry);
    $q_data = mysqli_fetch_assoc($exe_q);
    $min =  $q_data['minute_difference'];

    if ($num == 0) {
        echo 'Link_Invalid';
    } else if ($min >= 5) {
        echo 'Link_Expired';
    } else {
        $q = "select is_active from user where email = '$email' ";
        $exe_q = mysqli_query($con, $q);
        $data = mysqli_fetch_assoc($exe_q);
        if ($data['is_active'] == 1) {
            echo 'Active';
        } else {
            $qy = "update user set is_active = 1 where email = '$email' ";
            $exe_qy = mysqli_query($con, $qy);
            if ($exe_qy) {
                echo 'Verified';
            } else {
                echo 'Failed';
            }
        }
    }
}
