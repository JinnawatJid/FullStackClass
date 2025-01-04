<?php

/* get connection */
$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "fullstack";

$con = mysqli_connect($servername, $username, $password, $dbname);

$begin = $_POST['begin'];
$end = $_POST['end'];

$cur = mysqli_query($con, "select * from customer where IDCust between '$begin' and '$end' order by IDCust");
while (mysqli_fetch_array($cur)) {
  $row = mysqli_fetch_array($cur);
  $name1 = $row['IDCust'];
  $name2 = $row['CustName'];
  $name3 = $row['Sex'];
  $name4 = $row['Address'];
  $name5 = $row['Tel'];
  echo "<FONT color=blue>&nbsp;&nbsp;&nbsp;&nbspIDCust:&nbsp;&nbsp;&nbsp;&nbsp</FONT>$name1,
          <FONT color=red>&nbsp;&nbsp;&nbsp;&nbspCustName:&nbsp;&nbsp;&nbsp;&nbsp</FONT>$name2,
          <FONT color=green>&nbsp;&nbsp;&nbsp;&nbspSex:&nbsp;&nbsp;&nbsp;&nbsp</FONT>$name3,
          <FONT color=yellow>&nbsp;&nbsp;&nbsp;&nbspAddr:&nbsp;&nbsp;&nbsp;&nbsp</FONT>$name4,
          <FONT color=cyan>&nbsp;&nbsp;&nbsp;&nbspTel:</FONT>$name5&nbsp;&nbsp;&nbsp;&nbsp<BR>";
}
mysqli_close($con);
