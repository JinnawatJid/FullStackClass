<?php

function drawRating($rating1, $rating2, $rating3)
{
    // Creating image area //
    $image = imagecreate(550, 100);

    // Describing Colors //
    $back = ImageColorAllocate($image, 255, 255, 255);
    $border = ImageColorAllocate($image, 0, 0, 0);
    $fill = ImageColorAllocate($image, 44, 81, 150);

    // Creating Backside //
    ImageFilledRectangle($image, 0, 0, 302, 20, $back);
    ImageFilledRectangle($image, 0, 30, 302, 50, $back);
    ImageFilledRectangle($image, 0, 60, 302, 80, $back);

    // Creating Filled Side //
    ImageFilledRectangle($image, 1, 1, $rating1 * 3, 19, $fill);
    ImageFilledRectangle($image, 1, 31, $rating2 * 3, 49, $fill);
    ImageFilledRectangle($image, 1, 61, $rating3 * 3, 79, $fill);

    // Creating Borders //
    ImageRectangle($image, 0, 0, 300, 20, $border);
    ImageRectangle($image, 0, 30, 300, 50, $border);
    ImageRectangle($image, 0, 60, 300, 80, $border);

    // Texts //
    ImageString($image, 5, 310, 0, "From PHP Manual - %$rating1", $border);
    ImageString($image, 5, 310, 30, "Example to show - %$rating2", $border);
    ImageString($image, 5, 310, 60, "Percentages - %$rating3", $border);

    // Set the Content-Type header
    header("Content-Type: image/png");

    // Picturing //
    imagePNG($image);

    $timeStamp = time();
    imagePNG($image, "rating_{$timeStamp}.png");

    // Deleting from Memory //
    imagedestroy($image);
}

drawRating(48, 26, 34); // numbers in parentheses are levels
?>

