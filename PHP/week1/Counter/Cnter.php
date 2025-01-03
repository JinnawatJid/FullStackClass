<?php 

    $filename = "cnter.txt";
    if (file_exists($filename)) {
        $fp = fopen($filename, "r");
        $counter = fgets($fp,99);
        fclose($fp);
    } else {
        $counter = 0;
    }

    $fp = fopen($filename, "w");
    $counter += 1;
    fwrite($fp, $counter);
    fclose($fp);
    print "คุณเป็นคนที่ $counter";

?>