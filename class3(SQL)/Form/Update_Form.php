<?php
/* get connection */
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "fullstack";

$con = mysqli_connect($servername, $username, $password, $dbname);

$a1 = $_POST['a1'];
$a2 = $_POST['a2'];
$a3 = $_POST['a3'];
$a4 = $_POST['a4'];
$a5 = $_POST['a5'];

/* run update */
$stmt = mysqli_query($con, "UPDATE customer SET
                               CustName = '$a2', Sex ='$a3', Address = '$a4', Tel = '$a5'
                               WHERE IDCust = '$a1'");

/* check for errors */
if (!$stmt) {
    /* error */
    echo "Error";
} else {
    echo "Update data = <Font color=red> '$a1' </Font> is Successful.";
}

echo "<meta http-equiv='refresh' content='1;url=../MySQL/condb.php'>";

/* close connection */
mysqli_close($con);
?>