<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $location = $_POST['location'];
    $skills = $_POST['skills'];
    $salary = $_POST['salary'];
    $deadline = $_POST['deadline'];

    $stmt = $conn->prepare("INSERT INTO jobs (title, description, location, skills, salary, deadline) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $title, $desc, $location, $skills, $salary, $deadline);
    $stmt->execute();
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Job</title>
</head>

<body>
    <h2>Add New Job</h2>
    <form method="POST">
        <input name="title" placeholder="Job Title" required><br><br>
        <textarea name="description" placeholder="Description" required></textarea><br><br>
        <input name="location" placeholder="Location" required><br><br>
        <input name="skills" placeholder="Skills" required><br><br>
        <input name="salary" placeholder="Salary" required><br><br>
        <input name="deadline" type="date" required><br><br>
        <button type="submit">Add Job</button>
    </form>
</body>

</html>