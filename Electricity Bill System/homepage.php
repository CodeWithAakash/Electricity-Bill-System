<?php
include 'config.php';
session_start();
if (!isset($_SESSION['email'])) {
    header('location:index.php');
}
$email = $_SESSION['email'];
$user_id = $_SESSION['user_id'];
$user = str_replace('@gmail.com', '', $email);
$query = "select * from bill where user_id = '$user_id'";
$exe_query = mysqli_query($con, $query);
$num = mysqli_num_rows($exe_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    td button,
    .addUser {
        display: inline-flex !important;
        justify-content: center !important;
        align-items: center !important;
        width: 53px !important;
        height: 45px !important;
    }

    .page-item.active .page-link {
        background-color: #dc3545 !important;
        border-color: #dc3545 !important;
    }

    .page-item.disable .page-link {
        background-color: #636e72 !important;
        border-color: #636e72 !important;
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
    <title>Homepage</title>
</head>

<body>
    <nav class="navbar navbar mb-4">
        <div class="container-fluid">
            <a class="navbar-brand btn btn-danger" href="logout.php">Logout</a>

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
            <h3 style="font-weight: bolder; color: white;">Kirayedar List</h3>
            <div class="addSearch d-flex justify-content-between pt-3 pb-2">
                <div class="d-flex align-items-center">
                    <button onclick="window.location.href='addoreditUser.php';" class="addUser btn btn-danger fs-5"><i
                            class="fa fa-user-plus" style="color:white;"></i></button>
                </div>
                <div class="d-flex flex-row align-items-center">
                    <select name="rowsPerPage" id="rowsPerPage" class="btn btn-light"
                        style="text-indent:0px !important; padding:0px !important; margin-left:10px !important; height: 45px;">
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>

                    <div class="field" style="margin-left:10px !important;">
                        <div class="input-field">
                            <i class="fa fa-magnifying-glass fa-fw text-white"></i>
                            <input id="search" class="form-control border-2 border-danger" type="search"
                                placeholder="Search Kirayedar" aria-label="Search">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container ps-0 pe-0 table-responsive mt-3">
            <table id="usersTable" class="table table-bordered table-striped text-center" style="width: 100%;">
                <thead class="table bg-danger fs-5" style="color:black;">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Name</th>
                        <th scope="col">Floor</th>
                        <th scope="col">Rent</th>
                        <th scope="col">Current Unit</th>
                        <th scope="col">Rupee/Unit</th>
                        <th scope="col">Water Unit</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                        <th scope="col">Make Bill</th>
                        <th scope="col">Bill History</th>
                    </tr>
                </thead>
                <tbody id="usersTable_details" class="align-middle fs-5" style="background-color: ghostwhite; ">

                    <?php
                    if ($num > 0) {
                        $count = 1;
                        while ($rows = mysqli_fetch_array($exe_query)) {
                    ?>
                    <tr>
                        <th scope="row"><?php echo $count ?>.</th>
                        <?php $count += 1; ?>
                        <td><button class="btn btn-success text-dark"
                                onclick="window.location.href='addoreditUser.php?edit=<?php echo $rows['phone']; ?>';"><i
                                    class="fas fa-user-edit"></i></button></td>
                        <td><?php echo $rows['name']; ?></td>
                        <td><?php echo $rows['floor']; ?></td>
                        <td><?php echo $rows['rent']; ?></td>
                        <td><?php echo $rows['current_unit']; ?></td>
                        <td><?php echo $rows['rupee_per_unit']; ?></td>
                        <td><?php echo $rows['water_unit']; ?></td>
                        <th style="font-weight: 500;"><?php echo $rows['phone']; ?></th>
                        <td><button class="deletebtn btn btn-danger text-light"
                                data-id="<?php echo $rows['phone']; ?>"><i class="fa-solid fa-trash"></i></button></td>
                        <td><button class="createbill btn btn-success text-light"
                                onclick="window.location.href='createoreditBill.php?phone=<?php echo $rows['phone']; ?>';"><i
                                    class="fa-solid fa-file"></i></button>
                        </td>
                        <td><button class="btn btn-secondary text-light"
                                onclick="window.location.href = 'history.php?phone=<?php echo $rows['phone']; ?>'"
                                style="color: white;"><i class="fa-solid fa-clock"></i></button>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        ?>
                    <tr>
                        <th colspan="12" class="text-center">No Kirayedar found</th>
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
    var searchActive = false;
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
        if (searchActive === true) {
            var searchText = $('#search').val().toLowerCase();
            var rows = $('#usersTable_details tr').filter(function() {
                return $(this).text().toLowerCase().indexOf(searchText) > -1;
            });
            var rowsCount = rows.length;
            var pageCount = Math.ceil(rowsCount / rowsPerPage);
        } else {
            var rows = $('#usersTable_details tr');
            var rowCount = rows.length;
            var pageCount = Math.ceil(rowCount / rowsPerPage);
        }
        showPage = 1;
        displayRows(showPage, rows);
        $('#pagination li').remove();
        updatePaginationlinks(pageCount);

    });

    $('#pagination').on('click', 'li', function(e) {
        e.preventDefault();
        if (searchActive === true) {
            var searchText = $('#search').val().toLowerCase();
            var rows = $('#usersTable_details tr').filter(function() {
                return $(this).text().toLowerCase().indexOf(searchText) > -1;
            });
            var rowsCount = rows.length;
            var pageCount = Math.ceil(rowsCount / rowsPerPage);
        } else {
            var rows = $('#usersTable_details tr');
            var rowCount = rows.length;
            var pageCount = Math.ceil(rowCount / rowsPerPage);
        }

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

    $('#search').on('keyup', function() {
        const rows = $('#usersTable_details tr');
        var searchText = $(this).val().toLowerCase();
        searchActive = searchText.length > 0;
        rows.hide();
        var filteredRows = rows.filter(function() {
            return $(this).text().toLowerCase().indexOf(searchText) > -1;
        });
        filteredRows.show();
        var filteredRowsCount = filteredRows.length;
        var pageCount = Math.ceil(filteredRowsCount / rowsPerPage);
        if (filteredRows.length === 0) {
            $('#usersTable_details').append(
                '<tr class="no-data"><td colspan="12">No Match Found</td></tr>');
        } else {
            $('#usersTable_details .no-data').remove();
            filteredRows.show();
        }
        displayRows(1, filteredRows);
        $('#pagination li').remove();
        updatePaginationlinks(pageCount);
    });
});
</script>

<script>
$(document).ready(function() {
    $('.deletebtn').click(function() {
        const p_id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "Delete Kirayedar Detail and Bill History?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'delete.php',
                    type: 'POST',
                    data: {

                        pid: p_id
                    },
                    success: function(res) {
                        if (res == "Deleted") {
                            Swal.fire({
                                icon: "success",
                                title: "Deleted...",
                                text: "Kirayedar Deleted Successfully...",
                                showConfirmButton: false,
                                timer: 1000,
                            }).then(() => {
                                window.location.reload();
                            })
                        } else if (res == "Failed") {
                            Swal.fire({
                                icon: "error",
                                title: "Oops!",
                                text: "Can't process your Request!!!",
                            })
                        }
                    }
                });
            }
        });
    });
});
</script>

</html>