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

/* run insert */
$stmt = mysqli_query($con, "INSERT INTO customer(IDCust, CustName, Sex, Address,Tel)
                                  VALUES('$a1','$a2','$a3','$a4','$a5')");

/* check for errors */
if (!$stmt) {
    /* error */
    echo "Error: " . mysqli_error($con);
} else {
    echo "Insert data = <Font color=red> '$a1' </Font> is Successful.";
}

/* close connection */
mysqli_close($con);
?>
