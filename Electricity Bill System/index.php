<?php
if (isset($_POST['newUser'])) {
    $islogin = false;
} else {
    $islogin = true;
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="papa.jpeg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Dashboard</title>

</head>

<body class="bg-dark text-white">

    <div class="mycontainer-div container mt-5 bg-danger" style="padding: 20px 0px 0px 0px !important;">
        <h5 class="text-center" style="font-weight: bold;">Electricity Bill Dashboard</h5>
        <div class="image m-auto d-flex justify-content-center" style="width: 100%; border-radius: 5px;">
            <div class="image-div">
            </div>
        </div>
        <?php
        if ($islogin == true) {
        ?>
        <div id="formdiv" class="m-auto p-3 bg-light mt-3" style="width: 100% !important; border-radius:5px;">
            <div class="title">
                <h4 class="text-dark" style="font-weight: 700; font-size: 28px;">Login Form</h4>
            </div>
            <form action="" id="loginForm" method="" class="mx-auto">
                <div class="field mb-3">
                    <label for="email" class="form-label text-dark">Email address</label>
                    <div class="input-field">
                        <i class="fa fa-user fa-fw"></i>
                        <input type="email" class="form-control border-2 border-danger" id="email" name="email"
                            aria-describedby="emailHelp" placeholder="Enter your email" required>
                    </div>
                </div>
                <div class="field">
                    <label for="loginpassword" class="form-label text-dark">Password</label>
                    <div class="input-field">
                        <i class="fa fa-key fa-fw"></i>
                        <i data-target="loginpassword" class="toggle fa fa-eye fa-fw"></i>
                        <input type="password" class="form-control border-2 border-danger" name="password"
                            id="loginpassword" placeholder="Enter Password" style="padding-right:30px !important;"
                            required>
                    </div>
                </div>
                <div class="field d-flex justify-content-end" style="margin: 10px 0px !important;">
                    <button type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#forgot_passworf"
                        style="background:transparent; color: black; text-decoration:none !important; border:none;">Forgot
                        Password?</button>
                </div>
                <button type="submit" class="btn btn-danger w-100" style="font-size: 18px;">Login</button>
            </form>
            <form method="POST" class="text-center mt-3 text-dark">
                New User? <button class="bg-transparent text-dark" style="border:none;" name="newUser">Register
                    Now</button>
            </form>

            <!-- Forgot Modal -->
            <div class="modal fade" id="forgot_passworf" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="forgot_passworfLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title text-dark" id="forgot_passworfLabel">Forgot Password?</h5>
                        </div>
                        <div id="forgot_email_form">
                            <form action="" id="forgot_password">
                                <div class="modal-body">
                                    <div class="field mb-3">
                                        <label for="email" class="form-label text-dark">Email address</label>
                                        <div class="input-field">
                                            <i class="fa fa-user fa-fw"></i>
                                            <input type="email" class="form-control border-1 border-danger"
                                                id="forgot_email" name="forgot_email" aria-describedby="emailHelp"
                                                placeholder="Enter your Email ID" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="forgot_close" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Get Link</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <?php
        } else {
            ?>
            <div id="formdiv" class="m-auto p-3 bg-light mt-3" style="width: 100% !important; border-radius:5px;">
                <div class="title">
                    <h4 class="text-dark" style="font-weight: 700; font-size:28px;">Signup Form</h4>
                </div>
                <form id="signupForm" method="" action="" class="mx-auto">
                    <div class="field mb-3">
                        <label for="exampleInputEmail1" class="form-label text-dark">Email address</label>
                        <div class="input-field">
                            <i class="fa fa-user fa-fw"></i>
                            <input type="email" name="email" class="form-control border-1 border-danger"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email"
                                required>
                        </div>
                    </div>
                    <div class="field mb-3">
                        <label for="password" class="form-label text-dark">Password</label>
                        <div class="input-field">
                            <i class="fa fa-lock fa-fw"></i>
                            <i data-target="password" class="toggle fa fa-eye fa-fw"></i>
                            <input type="password" name="password" class="form-control border-1 border-danger"
                                id="password" placeholder="Enter Password" style="padding-right:30px !important;"
                                required>
                        </div>
                    </div>
                    <div class="field mb-3">
                        <label for="cpassword" class="form-label text-dark">Confirm-Password</label>
                        <div class="input-field">
                            <i class="fa fa-lock fa-fw"></i>
                            <i data-target="cpassword" class="toggle fa fa-eye fa-fw"></i>
                            <input type="password" name="cpassword" class="form-control border-1 border-danger"
                                id="cpassword" placeholder="Re-Enter Password" style="padding-right:30px !important;"
                                required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger w-100" name="newUser"
                        style="font-size: 18px;">Signup</button>
                </form>
                <form method="POST" class="text-center mt-3 text-dark">
                    Existing User? <button class="bg-transparent text-dark" style="border:none;"
                        name="existingUser">Login
                        Now</button>
                </form>
            </div>
            <?php
        }
            ?>

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
    $('#loginForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = $(this).serialize();
        $.ajax({
            url: 'validation.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response == "Success") {
                    Swal.fire({
                        icon: "success",
                        text: "Login Successfully...",
                        showConfirmButton: false,
                        timer: 1500,

                    }).then(() => {
                        window.location.href = 'homepage.php';
                    })
                } else if (response == "Password_Failed") {
                    Swal.fire({
                        icon: "error",
                        text: "Oops...",
                        text: "Invalid Password Credential!"
                    })
                } else if (response.indexOf("Verify") !== -1) {
                    Swal.fire({
                        icon: "warning",
                        text: "Ohh..",
                        text: "Email Verification Pending !!!",
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonColor: "#7066e0",
                        cancelButtonColor: "#6c757d",
                        cancelButtonText: "Later",
                        confirmButtonText: "Verify"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Validating...",
                                text: "Validating your Email to Process your Request...",
                                timerProgressBar: true,
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            })
                            var userEmail = response.replace(
                                'Verify:',
                                '');
                            $.ajax({
                                url: 'getVerifyEmailLink.php',
                                type: 'POST',
                                data: {
                                    emailId: userEmail
                                },
                                success: function(response) {
                                    Swal.close();
                                    if (response ==
                                        "Mail_send") {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Wow..",
                                            text: "Email Verification Link sent successfully to your Mail...",
                                            allowOutsideClick: false,
                                        }).then(() => {
                                            window.location
                                                .href =
                                                "index.php";
                                        })
                                    } else if (response ==
                                        "Mail_failed") {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Failed!!!",
                                            text: "Failed to send Email Verification Link!!!",
                                        }).then(() => {
                                            window.location
                                                .href =
                                                "index.php";
                                        });
                                    } else if (response ==
                                        "Failed") {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "Email is not Registered!!!",
                                        }).then(() => {
                                            window.location
                                                .href =
                                                "index.php";
                                        })
                                    }
                                }
                            })
                        }
                    });
                } else {

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Invalid Email ID!",
                    });

                }
            }
        });
    });
});

