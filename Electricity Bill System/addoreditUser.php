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
$user_id = $_SESSION['user_id'];
$user = str_replace('@gmail.com', '', $email);
if (isset($_GET['edit'])) {
    $edit_phoneid = $_GET['edit'];
    $query = "select * from bill where phone = '$edit_phoneid' && user_id = '$user_id'";
    $exe_query = mysqli_query($con, $query);

    $his_exist = "select count(*) as his_count from history where phone = '$edit_phoneid' and user_id = '$user_id'";
    $exe_his_exist = mysqli_query($con, $his_exist);
    $his_data = mysqli_fetch_assoc($exe_his_exist);
    $his_count = $his_data['his_count'];

    $edit_data = mysqli_fetch_assoc($exe_query);
    if ($edit_data['phone'] == "") {
?>
        <script>
            window.location.href = "homepage.php";
        </script>
<?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>AddOrEditUser</title>

</head>

<body>
    <nav class="navbar navbar mb-4">
        <div class="container-fluid">
            <button class="navbar-brand btn btn-danger" onclick="window.location.href='homepage.php';">Back</button>

            <div class="d-flex pt-2 pb-2">
                <p style="color: white; margin-bottom: 0 !important; font-size: 17px; font-weight: 600;"><i class="fa fa-user" style="border-radius: 50%; padding: 5px; background: crimson;"></i> Hi,
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
                    <h4 class="text-light" style="font-weight: 700;">Edit Kirayedar</h4>
                <?php
                } else {
                ?>
                    <h4 class="text-light" style="font-weight: 700;">Add Kirayedar</h4>
                <?php
                }
                ?>
            </div>
            <form action="" id="addoreditUser" method="" class="mx-auto pb-5">
                <?php
                if (isset($_GET['edit'])) {
                ?>
                    <div class="field mb-3" hidden>
                        <label for="edit_phoneid" class="form-label text-light">Edit_PhoneID</label>
                        <div class="input-field">
                            <i class="fa fa-phone-volume fa-fw"></i>
                            <input type="tel" class="form-control border-3" name="edit_phoneid" id="edit_phoneid" value="<?php if (isset($_GET['edit'])) {
                                                                                                                                echo $edit_data['phone'];
                                                                                                                            } ?>" placeholder="Enter Kirayedar Phone no" readonly>

                        </div>
                    </div>
                <?php
                }
                ?>
                <div class="field mb-3">
                    <label for="name" class="form-label text-light">Name</label>
                    <div class="input-field">
                        <i class="fa fa-user fa-fw"></i>
                        <input type="name" class="form-control border-3" id="name" name="name" value="<?php if (isset($_GET['edit'])) {
                                                                                                            echo $edit_data['name'];
                                                                                                        } ?>" aria-describedby="nameHelp" placeholder="Enter Kirayedar Name" required>
                    </div>
                </div>
                <div class="field mb-3">
                    <label for="floor" class="form-label text-light">Floor</label>
                    <div class="input-field">
                        <i class="fa fa-layer-group fa-fw"></i>
                        <select class="form-control border-3" id="floor" name="floor" required>
                            <option value="" class="dropdown-item" selected disabled>Select Floor</option>
                            <option value="Ist Floor" <?php if (isset($_GET['edit']) && $edit_data['floor'] == "Ist Floor") {
                                                            echo "selected";
                                                        } ?> class="dropdown-item">Ist Floor</option>
                            <option value="IInd Floor" <?php if (isset($_GET['edit']) && $edit_data['floor'] == "IInd Floor") {
                                                            echo "selected";
                                                        } ?> class="dropdown-item">IInd Floor</option>
                            <option value="IIIrd Floor" <?php if (isset($_GET['edit']) && $edit_data['floor'] == "IIIrd Floor") {
                                                            echo "selected";
                                                        } ?> class="dropdown-item">IIIrd Floor</option>
                        </select>
                    </div>
                </div>
                <div class="field mb-3">
                    <label for="current_unit" class="form-label text-light">Current Unit</label>
                    <div class="input-field">
                        <i class="fa fa-plug fa-fw"></i>
                        <input type="number" min="0" class="form-control border-3" name="current_unit" id="current_unit" value="<?php if (isset($_GET['edit'])) {
                                                                                                                                    echo $edit_data['current_unit'];
                                                                                                                                } ?>" placeholder="Enter Current Reading" required <?php if (isset($_GET['edit']) && $his_count > 0) {
                                                                                                                                                                                        echo 'readonly';
                                                                                                                                                                                    } ?>>

                    </div>
                    <p style="color:#dc3545; font-size:12px; position: absolute;" <?php if ((isset($_GET['edit']) && $his_count == 0) || (!isset($_GET['edit']))) {
                                                                                        echo 'hidden';
                                                                                    } ?>>Current unit cannot be modify.
                    </p>
                </div>
                <div class="field mb-3">
                    <label for="rent" class="form-label text-light">Rent</label>
                    <div class="input-field">
                        <i class="fa fa-rupee-sign fa-fw"></i>
                        <input type="number" min="0" class="form-control border-3" name="rent" id="rent" value="<?php if (isset($_GET['edit'])) {
                                                                                                                    echo $edit_data['rent'];
                                                                                                                } ?>" placeholder="Enter Rent Amount" required>
                    </div>
                </div>
                <div class="field mb-3">
                    <label for="rupee_per_unit" class="form-label text-light">Rupees/Unit</label>
                    <div class="input-field">
                        <i class="fa fa-rupee-sign fa-fw"></i>
                        <input type="text" min="1" class="form-control border-3" name="rupee_per_unit" id="rupee_per_unit" value="<?php if (isset($_GET['edit'])) {
                                                                                                                                        echo $edit_data['rupee_per_unit'];
                                                                                                                                    } ?>" placeholder="Enter Rent/Unit" required>

                    </div>
                </div>
                <div class="field mb-3">
                    <label for="water_unit" class="form-label text-light">Water Reading</label>
                    <div class="input-field">
                        <i class="fa fa-droplet fa-fw"></i>
                        <input type="number" min="0" class="form-control border-3" name="water_unit" id="water_unit" value="<?php if (isset($_GET['edit'])) {
                                                                                                                                echo $edit_data['water_unit'];
                                                                                                                            } ?>" placeholder="Enter Water Reading" required>

                    </div>
                </div>
                <div class="field mb-3">
                    <label for="phone" class="form-label text-light">Phone</label>
                    <div class="input-field">
                        <i class="fa fa-phone-volume fa-fw"></i>
                        <input type="tel" class="form-control border-3" name="phone" id="phone" value="<?php if (isset($_GET['edit'])) {
                                                                                                            echo $edit_data['phone'];
                                                                                                        } ?>" placeholder="Enter Kirayedar Phone no" required>

                    </div>
                </div>

                <button type="submit" class="btn btn-danger ark w-100" style="font-size: 18px;">
                    <?php
                    if (isset($_GET['edit'])) {
                        echo 'Edit Kirayedar';
                    } else {
                        echo 'Add Kirayedar';
                    }
                    ?>
                </button>
            </form>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('#addoreditUser').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = $(this).serialize();
            $.ajax({
                url: 'addoreditUser_Submit.php',
                type: 'POST',
                data: formData,
                success: function(res) {
                    if (res == "Updated") {
                        Swal.fire({
                            icon: "success",
                            title: "Wow...",
                            text: "Kirayedar Detail Updated Successfully...",
                            showConfirmButton: false,
                            timer: 1000,
                        }).then(() => {
                            window.location.replace("homepage.php");
                        })
                    } else if (res == "Notfound") {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Kirayedar Not Found!!!",
                        }).then(() => {
                            window.location.href = "homepage.php";
                        })
                    } else if (res == "Failed") {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Can't process your Request!!!",
                        });
                    } else if (res == "Inserted") {
                        Swal.fire({
                            icon: "success",
                            title: "Wow...",
                            text: "Kirayedar Added Successfully...",
                            showConfirmButton: false,
                            timer: 1000,

                        }).then(() => {
                            window.location.href = 'homepage.php';
                        });
                    } else if (res == "Duplicate") {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Kirayedar Already Exist with Same Phone no!",
                        });
                    } else if (res == "Phone_len") {
                        Swal.fire({
                            icon: "warning",
                            title: "Oops...",
                            text: "Phone number should be of 10 Digit!",
                        });
                    }
                }
            });
        });
    });
</script>

</html>