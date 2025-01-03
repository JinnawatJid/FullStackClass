<?php
$filename = "gbooks.txt";

// Retrieve form data
$gname = isset($_POST['gname']) ? htmlspecialchars($_POST['gname']) : '';
$gmesg = isset($_POST['gmesg']) ? htmlspecialchars($_POST['gmesg']) : '';

// Open the file and write the content
$fp = fopen($filename, "a+");
if ($fp) {
    fputs($fp, "ข้อความ: $gmesg<br>\n");
    fputs($fp, "ชื่อ: $gname<br>\n");
    fclose($fp);
}

// Read the file content and display it
$lines = file($filename);
$last = sizeof($lines) - 1;
for ($i = $last; $i >= 0; $i--) {
    $ptext = $lines[$i];
    echo $ptext, "<br>";
    if ($i % 2 == 1) {
        echo "<hr>";
    }
}
?>
