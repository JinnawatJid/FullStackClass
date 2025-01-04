<style>
    <?php include 'reportStyle.css'; ?>
</style>

<?php

$servername = "localhost:3307";
$username = "root";
$password = "";
$dbname = "fullstack";

$con = mysqli_connect($servername, $username, $password, $dbname);

echo "<h1>ออกรายงานวันที่: " . date("d/m/Y") . "</h1>";
echo "<h2>รายงานลูกค้า</h2>";
if ($result = mysqli_query($con, "SELECT * From Customer")) {
    echo "<table>";

    // this one used assoc array to fetch data
    // echo "<tr><th>IDCust</th><th>CustName</th><th>Sex</th><th>Address</th><th>Tel</th></tr>";
    // while ($row = mysqli_fetch_assoc($result)) {
    //     echo "<tr>";
    //     echo "<td>" . $row['IDCust'] . "</td>";
    //     echo "<td>" . $row['CustName'] . "</td>";
    //     echo "<td>" . $row['Sex'] . "</td>";
    //     echo "<td>" . $row['Address'] . "</td>";
    //     echo "<td>" . $row['Tel'] . "</td>";
    //     echo "</tr>";
    // }

    // this one used index array to fetch data
    // echo "<tr><th>IDCust</th><th>CustName</th><th>Tel</th></tr>";
    // while ($row = mysqli_fetch_row($result)) {
    //     echo "<tr>";
    //     echo "<td>" . $row["IDCust"] . "</td>";
    //     echo "<td>" . $row["CustName"] . "</td>";
    //     echo "<td>" . $row[4] . "</td>";
    //     echo "</tr>";
    // }

    echo "<tr><th>IDCust</th><th>CustName</th><th>Tel</th><th>Update</th><th>Delete</th></tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td><a href='customer.php?IDCust=" . $row["IDCust"] . "&CustName=" . $row["CustName"] . "&Address=" . $row["Address"] . "&Tel=" . $row["Tel"] . "'>" . $row["IDCust"] . "</a></td>";
        echo "<td>" . $row["CustName"] . "</td>";
        echo "<td>" . $row["Tel"] . "</td>";
        echo "<td><a class='button update' href='../Form/Update_Form_index.php?IDCust=" . $row["IDCust"] . "&CustName=" . $row["CustName"] . "&Sex=" . $row["Sex"] . "&Address=" . $row["Address"] . "&Tel=" . $row["Tel"] . "'>Update</a></td>";
        echo "<td><a class='button delete' onclick=\"return confirm('ต้องการลบรายการนี้หรือไม่?\\nIDCust: " . $row["IDCust"] . "\\nCustName: " . $row["CustName"] . "\\nTel: " . $row["Tel"] . "')\" href='../Form/Delete_Form.php?code=" . $row["IDCust"] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
    echo "<h3>รวมจำนวณลูกค้าทั้งหมด: " . mysqli_num_rows($result) . " ราย</h3>";
    echo "<h4>รวมจำนวณลูกค้าชาย: " . mysqli_num_rows(mysqli_query($con, "SELECT * From Customer WHERE Sex = 'M'")) . " ราย</h3>";
    echo "<h4>รวมจำนวณลูกค้าหญิง: " . mysqli_num_rows(mysqli_query($con, "SELECT * From Customer WHERE Sex = 'F'")) . " ราย</h3>";
    mysqli_free_result($result);
}


mysqli_close($con);

