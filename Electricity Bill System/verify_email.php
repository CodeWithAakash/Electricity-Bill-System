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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>UserVerification</title>
</head>

<body class="bg-dark">

</body>

<script>
    $(document).ready(function() {
        $.ajax({
            url: 'verify.php',
            type: 'POST',
            data: {
                email: '<?php echo $email; ?>',
                token: '<?php echo $token; ?>',
            },
            success: function(response) {
                if (response == "Verified") {
                    Swal.fire({
                        icon: "success",
                        title: "Wow...",
                        text: "Email Verified Successfully",
                        allowOutsideClick: false,
                    }).then(() => {
                        window.location.href = "index.php";
                    })
                } else if (response == "Failed") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Can't Process your Request!!!",
                        allowOutsideClick: false,
                    }).then(() => {
                        window.location.href = "index.php";
                    })
                } else if (response == "Link_Invalid") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Link is Invalid!!!",
                        allowOutsideClick: false,
                    }).then(() => {
                        window.location.href = "index.php";
                    })
                } else if (response == "Link_Expired") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Link is Expired/Invalid !!!",
                        allowOutsideClick: false,
                    }).then(() => {
                        window.location.href = "index.php";
                    })
                } else if (response == "Active") {
                    Swal.fire({
                        icon: "warning",
                        title: "Ohh...",
                        text: "Email already Verified !!!",
                        allowOutsideClick: false,
                    }).then(() => {
                        window.location.href = "index.php";
                    })
                }
            }
        });
    });
</script>

</html>