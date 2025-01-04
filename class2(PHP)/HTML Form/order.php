<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form การสั่งซื้อสินค้าจาก Shopping Mall</title>
</head>
<body>
    <?php
    
    $name = $_GET['name'];
    $tel = $_GET['tel'];
    $email = $_GET['email'];
    $Computer = $_GET['Computer'];
    $Notebook = $_GET['Notebook'];

    print "คุณ $name <br>";
    print "เบอร์โทรติดต่อ $tel <br>";
    print "Email $email <br>";
    print "สินค้าที่คุณต้องการสั่ง <br>";
    print "$Computer<br>";
    print "$Notebook<br>";

    ?>
</body>
</html>