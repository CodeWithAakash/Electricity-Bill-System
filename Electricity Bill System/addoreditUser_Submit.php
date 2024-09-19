<?php
include 'config.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $floor = $_POST['floor'];
    $current_unit = $_POST['current_unit'];
    $rent = $_POST['rent'];
    $rupee_per_unit = $_POST['rupee_per_unit'];
    $water_unit = $_POST['water_unit'];
    $phone = $_POST['phone'];

    if (isset($_POST['edit_phoneid'])) {
        $edit_phoneid = $_POST['edit_phoneid'];
    }

    if (strlen($phone) == 10) {
        if (isset($_POST['edit_phoneid'])) {
            $fdp_query = "select count(*) as d_count from bill where phone = '$phone' and user_id = '$user_id' and '$phone' != '$edit_phoneid' ";
            $exe_fdp_query = mysqli_query($con, $fdp_query);
            $d_data = mysqli_fetch_assoc($exe_fdp_query);
            $d_data_count = $d_data['d_count'];

            if ($d_data_count > 0) {
                echo 'Duplicate';
            } else {
                $fh_qy = "select * from history where phone = '$edit_phoneid' and user_id='$user_id' limit 1";
                $exe_fh_qy = mysqli_query($con, $fh_qy);
                $fh_num = mysqli_num_rows($exe_fh_qy);

                if ($fh_num > 0) {
                    $upd_query = "update bill set `name`='$name',`floor`='$floor',`rent`='$rent',`water_unit`='$water_unit',`rupee_per_unit`='$rupee_per_unit',`phone`='$phone' where phone = '$edit_phoneid' and user_id='$user_id' ";
                    $exe_upd_query = mysqli_query($con, $upd_query);
                } else {
                    $upd_query = "update bill set `name`='$name',`floor`='$floor',`rent`='$rent',`current_unit`='$current_unit',`water_unit`='$water_unit',`rupee_per_unit`='$rupee_per_unit',`phone`='$phone' where phone = '$edit_phoneid' and user_id='$user_id' ";
                    $exe_upd_query = mysqli_query($con, $upd_query);
                }

                $updhis_query = "update history set `name`='$name',`floor`='$floor',`phone`='$phone' where phone = '$edit_phoneid' and user_id='$user_id'";
                $exe_updhis_query = mysqli_query($con, $updhis_query);
                if ($exe_upd_query && $exe_updhis_query) {
                    echo 'Updated';
                } else {
                    echo 'Failed';
                }
            }
        } else {
            $query = "select count(*) as row_count from bill where user_id = '$user_id' and phone = '$phone'";
            $exe_query = mysqli_query($con, $query);
            $data = mysqli_fetch_assoc($exe_query);
            if ($data['row_count'] == 1) {
                echo 'Duplicate';
            } else {
                $ins_query = "insert into bill(`user_id`, `name`, `floor`, `rent`, `current_unit`, `water_unit`, `rupee_per_unit`, `phone`) VALUES ('$user_id','$name','$floor','$rent','$current_unit','$water_unit','$rupee_per_unit','$phone');";
                $exe_ins_query = mysqli_query($con, $ins_query);
                if ($exe_ins_query) {
                    echo 'Inserted';
                } else {
                    echo 'Failed';
                }
            }
        }
    } else {
        echo 'Phone_len';
    }
}