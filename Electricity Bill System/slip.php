<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        @media screen and (max-width: 500px) {
            .table>:not(caption)>*>* {
                padding: 0.5rem 0.3rem !important;
            }
        }
    </style>
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

if (isset($_GET['Created'])) {
    $his_id = $_GET['Created'];
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
} else if (isset($_GET['slipid'])) {
    $his_id = $_GET['slipid'];
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
    $fdata = array("name" => "", "previous_unit" => 0, "current_unit" => 0, "rent" => "", "rupee_per_unit" => 0, "water_unit" => 0, "phone" => "", "bill_amount" => 0, "bill_date" => "");
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
    <meta charset="utf-8">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>BillSlip</title>
</head>

<body>
    <nav class="navbar navbar mb-4">
        <div class="container-fluid">
            <?php if (isset($_GET['Created'])) {
            ?>
                <button class="navbar-brand btn btn-danger" onclick="window.location.replace('homepage.php')">Back</button>
            <?php
            } else {
            ?>
                <button class="navbar-brand btn btn-danger" onclick="history.back();">Back</button>
            <?php
            }
            ?>


            <div class="d-flex pt-2 pb-2">
                <p style="color: white; margin-bottom: 0 !important; font-size: 17px; font-weight: 600;"><i class="fa fa-user" style="border-radius: 50%; padding: 5px; background: crimson;"></i> Hi,
                    <?php echo $user; ?></p>
            </div>
        </div>
        </div>
    </nav>

    <div class="add-edit-container container">
        <div id="photo" class="bg-dark">
            <div id="formdiv" class="m-auto text-white pt-3 pb-3" style="width: 350px;">
                <div>
                    <div class="title">
                        <h5>Bill Slip</h5>
                        <hr>
                        <h6>Name - <?php echo $fdata['name'] ?></h6>
                        <hr>
                    </div>
                    <div>
                        <p>Payment for the month of : <?php echo date("F", strtotime($fdata['bill_date'])) ?></p>
                        <p>Bill Date - <?php echo date("d-m-Y", strtotime($fdata['bill_date'])); ?></p>
                        <p>Reading - <?php echo $fdata['current_unit'] ?></p>
                        <hr>
                        <table class="table text-white text-center" style="border: transparent;">
                            <tr>
                                <td><?php echo $fdata['current_unit'] - $fdata['previous_unit'] ?></td>
                                <td>+</td>
                                <td><?php echo $fdata['water_unit'] ?></td>
                                <td>=</td>
                                <td><?php echo $fdata['current_unit'] - $fdata['previous_unit'] + $fdata['water_unit'] ?>
                                </td>
                                <td>&times;</td>
                                <td><?php echo $fdata['rupee_per_unit'] ?></td>
                                <td>=</td>
                                <td class="d-flex justify-content-end">
                                    <?php echo floor(($fdata['current_unit'] - $fdata['previous_unit'] + $fdata['water_unit']) * $fdata['rupee_per_unit']) ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7"></td>
                                <td>+</td>
                                <td class="d-flex justify-content-end"><?php echo $fdata['rent'] ?></td>
                            </tr>
                            <tr>
                                <td colspan="8"></td>
                                <td class="d-flex justify-content-end" style="border-top: 1px solid white; border-bottom: 1px solid white;">
                                    <?php echo $fdata['bill_amount'] ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100 d-flex justify-content-center align-items-center">
            <button id="mybutton" class="btn btn-danger mb-3"><i class="fa fa-image"></i> Print</button>
        </div>
    </div>
</body>

<script src="html2canvas.min.js"></script>
<script>
    document.getElementById("mybutton").onclick = function() {
        const screenshotTarget = document.getElementById("photo");
        html2canvas(screenshotTarget).then((canvas) => {
            const base64image = canvas.toDataURL("image/png");
            var anchor = document.createElement("a");
            anchor.setAttribute("href", base64image);
            anchor.setAttribute("download",
                "<?php echo $fdata['name'] . '_' . date("F", strtotime($fdata['bill_date'])) ?>_month_bill.png"
            );
            anchor.click();
            anchor.remove();
        });
    };
</script>

</html>