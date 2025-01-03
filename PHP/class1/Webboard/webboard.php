<center>
    <font color=red size=7>ตัวอย่าง Webboard</font>
</center>

<hr>

<?php

$message = $_POST['message'];
$by = $_POST['by'];
$date = date("Y-m-d H:i:s");

$fs = fopen("webboard.txt", "a");
fputs($fs, "ข้อความ: $message <br>\n");
fputs($fs, "โพสต์โดย: $by <br>\n");
fputs($fs, "วันเวลา: $date <br>\n");
fputs($fs, "<hr>\n");
fclose($fs);
?>

<?php

$fs = fopen("webboard.txt", "r");
$e = fpassthru($fs);

?>

<form action="webboard.php" method="post">
    ข้อความ: <textarea rows="4" cols="50" name="message"></textarea><br>
    โพสต์โดย: <input type="text" name="by"><br>
    <input type="submit" value="โพสต์"><input type="reset" value="ยกเลิก">
</form>