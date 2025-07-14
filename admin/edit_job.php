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
    $salary_min = (int)$_POST['salary'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE jobs SET title=?, description=?, location=?, skills=?, salary_min=?, deadline=?, status=? WHERE id=?");
    $stmt->bind_param("ssssis si", $title, $desc, $location, $skills, $salary_min, $deadline, $status, $id);

    $stmt->execute();

    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Job</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <div class="editJobPage">
        <form method="POST" class="editJobForm">
            <h2>Edit Job</h2>

            <input name="title" value="<?= $job['title'] ?>" required>
            <textarea name="description" required><?= $job['description'] ?></textarea>
            <input name="skills" value="<?= $job['skills'] ?>" required>

            <div class="short-inputs">

                <input name="location" value="<?= $job['location'] ?>" required>
                <input name="salary" type="number" value="<?= $job['salary_min'] ?>" required>
            </div>
            <div class="date-input">
                <label for="deadline">Deadline:</label>
                <input name="deadline" type="date" value="<?= $job['deadline'] ?>" required>
            </div>
            <div class="status">
                <label for="status">Status:</label>
                <select name="status">
                    <option value="Open" <?= $job['status'] === 'Open' ? 'selected' : '' ?>>Open</option>
                    <option value="Closed" <?= $job['status'] === 'Closed' ? 'selected' : '' ?>>Closed</option>
                </select>
            </div>
            <div class="form-actions">
                <button type="button" onclick="window.history.back()">Cancel</button>
                <button type="submit">Update Job</button>

        </form>
    </div>
</body>

</html>