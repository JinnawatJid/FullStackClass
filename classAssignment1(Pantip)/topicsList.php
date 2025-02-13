<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topics List</title>
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
        }

        .content h1 {
            color: #743e8e;
        }

        .content .topic-link {
            display: block;
            padding: 10px;
            margin: 10px 0;
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 5px;
            text-decoration: none;
            color: #743e8e;
        }

        .content .topic-link:hover {
            background-color: #f1f1f1;
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
            <a href="createTopic.php" class="link-button" style="display: inline-block; background-color: #4CAF50; color: white; padding: 14px 25px; text-align: center; text-decoration: none; border-radius: 5px;">กลับหน้า CreateTopic</a>
        </p>
    </div>

</body>

</html>