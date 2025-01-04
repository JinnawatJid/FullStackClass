<?php

session_start();

/* get connection */
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "fullstack";

$con = mysqli_connect($servername, $username, $password, $dbname);

$code = $_GET['code'];
$_SESSION['IDCust'] = $code;

/* run Delete */
$stmt = mysqli_query($con, "DELETE FROM customer WHERE IDCust = '$code'");

/* check for errors */
if (!$stmt) {
    /* error */
    echo "Error: " . mysqli_error($con);
} else {
    echo "Delete data = <Font color=red> '$code' </Font> is Successful.";
}

echo "<meta http-equiv='refresh' content='1;url=../MySQL/condb.php'>";

/* close connection */
mysqli_close($con);
?>
