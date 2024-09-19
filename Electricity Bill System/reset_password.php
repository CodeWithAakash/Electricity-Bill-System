<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

</html>

<?php
include 'config.php';
if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    $q = "select * from forgot where email = '$email' and token = '$token'";
    $eq = mysqli_query($con, $q);
    $res_data = mysqli_fetch_assoc($eq);
    $dbtimestamp = $res_data['created_time'];
    $num = mysqli_num_rows($eq);

    $qry = "select TIMESTAMPDIFF(MINUTE,'$dbtimestamp',NOW()) as minute_difference from forgot where email = '$email'";
    $exe_q = mysqli_query($con, $qry);
    $q_data = mysqli_fetch_assoc($exe_q);
    $min =  $q_data['minute_difference'];

    if ($num == 0) {
?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Link is Invalid!!!",
            }).then(() => {
                window.location.href = "index.php";
            })
        </script>
    <?php
    } else if ($min >= 5) {
    ?>
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Link is Expired/Invalid !!!",
            }).then(() => {
                window.location.href = "index.php";
            })
        </script>
    <?php
    }
} else {
    ?>
    <script>
        Swal.fire({
            icon: "error",
            title: "Oops...",
            text: "Link is Invalid!!!",
        }).then(() => {
            window.location.href = "index.php";
        })
    </script>
<?php
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>ResetPassword</title>
</head>

<body class="bg-dark">
    <div class="add-edit-container container mt-5">
        <div class="bg-dark">
            <div id="formdiv" class="m-auto pb-3 text-white" style="width: 350px;">
                <div class="title">
                    <h4 style="font-weight: 700;">Reset Password</h4>
                    <hr>
                </div>
                <form id="reset_password" action="">
                    <div>
                        <div class="field">
                            <label for="password" class="form-label text-light">Password</label>
                            <div class="input-field">
                                <i class="fa fa-key fa-fw"></i>
                                <i data-target="resetpassword" class="toggle fa fa-eye fa-fw"></i>
                                <input type="password" class="form-control border-3" name="password" id="resetpassword" placeholder="Enter Password" style="padding-right:30px !important;" required>
                            </div>
                        </div>
                        <div class="field">
                            <label for="password" class="form-label text-light">Confirm Password</label>
                            <div class="input-field">
                                <i class="fa fa-key fa-fw"></i>
                                <i data-target="cresetpassword" class="toggle fa fa-eye fa-fw"></i>
                                <input type="password" class="form-control border-3" name="cpassword" id="cresetpassword" placeholder="Confirm Password" style="padding-right:30px !important;" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-danger mt-3 w-100 fs-5">Submit</button>
                </form>
            </div>

        </div>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggles = document.querySelectorAll('.toggle');
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const targetInput = document.getElementById(targetId);
                if (targetInput.type === 'password') {
                    targetInput.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    targetInput.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            })
        })
    })
</script>
<script>
    $(document).ready(function() {
        $('#reset_password').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = $(this).serialize();
            formData += '&email=<?php echo $email ?>&token=<?php echo $token ?>';
            $.ajax({
                url: 'reset.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response == "Reset") {
                        Swal.fire({
                            icon: "success",
                            title: "Wow...",
                            text: "Password Reset Successfully...",
                        }).then(() => {
                            window.location.href = "index.php";
                        })
                    } else if (response == "Length") {
                        Swal.fire({
                            icon: "warning",
                            title: "Oops...",
                            text: "Password length should be 5 or More!",
                        })
                    } else if (response == "Password") {
                        Swal.fire({
                            icon: "warning",
                            title: "Oops...",
                            text: "Password does not Match!!!",
                        })
                    } else if (response == "Failed") {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Can't Process your Request!!!",
                        })
                    }
                }
            });
        });
    });
</script>

</html>