$(document).ready(function() {
    $('#forgot_password').submit(function(e) {
        Swal.fire({
            title: "Validating...",
            text: "Validating your Email to Process your Request...",
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        })
        e.preventDefault();
        var form = $(this);
        var formData = $(this).serialize();
        $.ajax({
            url: 'getLink.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                Swal.close();
                if (response == "Mail_send") {
                    Swal.fire({
                        icon: "success",
                        title: "Wow..",
                        text: "Reset Link sent successfully to your Mail...",
                        allowOutsideClick: false,
                    }).then(() => {
                        document.getElementById('forgot_close').click();
                    })
                } else if (response == "Mail_failed") {
                    Swal.fire({
                        icon: "error",
                        title: "Failed!!!",
                        text: "Failed to send Reset Link Mail!!!",
                    })
                } else if (response == "Failed") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Email is not Registered!!!",
                    })
                } else if (response.indexOf("Verify") !== -1) {
                    Swal.fire({
                        icon: "warning",
                        text: "Ohh..",
                        text: "Email Verification Pending !!!",
                        allowOutsideClick: false,
                        showCancelButton: true,
                        confirmButtonColor: "#7066e0",
                        cancelButtonColor: "#6c757d",
                        cancelButtonText: "Later",
                        confirmButtonText: "Verify"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire({
                                title: "Validating...",
                                text: "Validating your Email to Process your Request...",
                                timerProgressBar: true,
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            })
                            var userEmail = response.replace(
                                'Verify:',
                                '');
                            $.ajax({
                                url: 'getVerifyEmailLink.php',
                                type: 'POST',
                                data: {
                                    emailId: userEmail
                                },
                                success: function(response) {
                                    Swal.close();
                                    if (response ==
                                        "Mail_send") {
                                        Swal.fire({
                                            icon: "success",
                                            title: "Wow..",
                                            text: "Email Verification Link sent successfully to your Mail...",
                                            allowOutsideClick: false,
                                        }).then(() => {
                                            window.location
                                                .href =
                                                "index.php";
                                        })
                                    } else if (response ==
                                        "Mail_failed") {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Failed!!!",
                                            text: "Failed to send Email Verification Link!!!",
                                        }).then(() => {
                                            window.location
                                                .href =
                                                "index.php";
                                        });
                                    } else if (response ==
                                        "Failed") {
                                        Swal.fire({
                                            icon: "error",
                                            title: "Oops...",
                                            text: "Email is not Registered!!!",
                                        }).then(() => {
                                            window.location
                                                .href =
                                                "index.php";
                                        })
                                    }
                                }
                            })
                        }
                    });
                }
            }
        })
    })
})


