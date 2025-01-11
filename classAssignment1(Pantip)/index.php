<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannip Home</title>
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

        /* Main content styles */
        h1 {
            color: #743e8e;
            text-align: center;
            margin-top: 50px;
        }

        .button {
            display: inline-block;
            padding: 15px 30px;
            margin: 10px;
            font-size: 16px;
            color: white;
            background-color: #743e8e;
            text-decoration: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #5e3073;
        }

        .content {
            text-align: center;
            margin-top: 20px;
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

    <!-- Main Content -->
    <div class="content">
        <h1>Welcome to the Pannip!</h1>

        <a href="createTopic.php" class="button">Create a New Topic</a>
        <a href="topicsList.php" class="button">View All Topics</a>
    </div>
</body>

</html>