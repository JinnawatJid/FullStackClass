<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Topic</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            color: #743e8e;
        }
        .form-group {
            margin-bottom: 10px;
        }
        textarea, input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #743e8e;
            color: white;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Create a New Topic</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $topicName = trim($_POST['topic_name']);
        $topicDescription = trim($_POST['topic_description']);
        $creator = trim($_POST['creator']);
        $timestamp = date("Y-m-d H:i:s");

        if (empty($topicName) || empty($topicDescription) || empty($creator)) {
            echo "<p style='color: red;'>กรุณากรอกข้อมูลให้ครบถ้วน!</p>";
        } else {
            // File paths
            $topicsFile = "webboardTopics.txt";
            $commentsDir = "Comment/";
            $topicFileName = str_replace(" ", "", $topicName) . ".txt";
            $topicFilePath = $commentsDir . $topicFileName;

            // Save topic name to webboardTopics.txt
            $topicsHandle = fopen($topicsFile, "a");
            fwrite($topicsHandle, $topicName . "\n");
            fclose($topicsHandle);

            // Save topic details to ../Comment/{TopicName}.txt
            if (!file_exists($commentsDir)) {
                mkdir($commentsDir, 0777, true);
            }
            $topicHandle = fopen($topicFilePath, "w");
            fwrite($topicHandle, "<p><strong>คำอธิบาย:</strong> $topicDescription</p>\n");
            fwrite($topicHandle, "<p><strong>สร้างโดย:</strong> $creator</p>\n");
            fwrite($topicHandle, "<p><strong>วันเวลา:</strong> $timestamp</p>\n");
            fclose($topicHandle);

            echo "<p style='color: green;'>หัวข้อถูกสร้างเรียบร้อยแล้ว!</p>";
        }
    }
    ?>

    <form action="topics.php" method="post">
        <div class="form-group">
            <label for="topic_name">Topic Name:</label>
            <input type="text" id="topic_name" name="topic_name" required>
        </div>
        <div class="form-group">
            <label for="topic_description">Description:</label>
            <textarea id="topic_description" name="topic_description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="creator">Created By:</label>
            <input type="text" id="creator" name="creator" required>
        </div>
        <input type="submit" value="Create Topic">
    </form>

    <p style="text-align: center;">
        <a href="topicsList.php" class="link-button" style="display: inline-block; background-color: #4CAF50; color: white; padding: 14px 25px; text-align: center; text-decoration: none; border-radius: 5px;">View All Topics</a>
    </p>

</body>
</html>
