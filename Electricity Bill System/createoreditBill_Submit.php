<?php
include 'config.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['hisid'])) {
        $billid = $_POST['billid'];
        $hisid = $_POST['hisid'];
        $rent = $_POST['rent'];
        $latest_unit = $_POST['latest_unit'];
        $previous_unit = $_POST['previous_unit'];
        $water_unit = $_POST['water_unit'];
        $rupee_per_unit = $_POST['rupee_per_unit'];
        $date = $_POST['date'];
        $phone = $_POST['phone'];
        $total_units = ($latest_unit - $previous_unit) + $water_unit;
        $units_cost = floor($total_units * $rupee_per_unit);
        $amount = $units_cost + $rent;

        if ($latest_unit <= $previous_unit) {
            echo 'Reading';
        } else {

            $fh_qy = "select history_id from history where bill_id = '$billid' and user_id='$user_id' order by history_id desc limit 1";
            $exe_fh_qy = mysqli_query($con, $fh_qy);
            $fh_rows = mysqli_fetch_assoc($exe_fh_qy);
            $fh_data = $fh_rows['history_id'];
            if ($fh_data === $hisid) {

                $his_query = "UPDATE `history` SET `rent`='$rent',`current_unit`='$latest_unit',`water_unit`='$water_unit',`rupee_per_unit`='$rupee_per_unit',`bill_date`='$date',`bill_amount`='$amount' where history_id = '$hisid' ";

                $exe_his_query = mysqli_query($con, $his_query);

                $upd_query = "UPDATE `bill` SET `current_unit`='$latest_unit' WHERE phone = '$phone' and user_id = '$user_id' ";

                $exe_upd_query = mysqli_query($con, $upd_query);

                if ($exe_his_query && $exe_upd_query) {
                    echo $hisid;
                } else {
                    echo 'Failed';
                }
            } else {
                echo 'Failed';
            }
        }
    } else {
        $billid = $_POST['billid'];
        $name = $_POST['name'];
        $rent = $_POST['rent'];
        $floor = $_POST['floor'];
        $latest_unit = $_POST['latest_unit'];
        $previous_unit = $_POST['previous_unit'];
        $water_unit = $_POST['water_unit'];
        $rupee_per_unit = $_POST['rupee_per_unit'];
        $date = $_POST['date'];
        $phone = $_POST['phone'];
        $total_units = ($latest_unit - $previous_unit) + $water_unit;
        $units_cost = floor($total_units * $rupee_per_unit);
        $amount = $units_cost + $rent;

        if ($latest_unit <= $previous_unit) {
            echo 'Reading';
        } else {
            $his_query = "INSERT INTO `history`(`user_id`, `bill_id`, `name`, `floor`, `rent`, `current_unit`, `previous_unit`, `water_unit`, `rupee_per_unit`, `phone`, `bill_date`, `bill_amount`) VALUES ('$user_id','$billid','$name','$floor','$rent','$latest_unit','$previous_unit','$water_unit','$rupee_per_unit','$phone','$date','$amount')";

            $exe_his_query = mysqli_query($con, $his_query);

            $upd_query = "UPDATE `bill` SET `current_unit`='$latest_unit' WHERE phone = '$phone' and user_id = '$user_id' ";

            $exe_upd_query = mysqli_query($con, $upd_query);

            if ($exe_his_query && $exe_upd_query) {
                $hid_query = "select history_id from history where bill_id = '$billid' and user_id = '$user_id' and phone = '$phone' order by history_id desc limit 1";
                $exe_hid_query = mysqli_query($con, $hid_query);
                $hid_data = mysqli_fetch_assoc($exe_hid_query);
                echo $hid_data['history_id'];
            } else {
                echo 'Failed';
            }
        }
    }
}