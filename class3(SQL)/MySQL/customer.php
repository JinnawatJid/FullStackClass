<style>
    <?php include 'customerStyle.css'; ?>
</style>

<?php 

$IDCust = $_GET['IDCust'];
$CustName = $_GET['CustName'];
$Tel = $_GET['Tel'];
$Address = $_GET['Address'];

echo "<h1>รหัสลูกค้า: $IDCust</h1>";
echo "<h2>ชื่อลูกค้า: $CustName</h2>";
echo "<h3>ที่อยู่: $Address</h3>";
echo "<h4>เบอร์โทร: $Tel</h4>";

echo "<button onclick=\"window.location.href='condb.php'\">กลับไปหน้า report</button>";


?>