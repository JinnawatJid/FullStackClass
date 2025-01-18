<?php
// Start the session
session_start();

// Define mock-up users for demonstration
$users = [
    'user' => ['password' => 'userpassword', 'role' => 'user'],
    'admin' => ['password' => 'adminpassword', 'role' => 'admin']
];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? '';

    // Check if the role and credentials are correct
    if (isset($users[$username]) && $users[$username]['password'] == $password && $users[$username]['role'] == $role) {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        if ($role == 'user') {
            header('Location: catalog.php'); // Redirect to catalog page
        } else {
            header('Location: transactionDashboard.php'); // Redirect to transaction dashboard page
        }
        exit;
    } else {
        $error_message = "Invalid credentials or role!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 50px; }
        .container { max-width: 300px; margin: 0 auto; }
        input, select { width: 100%; padding: 10px; margin-bottom: 10px; }
        button { width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .error { color: red; }
    </style>
</head>
<body>

<div class="container">
    <h2>Login</h2>
    <?php if (isset($error_message)) { echo '<p class="error">' . $error_message . '</p>'; } ?>
    
    <form action="login.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
