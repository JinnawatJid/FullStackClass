<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "fullstack";

$con = mysqli_connect($servername, $username, $password, $dbname);
if ($result = mysqli_query($con, "SELECT * From Customer")) {
    echo "<table>";
    echo "<tr><th>IDCust</th><th>CustName</th><th>Sex</th><th>Address</th><th>Tel</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['IDCust'] . "</td>";
        echo "<td>" . $row['CustName'] . "</td>";
        echo "<td>" . $row['Sex'] . "</td>";
        echo "<td>" . $row['Address'] . "</td>";
        echo "<td>" . $row['Tel'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
}

mysqli_close($con);

