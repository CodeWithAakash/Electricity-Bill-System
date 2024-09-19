<?php
$rdir = str_replace("\\", "/", __DIR__);
require $rdir . '/PHPMailer/src/Exception.php';
require $rdir . '/PHPMailer/src/PHPMailer.php';
require $rdir . '/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'config.php';

    $forgot_email = $_POST['forgot_email'];
    $OTP = rand(10000, 99999);
    $token = password_hash($OTP, PASSWORD_BCRYPT);
    $link = "http://localhost/aakash/Electricity%20Bill%20System/reset_password.php?email=$forgot_email&token=$token";

    $q = "select id,email,is_active from user where  email = '$forgot_email' ";
    $result = mysqli_query($con, $q);
    $data = mysqli_fetch_assoc($result);
    $id = $data['id'];
    $num = mysqli_num_rows($result);

    if ($num == 1) {
        if ($data['is_active'] == 1) {
            $fq = "select * from forgot where email = '$forgot_email' ";
            $exe_fq = mysqli_query($con, $fq);
            if (mysqli_num_rows($exe_fq) > 0) {
                $uy = "UPDATE `forgot` SET `token`='$token',`created_time`=NOW() WHERE email = '$forgot_email' ";
                $res = mysqli_query($con, $uy);
            } else {
                $qy = "insert into forgot(`user_id`,`email`,`token`,`created_time`) values ('$id','$forgot_email','$token',NOW())";
                $res = mysqli_query($con, $qy);
            }

            if ($res) {

                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'aakashpc203201@gmail.com';
                    $mail->Password   = 'krrvgvkzaycfoxbd';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port       = 465;

                    $mail->setFrom('aakashpc203201@gmail.com');
                    $mail->addAddress($forgot_email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Forgot Password!!! - Here is Password Reset Link.';
                    $msg = '<html><body>';
                    $msg .= "<h3>Hi, Here is your Password Reset Link - </h3>";
                    $msg .= "<p>Link - $link</p>";
                    $msg .= "<p>Link is Valid for next 5 min..</p>";
                    $msg .= '</body></html>';
                    $mail->Body    = $msg;
                    $mail->AltBody = 'Hi, Here is your Password Reset Link -  ' . $link . ' Link is Valid for next 5 min..';

                    $mail->send();
                    echo 'Mail_send';
                } catch (Exception $e) {
                    echo 'Mail_failed';
                }
            }
        } else {
            echo 'Verify:' . $data['email'];
        }
    } else {
        echo 'Failed';
    }
}
