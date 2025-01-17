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

    // Return the image resource
    return $image;
}

// Handle form submission
$showGraph = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $rating1 = isset($_POST['rating1']) ? (int)$_POST['rating1'] : 0;
    $rating2 = isset($_POST['rating2']) ? (int)$_POST['rating2'] : 0;
    $rating3 = isset($_POST['rating3']) ? (int)$_POST['rating3'] : 0;

    // Store the ratings for graph generation
    $ratings = compact('rating1', 'rating2', 'rating3');
    $showGraph = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rating Graph</title>
</head>
<body>
    <h1>Enter Ratings</h1>
    <form action="" method="post">
        <label for="rating1">Rating 1 (0-100):</label>
        <input type="number" id="rating1" name="rating1" min="0" max="100" required>
        <br><br>
        <label for="rating2">Rating 2 (0-100):</label>
        <input type="number" id="rating2" name="rating2" min="0" max="100" required>
        <br><br>
        <label for="rating3">Rating 3 (0-100):</label>
        <input type="number" id="rating3" name="rating3" min="0" max="100" required>
        <br><br>
        <button type="submit">Submit</button>
    </form>

    <?php if ($showGraph): ?>
        <h2>Generated Graph</h2>
        <img src="data:image/png;base64,<?php
            ob_start();
            $image = drawRating($ratings['rating1'], $ratings['rating2'], $ratings['rating3']);
            imagepng($image);
            $imageData = ob_get_clean();
            imagedestroy($image);
            echo base64_encode($imageData);
        ?>" alt="Rating Graph">
    <?php endif; ?>
</body>
</html>
