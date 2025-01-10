<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #743e8e;
        }
        .comment {
            margin-top: 20px;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php
    $commentsDir = "Comment/";

    if (isset($_GET['name'])) {
        $topicName = $_GET['name'];
        $topicFileName = str_replace(" ", "", $topicName) . ".txt";
        $topicFilePath = $commentsDir . $topicFileName;

        echo "<h1>$topicName</h1>";

        if (file_exists($topicFilePath)) {
            echo nl2br(file_get_contents($topicFilePath));
        } else {
            echo "<p>Topic details not found.</p>";
        }

        // Handle new comments
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = trim($_POST['comment']);
            $creator = trim($_POST['creator']);
            $timestamp = date("Y-m-d H:i:s");

            if (!empty($comment) && !empty($creator)) {
                $handle = fopen($topicFilePath, "a");
                fwrite($handle, "<div class='comments'>\n");
                fwrite($handle, "<p><strong>ความคิดเห็น:</strong> $comment</p>\n");
                fwrite($handle, "<p><strong>โดย:</strong> $creator</p>\n");
                fwrite($handle, "<p><strong>วันเวลา:</strong> $timestamp</p>\n");
                fwrite($handle, "</div>\n<hr>\n");
                fclose($handle);

                header("Location: topic.php?name=" . urlencode($topicName));
                exit;
            } else {
                echo "<p style='color: red;'>กรุณากรอกความคิดเห็นและชื่อของคุณ!</p>";
            }
        }
    } else {
        echo "<p>No topic selected.</p>";
    }
    ?>

    <h2>Leave a Comment</h2>
    <form action="topic.php?name=<?= urlencode($topicName) ?>" method="post">
        <textarea name="comment" rows="4" required></textarea><br><br>
        <input type="text" name="creator" placeholder="Your Name" required><br><br>
        <input type="submit" value="Submit">
    </form>

    <p style="text-align: center;">
        <a href="topicsList.php" class="link-button" style="display: inline-block; background-color: #4CAF50; color: white; padding: 14px 25px; text-align: center; text-decoration: none; border-radius: 5px;">กลับหน้า TopicsList</a>
    </p>

</body>
</html>