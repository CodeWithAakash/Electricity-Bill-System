<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

</html>
<?php
include 'config.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
$email = $_SESSION['email'];
$user = str_replace('@gmail.com', '', $email);
$user_id = $_SESSION['user_id'];

if (isset($_GET['phone'])) {
    $phone_id = $_GET['phone'];
    $fquery = "select * from bill where user_id = '$user_id' and phone = '$phone_id'";
    $exe_fquery = mysqli_query($con, $fquery);
    $fdata = mysqli_fetch_assoc($exe_fquery);
    if ($fdata['phone'] == "") {
?>
<script>
window.location.href = "homepage.php";
</script>
<?php
    }
} else if (isset($_GET['edit'])) {
    $his_id = $_GET['edit'];
    $f_query = "select * from history where history_id = '$his_id' and user_id = '$user_id' ";
    $exe_f_query = mysqli_query($con, $f_query);
    $fdata = mysqli_fetch_assoc($exe_f_query);
    if ($fdata['phone'] == "") {
    ?>
<script>
window.location.href = "homepage.php";
</script>
<?php
    }
} else {
    $fdata = array("id" => "", "name" => "", "floor" => "", "current_unit" => "", "rent" => "", "rupee_per_unit" => "", "water_unit" => "", "phone" => "");
    ?>
<script>
window.location.href = "homepage.php";
</script>
<?php
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    input[type=checkbox]:checked {
        color: #fff;
        background-color: #dc3545;
    }

    .form-switch .form-check-input {
        width: 40px !important;
        height: 25px !important;
    }
    </style>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>CreateOrEditBill</title>
</head>

<body>
    <nav class="navbar navbar mb-4">
        <div class="container-fluid">
            <button class="navbar-brand btn btn-danger" onclick="window.location.href='homepage.php';">Back</button>

            <div class="d-flex pt-2 pb-2">
                <p style="color: white; margin-bottom: 0 !important; font-size: 17px; font-weight: 600;"><i
                        class="fa fa-user" style="border-radius: 50%; padding: 5px; background: crimson;"></i> Hi,
                    <?php echo $user; ?></p>
            </div>
        </div>
        </div>
    </nav>

    <div class="add-edit-container container">
        <div id="formdiv" class="m-auto" style="width: 350px;">
            <div class="title">
                <?php
                if (isset($_GET['edit'])) {
                ?>
                <h4 class="text-light" style="font-weight: 700;">Edit Kirayedar Bill</h4>
                <?php
                } else {
                ?>
                <h4 class="text-light" style="font-weight: 700;">Create Kirayedar Bill</h4>
                <?php
                }
                ?>
                <hr class="text-light">
                <h6 class="text-light">Previous Reading :
                    <?php if (isset($_GET['edit'])) {
                        echo $fdata['previous_unit'];
                    } else {
                        echo $fdata['current_unit'];
                    } ?>
                </h6>
                <hr class="text-light">
            </div>
            <form action="" id="createoreditBill" method="" class="mx-auto pb-5">

                <div class="field mb-3">
                    <label for="name" class="form-label text-light">Kirayedar Name</label>
                    <div class="input-field">
                        <i class="fa fa-user fa-fw"></i>
                        <input type="name" class="form-control border-3" id="name" name="name"
                            value="<?php echo $fdata['name']; ?>" aria-describedby="nameHelp"
                            placeholder="Enter Kirayedar Name" required readonly>

                    </div>
                </div>

                <div class="field mb-3" <?php if (isset($_GET['edit'])) {
                                            echo 'hidden';
                                        } ?>>
                    <label class="form-check-label text-light" for="checkbox">Enable Field : </label>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="checkbox">
                    </div>
                </div>

                <div class="field mb-3">
                    <label for="rent" class="form-label text-light">Rent</label>
                    <div class="input-field">
                        <i class="fa fa-rupee-sign fa-fw"></i>
                        <input type="number" min="0" class="readonlyfield form-control border-3" name="rent" id="rent"
                            value="<?php echo $fdata['rent']; ?>" placeholder="Enter Rent Amount" required <?php if (!isset($_GET['edit'])) {
                                                                                                                echo 'readonly';
                                                                                                            } ?>>

                    </div>
                </div>

                <div class="field mb-3">
                    <label for="rupee_per_unit" class="form-label text-light">Rupees/Unit</label>
                    <div class="input-field">
                        <i class="fa fa-rupee-sign fa-fw"></i>
                        <input type="text" min="1" class="readonlyfield form-control border-3" name="rupee_per_unit"
                            id="rupee_per_unit" value="<?php echo $fdata['rupee_per_unit']; ?>"
                            placeholder="Enter Rent/Unit" required <?php if (!isset($_GET['edit'])) {
                                                                        echo 'readonly';
                                                                    } ?>>

                    </div>
                </div>
                <div class="field mb-3">
                    <label for="water_unit" class="form-label text-light">Water Reading</label>
                    <div class="input-field">
                        <i class="fa fa-droplet fa-fw"></i>
                        <input type="number" min="0" class="readonlyfield form-control border-3" name="water_unit"
                            id="water_unit" value="<?php echo $fdata['water_unit']; ?>"
                            placeholder="Enter Water Reading" required <?php if (!isset($_GET['edit'])) {
                                                                            echo 'readonly';
                                                                        } ?>>

                    </div>
                </div>

                <div class="field mb-3">
                    <label for="latest_unit" class="form-label text-light">Latest Reading</label>
                    <div class="input-field">
                        <i class="fa fa-plug fa-fw"></i>
                        <input type="number" class="form-control border-3" name="latest_unit" id="latest_unit"
                            value="<?php if (isset($_GET['edit'])) {
                                                                                                                            echo $fdata['current_unit'];
                                                                                                                        } ?>" placeholder="Enter Latest Reading" required>

                    </div>
                </div>

                <div class="field mb-3">
                    <label for="date" class="form-label text-light">Date</label>
                    <div class="input-field">
                        <i class="fa fa-calendar fa-fw"></i>
                        <input type="date" class="form-control border-3" name="date" id="date" value="<?php if (isset($_GET['edit'])) {
                                                                                                            echo $fdata['bill_date'];
                                                                                                        } ?>" required>

                    </div>
                </div>

                <button type="submit" class="btn btn-danger ark w-100" style="font-size: 18px;">
                    <?php
                    if (isset($_GET['edit'])) {
                        echo 'Edit Bill';
                    } else {
                        echo 'Create Bill';
                    }
                    ?>
                </button>
            </form>
        </div>
    </div>

