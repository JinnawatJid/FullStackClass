<?php 
    $IDCust = $_GET['IDCust'];
    $CustName = $_GET['CustName'];
    $Sex = $_GET['Sex'];
    $Address = $_GET['Address'];
    $Tel = $_GET['Tel'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body BGCOLOR=#6666CC Text=#000099>

  <center>
    <FONT size=7 Color=#000033>ใส่ข้อมูลของลูกค้าที่ต้องการเปลี่ยนแปลง </FONT><HR color=blue>
    <FORM METHOD="post" ACTION="Update_Form.php">
      <H1> รหัส&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <Input Type=Text Name="a1" Size=4 MaxLength=4 value="<?php echo $IDCust; ?>"><BR>
          ชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <Input Type=Text Name="a2" Size=20 MaxLength=20 value="<?php echo $CustName; ?>"><BR>
          เพศ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <Input Type=Text Name="a3" Size=1 MaxLength=1 value="<?php echo $Sex; ?>"><BR>
          ที่อยู่&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <Input Type=Text Name="a4" Size=50 MaxLength=80 value="<?php echo $Address; ?>"><BR>
          เบอร์โทรศัพท์&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <Input Type=Text Name="a5" Size=10 MaxLength=10 value="<?php echo $Tel; ?>"><BR>
          <Input Type=Submit Value="ยืนยัน">
          <Input Type=Reset Value="ยกเลิก"> </H1>
    </FORM>
  </center>
</body>
</html>