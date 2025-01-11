<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create a Topic</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #743e8e;
            padding: 10px 20px;
            color: white;
        }

        .navbar .logo {
            font-size: 20px;
            font-weight: bold;
        }

        .navbar .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
            /* Adjust spacing between nav-links and user-profile */
        }

        .navbar .nav-links {
            display: flex;
            gap: 15px;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 16px;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .navbar .nav-links a:hover {
            background-color: #5e3073;
        }

        .navbar .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .content {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .content h1 {
            color: #743e8e;
        }

        .content .form-group {
            margin-bottom: 10px;
        }

        .content textarea,
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .content input[type="submit"] {
            background-color: #743e8e;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <div class="navbar">
        <div class="logo">Pannip</div>
        <div class="nav-right">
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a href="createTopic.php">Create</a>
                <a href="topicsList.php">List</a>
            </div>
            <div class="user-profile">
                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png" alt="User Profile">
            </div>
        </div>
    </div>

    <div class="content">

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
                fwrite($topicHandle, "<hr>\n");
                fclose($topicHandle);

                echo "<p style='color: green;'>หัวข้อถูกสร้างเรียบร้อยแล้ว!</p>";
            }
        }
        ?>

        <form action="createTopic.php" method="post">
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

    </div>
</body>

</html>