$(document).ready(function() {
    $('#signupForm').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = $(this).serialize();
        $.ajax({
            url: 'registeration.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                if (response.indexOf("Registered") !== -1) {
                    Swal.fire({
                        icon: "success",
                        title: "Wow...",
                        text: "User Registered Successfully!",
                        allowOutsideClick: false,
                    }).then(() => {
                        Swal.fire({
                            icon: "warning",
                            title: "Verify Email!",
                            text: "Verify your Email ID to Access your Account!",
                            allowOutsideClick: false,
                            showCancelButton: true,
                            confirmButtonColor: "#7066e0",
                            cancelButtonColor: "#6c757d",
                            cancelButtonText: "Later",
                            confirmButtonText: "Verify"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.fire({
                                    title: "Validating...",
                                    text: "Validating your Email to Process your Request...",
                                    timerProgressBar: true,
                                    allowOutsideClick: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                })
                                var userEmail = response.replace(
                                    'Registered:',
                                    '');
                                $.ajax({
                                    url: 'getVerifyEmailLink.php',
                                    type: 'POST',
                                    data: {
                                        emailId: userEmail
                                    },
                                    success: function(response) {
                                        Swal.close();
                                        if (response ==
                                            "Mail_send") {
                                            Swal.fire({
                                                icon: "success",
                                                title: "Wow..",
                                                text: "Email Verification Link sent successfully to your Mail...",
                                                allowOutsideClick: false,
                                            }).then(() => {
                                                window
                                                    .location
                                                    .href =
                                                    "index.php";
                                            });
                                        } else if (response ==
                                            "Mail_failed") {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Failed!!!",
                                                text: "Failed to send Email Verification Link!!!",
                                            }).then(() => {
                                                window
                                                    .location
                                                    .href =
                                                    "index.php";
                                            });
                                        } else if (response ==
                                            "Failed") {
                                            Swal.fire({
                                                icon: "error",
                                                title: "Oops...",
                                                text: "Email is not Registered!!!",
                                            }).then(() => {
                                                window
                                                    .location
                                                    .href =
                                                    "index.php";
                                            })
                                        }
                                    }
                                })
                            }
                        });
                    })
                } else if (response == "Existing_User") {

                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Email ID already Taken!!!",
                    });

                } else if (response == "Incorrect_Password") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Password does not Match!!!",
                    });
                } else if (response == "Password_length") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Password length should be 5 or More!",
                    });
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Can't Register Now!!!",
                    });
                }
            }
        })
    })
})
</script>

</html>