</body>

<script>
$(document).ready(function() {
    $('#checkbox').click(function() {
        if (this.checked) {
            $('.readonlyfield').removeAttr("readonly");
        } else {
            $('.readonlyfield').attr("readonly", true);
        }
    })
});

$(document).ready(function() {
    $('#createoreditBill').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = $(this).serialize();
        <?php
            if (isset($_GET['edit'])) {
            ?>
        formData +=
            '&previous_unit=<?php echo $fdata['previous_unit'] ?>&phone=<?php echo $fdata['phone']; ?>&hisid=<?php echo $fdata['history_id']; ?>&billid=<?php echo $fdata['bill_id']; ?>';

        <?php
            } else {
            ?>
        formData +=
            '&floor=<?php echo $fdata['floor']; ?>&previous_unit=<?php echo $fdata['current_unit'] ?>&phone=<?php echo $fdata['phone']; ?>&billid=<?php echo $fdata['bill_id']; ?>';

        <?php
            }
            ?>
        $.ajax({
            url: 'createoreditBill_Submit.php',
            type: 'POST',
            data: formData,
            success: function(res) {
                if (res == "Reading") {
                    Swal.fire({
                        icon: "warning",
                        title: "Oops...",
                        text: "Latest Reading must be Greated than Previous Reading...",
                    });
                } else if (res == "Failed") {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Failed to Process your Request!!!",
                    }).then(() => {
                        window.location.href = "homepage.php";
                    })
                } else {
                    window.location.replace("slip.php?Created=" + res);
                }


            }
        });
    });
});
</script>

</html>