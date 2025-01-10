<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topics List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #743e8e;
        }

        .topic-link {
            display: block;
            padding: 10px;
            margin: 10px 0;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #743e8e;
        }

        .topic-link:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <h1>Topics</h1>

    <?php
    $topicsFile = "webboardTopics.txt";

    if (file_exists($topicsFile)) {
        $topics = file($topicsFile, FILE_IGNORE_NEW_LINES);
        foreach ($topics as $index => $topic) {
            $topicLink = "topic.php?name=" . urlencode($topic);
            echo "<a class='topic-link' href='$topicLink'>$topic</a>";
        }
    } else {
        echo "<p>No topics found.</p>";
    }
    ?>

    <p style="text-align: center;">
        <a href="topics.php" class="link-button" style="display: inline-block; background-color: #4CAF50; color: white; padding: 14px 25px; text-align: center; text-decoration: none; border-radius: 5px;">กลับหน้า CreateTopic</a>
    </p>

</body>

</html>