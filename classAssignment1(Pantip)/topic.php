<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topic Details</title>
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
            padding: 30px;
            background-color: white;
            max-width: 1000px;
            margin: 40px auto;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .content h1 {
            color: #6c1e8c;
            font-size: 36px;
            margin-bottom: 20px;
        }

        .content h2 {
            color: #6c1e8c;
            font-size: 24px;
            margin-top: 30px;
        }

        .comment {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border-left: 5px solid #6c1e8c;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        .comment p {
            margin: 5px 0;
            font-size: 14px;
        }

        .comment p strong {
            color: #6c1e8c;
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

        <h2 style="color: #6c1e8c; font-size: 24px; font-weight: bold; text-align: center; margin-bottom: 20px;">Leave a Comment</h2>

        <form action="topic.php?name=<?= urlencode($topicName) ?>" method="post" style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #ffffff; border-radius: 10px;">
            <textarea name="comment" rows="4" required placeholder="Write your comment here..." style="width: 100%; padding: 12px; border-radius: 8px; border: 2px solid #ddd; font-size: 16px; margin-bottom: 20px; resize: none;"></textarea><br>

            <input type="text" name="creator" placeholder="Your Name" required style="width: 100%; padding: 12px; border-radius: 8px; border: 2px solid #ddd; font-size: 16px; margin-bottom: 20px;">

            <div style="text-align: center;">
                <input type="submit" value="Submit" style="background-color: #6c1e8c; color: white; padding: 12px 25px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease, transform 0.2s ease;">
            </div>
        </form>


        <p style="text-align: center;">
            <a href="topicsList.php" class="link-button" style="display: inline-block; background-color: #4CAF50; color: white; padding: 14px 25px; text-align: center; text-decoration: none; border-radius: 5px;">กลับหน้า TopicsList</a>
        </p>
    </div>

</body>

</html>