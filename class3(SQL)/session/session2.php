<?php 

function showmesg() {
    if (session_regenerate_id("name")) {
            echo "still not cancel session variable";
            } else {
                echo "cancel session variable";
            }
    }
?>