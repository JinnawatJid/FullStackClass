<?php

$fs = fopen("counter.inc","r");
    $count = fgets($fs,255);
    fclose($fs);
    $count++;
    $co = strval($count);
    for($i=0;$i<strlen($co);$i++){
        print"<img src=$co[$i].jpg>";
        if(((strlen($co)-$i)==7) || ((strlen($co)-$i)==4)){
            print"<img src=,.jpg>";
        }
    }
    print"<H1>$count</H1>";
    $fs=fopen("counter.inc","w");
    fputs($fs,$count);
    fclose($fs);

?>