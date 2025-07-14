<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin'] = true;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <div class="loginPage">

        <div class="header">
            <?php include '../includes/logo.php'; ?>
        </div>
        <form method="POST" class="loginForm">
            <h2>Admin Login</h2>
            <?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
            <input name="username" placeholder="Username" required><br><br>
            <input name="password" type="password" placeholder="Password" required><br><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>