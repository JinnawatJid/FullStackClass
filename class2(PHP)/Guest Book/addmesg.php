<?php

$gname = $_POST['gname'];
$gmesg = $_POST['gmesg'];
$gtime = date("Y-m-d H:i:s");

$filename = "gbooks.txt";
$fp = fopen($filename, "a+");
fputs($fp, "ข้อความ: $gmesg <br>\n");
fputs($fp, "โพสต์โดย: $gname <br>\n");
fputs($fp, "วันเวลา: $gtime <br>\n");
fclose($fp);

$lines = file($filename);
$last = sizeof($lines) - 1;

for ($i = $last; $i >= 0; $i--) {
    $ptext = $lines[$i];
    echo $ptext;
    if ($i == $last - 2) {
        echo "<hr>";
    }
}
