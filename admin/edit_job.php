<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require '../includes/db.php';

$id = $_GET['id'];
$job = $conn->query("SELECT * FROM jobs WHERE id = $id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $location = $_POST['location'];
    $skills = $_POST['skills'];
    $salary = $_POST['salary'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE jobs SET title=?, description=?, location=?, skills=?, salary=?, deadline=?, status=? WHERE id=?");
    $stmt->bind_param("sssssssi", $title, $desc, $location, $skills, $salary, $deadline, $status, $id);
    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Job</title>
</head>

<body>
    <h2>Edit Job</h2>
    <form method="POST">
        <input name="title" value="<?= $job['title'] ?>" required><br><br>
        <textarea name="description" required><?= $job['description'] ?></textarea><br><br>
        <input name="location" value="<?= $job['location'] ?>" required><br><br>
        <input name="skills" value="<?= $job['skills'] ?>" required><br><br>
        <input name="salary" value="<?= $job['salary'] ?>" required><br><br>
        <input name="deadline" type="date" value="<?= $job['deadline'] ?>" required><br><br>
        <select name="status">
            <option value="Open" <?= $job['status'] === 'Open' ? 'selected' : '' ?>>Open</option>
            <option value="Closed" <?= $job['status'] === 'Closed' ? 'selected' : '' ?>>Closed</option>
        </select><br><br>
        <button type="submit">Update Job</button>
    </form>
</body>

</html>