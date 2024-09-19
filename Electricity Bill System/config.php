<?php

$server = 'localhost';
$name = 'root';
$password = '';
$dbname = 'electricitybill';

$con = mysqli_connect($server, $name, $password, $dbname);

if (!$con) {
?>
<script>
alert("Cannot connect to the server");
</script>
<?php
} else {
    mysqli_select_db($con, $dbname);
}
?>