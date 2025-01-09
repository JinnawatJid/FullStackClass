<style>
    <?php include 'style.css'; ?>
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pantip</title>
</head>

<body>
    <header>
        <h1>Pantip</h1>
    </header>
    <main>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $topicName = trim($_POST['topic_name']);
            $topicDescription = trim($_POST['topic_description']);
            $creator = trim($_POST['creator']);
            $timestamp = date("Y-m-d H:i:s");

            if (empty($topicName) || empty($creator) || empty($topicDescription)) {
                echo "<p style='color: red;'>กรุณากรอกข้อมูลให้ครบถ้วน!</p>";
            } elseif (strlen($topicDescription) > 10000) {
                echo "<p style='color: red;'>คำอธิบายต้องไม่เกิน 10,000 ตัวอักษร!</p>";
            } else {
                $fs = fopen("webboard.txt", "a");
                fputs($fs, "<div class='message'>");
                fputs($fs, "<p><strong>หัวข้อ:</strong> $topicName</p>\n");
                fputs($fs, "<p><strong>คำอธิบาย:</strong> $topicDescription</p>\n");
                fputs($fs, "<p><strong>สร้างโดย:</strong> $creator</p>\n");
                fputs($fs, "<p><strong>วันเวลา:</strong> $timestamp</p>\n");
                fputs($fs, "<hr></div>\n");
                fclose($fs);
                echo "<p style='color: green;'>หัวข้อถูกโพสต์เรียบร้อยแล้ว!</p>";
            }
        }

        if (file_exists("webboard.txt")) {
            $fs = fopen("webboard.txt", "r");
            echo "<h2>หัวข้อที่ถูกสร้าง</h2>";
            fpassthru($fs);
            fclose($fs);
        } else {
            echo "<p>ยังไม่มีหัวข้อที่ถูกสร้าง</p>";
        }
        ?>

        <form action="webboard.php" method="post">
            <label for="topic_name">ชื่อหัวข้อ:</label>
            <input type="text" id="topic_name" name="topic_name" required>

            <label for="topic_description">คำอธิบาย:</label>
            <textarea id="topic_description" name="topic_description" rows="4" required></textarea>

            <label for="creator">สร้างโดย:</label>
            <input type="text" id="creator" name="creator" required>

            <input type="submit" value="สร้างหัวข้อ">
            <input type="reset" value="ยกเลิก">
        </form>
    </main>
    <footer>
        <p>&copy; 2025 Pantip Clone</p>
    </footer>
</body>

</html>