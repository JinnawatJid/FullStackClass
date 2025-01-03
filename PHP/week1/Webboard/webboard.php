<center>
    <font color="red" size="7">ตัวอย่าง Webboard</font>
</center>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $message = $_POST['message'] ?? ''; // Use null coalescing operator to handle undefined keys
    $by = $_POST['by'] ?? '';
    $date = date("Y-M-d H:i:s"); // Use PHP's built-in date() function

    // Open file for appending
    $fs = fopen("webboard.txt", "a");
    if ($fs) {
        fputs($fs, "ข้อความ: $message <br>\n");
        fputs($fs, "โพสต์โดย: $by <br>\n");
        fputs($fs, "วันเวลา: $date <br>\n<hr>\n");
        fclose($fs);
    } else {
        echo "<p style='color:red;'>ไม่สามารถเขียนไฟล์ได้</p>";
    }
}
?>

<?php
// Open file for reading
if (file_exists("webboard.txt")) {
    $fs = fopen("webboard.txt", "r");
    if ($fs) {
        echo "<h2>โพสต์ใน Webboard</h2>";
        echo nl2br(fread($fs, filesize("webboard.txt")));
        fclose($fs);
    } else {
        echo "<p style='color:red;'>ไม่สามารถอ่านไฟล์ได้</p>";
    }
}
?>

<!-- HTML Form -->
<form action="webboard.php" method="post">
    ข้อความ: <textarea rows="4" cols="50" name="message" required></textarea><br>
    โพสต์โดย: <input type="text" name="by" required><br>
    <input type="submit" value="โพสต์">
    <input type="reset" value="ยกเลิก">
</form>
<hr>