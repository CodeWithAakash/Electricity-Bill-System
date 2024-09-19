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


if (isset($_GET['phone'])) {
    $pid = $_GET['phone'];
    $query = "select * from bill where user_id = '$user_id' and phone = '$pid'";
    $exe_query = mysqli_query($con, $query);
    $bill_data = mysqli_fetch_assoc($exe_query);


    $f_query = "select * from history where user_id = '$user_id' and phone = '$pid' order by history_id desc";
    $exe_f_query = mysqli_query($con, $f_query);
    $num = mysqli_num_rows($exe_f_query);
    if ($bill_data['phone'] == "") {
?>
        <script>
            window.location.href = "homepage.php";
        </script>
    <?php
    }
} else {
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
        td button {
            display: inline-flex !important;
            justify-content: center !important;
            align-items: center !important;
            width: 48px !important;
            height: 42px !important;
        }

        .page-item.active .page-link {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        nav li {
            cursor: pointer;
        }

        nav li a i {
            color: black !important;
        }

        nav li a {
            color: black !important;
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
    <title>BillHistory</title>
</head>

<body>
    <nav class="navbar navbar mb-4">
        <div class="container-fluid">
            <a class="navbar-brand btn btn-danger" onclick="window.location.href = 'homepage.php';">Back</a>

            <div class="d-flex pt-2 pb-2">
                <p style="color: white; margin-bottom: 0 !important; font-size: 17px; font-weight: 600;"><i
                        class="fa fa-user" style="border-radius: 50%; padding: 5px; background: crimson;"></i> Hi,
                    <?php echo $user; ?></p>
            </div>
        </div>
        </div>
    </nav>

    <div class="container ps-10 pe-10">
        <div class="container ps-0 pe-0">
            <h3 style="font-weight: bolder; color: white;">Kirayedar Bill History</h3>
            <div class="text-white pt-3 d-flex align-items-center flex-row justify-content-between">
                <table class="huserdetail table text-white table-responsive w-auto border border-0"
                    style="border: transparent !important; margin:0px !important;">
                    <tr>
                        <th class="fs-5"><?php echo $bill_data['name'] ?>(<?php echo $bill_data['floor'] ?>)</th>
                    </tr>
                </table>
                <div class="addSearch">
                    <div class="d-flex">
                        <select name="rowsPerPage" id="rowsPerPage" class="btn btn-light"
                            style="text-indent:0px !important; padding:0px !important; margin-left:10px !important; height: 42px;">
                            <option value="10">10</option>
                            <option value="20">20</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ps-0 pe-0 table-responsive mt-3">
            <table id="usersTable" class="table table-bordered table-striped text-center" style="width: 100%;">
                <thead class="table bg-danger fs-5" style="color:black;">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Rent</th>
                        <th scope="col">From Unit</th>
                        <th scope="col">To Unit</th>
                        <th scope="col">Water Unit</th>
                        <th scope="col">Rs/Unit</th>
                        <th scope="col">Date</th>
                        <th scope="col">Payable Amount</th>
                        <th scope="col">Get Slip</th>
                        <th scope="col">Edit Bill</th>
                    </tr>
                </thead>
                <tbody id="usersTable_details" class="align-middle fs-5" style="background-color: ghostwhite; ">

                    <?php
                    if ($num > 0) {
                        $count = 1;
                        while ($rows = mysqli_fetch_array($exe_f_query)) {
                    ?>
                            <tr>
                                <th scope="row"><?php echo $count ?>.</th>
                                <?php $count += 1; ?>
                                <td><?php echo $rows['rent']; ?></td>
                                <td><?php echo $rows['previous_unit']; ?></td>
                                <td><?php echo $rows['current_unit']; ?></td>
                                <td><?php echo $rows['water_unit']; ?></td>
                                <td><?php echo $rows['rupee_per_unit']; ?></td>
                                <td><?php echo date("d-M-Y", strtotime($rows['bill_date'])) ?></td>
                                <td><?php echo $rows['bill_amount'] . "/-"; ?></td>
                                <td><button class="btn btn-danger text-dark"
                                        onclick="window.location.href = 'slip.php?slipid=<?php echo $rows['history_id'] ?>';"><i
                                            class="fa-solid fa-file-lines"></i></button></td>
                                <td><button class="btn btn-success text-dark"
                                        onclick="window.location.href = 'createoreditBill.php?edit=<?php echo $rows['history_id'] ?>';" <?php if ($count > 2) {
                                                                                                                                            echo 'Disabled';
                                                                                                                                        } ?>><i class=" fa fa-file-pen"></i></button>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <th colspan="12" class="text-center">Kirayedar History Not found</th>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <div>
            <nav id="pagination-div" class="mt-4 d-flex flex-column float-end" style="user-select:none;">
                <ul id="pagination" class="pagination justify-content-end" style="font-size: 21px !important;">
                </ul>
                <p id="paginationText" style="color: white; font-size:14px;">showing
                    <span></span> to
                    <span></span> of
                    <span></span> records.
                </p>
            </nav>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        var rowsPerPage = $('#rowsPerPage').val();
        var rows = $('#usersTable_details tr');
        var rowCount = rows.length;
        var pageCount = Math.ceil(rowCount / rowsPerPage);
        var showPage = 1;

        function displayRows(page, rows) {
            rowsPerPage = parseInt(rowsPerPage);
            var start = (page - 1) * rowsPerPage;
            var end = start + rowsPerPage;
            var rowCount = rows.length;
            $('#paginationText span:first-child').html(start + 1);
            if (end > rowCount) {
                $('#paginationText span:nth-child(2)').html(rowCount);
            } else {
                $('#paginationText span:nth-child(2)').html(end);
            }
            $('#paginationText span:last-child').html(rowCount);
            rows.hide();
            rows.slice(start, end).show();
        }


        function updatePaginationlinks(pageCount) {
            if (pageCount > 0) {
                $('#pagination-div').show();
                $('#pagination').append(
                    '<li class="page-item" data-text="prev"><a class="page-link"><i class="fa-solid fa-caret-left"></i></a></li>'
                );
                for (let i = 1; i <= pageCount; i++) {
                    $('#pagination').append('<li class="page-item"><a class="page-link">' + i + '</a></li>');
                }
                $('#pagination').append(
                    '<li class="page-item" data-text="next"><a class="page-link"><i class="fa-solid fa-caret-right"></i></a></li>'
                );
                $('#pagination li:nth-child(2)').addClass('active');
            } else {
                $('pagination li').remove();
                $('#pagination-div').hide();
            }
        }

        $('#rowsPerPage').change(function() {
            rowsPerPage = $(this).val();
            var rows = $('#usersTable_details tr');
            var rowCount = rows.length;
            var pageCount = Math.ceil(rowCount / rowsPerPage);

            showPage = 1;
            displayRows(showPage, rows);
            $('#pagination li').remove();
            updatePaginationlinks(pageCount);

        });

        $('#pagination').on('click', 'li', function(e) {
            e.preventDefault();

            var rows = $('#usersTable_details tr');
            var rowCount = rows.length;
            var pageCount = Math.ceil(rowCount / rowsPerPage);


            if ($(this).attr('data-text') === "next") {
                var idx = $('#pagination li.active').find('a').html();
                idx = parseInt(idx);
                if (idx < pageCount) {
                    showPage = idx + 1;
                    $('#pagination li.active').removeClass('active').next('li').addClass('active');
                    displayRows(showPage, rows);
                }

            } else if ($(this).attr('data-text') === "prev") {
                var idx = $('#pagination li.active').find('a').html();
                idx = parseInt(idx);
                if (idx > 1) {
                    showPage = idx - 1;
                    $('#pagination li.active').removeClass('active').prev('li').addClass('active');
                    displayRows(showPage, rows);
                }
            } else {
                var page = $(this).find('a').html();
                $('#pagination li').removeClass('active');
                $(this).addClass('active');
                displayRows(page, rows);
            }

        });

        displayRows(1, rows);
        $('#pagination li').remove();
        updatePaginationlinks(pageCount);
    });
</script>

</html>