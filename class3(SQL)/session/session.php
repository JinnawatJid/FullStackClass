<?php 
session_start();
$_SESSION['ktp'] = "KTP test";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h5>test variable session</h5>
    <form method="post" action="session2.php">
        <input type="radio" name="choice" value="1"> Show session var <br>
        <input type="radio" name="choice" value="2"> Destroy session var <br>
        <input type="submit" value="OK">
    </form>
</body>
</html>