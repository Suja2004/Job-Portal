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
    $salary_min = (int)$_POST['salary_min'];
    $deadline = $_POST['deadline'];

    $stmt = $conn->prepare("INSERT INTO jobs (title, description, location, skills, salary_min , deadline) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssis", $title, $desc, $location, $skills, $salary_min, $deadline);
    $stmt->execute();
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Job</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <div class="addJobPage">
        <form method="POST" class="addJobForm">
            <h2>Add New Job</h2>

            <input name="title" placeholder="Job Title" required>
            <textarea name="description" placeholder="Description" required></textarea>
            <input name="skills" placeholder="Skills" required>

            <div class="short-inputs">
                <input name="location" placeholder="Location" required>
                <input name="salary_min" type="number" placeholder="Minimum Salary (e.g. 500000)" required>
            </div>
            <div class="date-input">
                <label for="deadline">Deadline:</label>
                <input name="deadline" type="date" required>
            </div>
            <div class="form-actions">
                <button type="button" onclick="window.history.back()">Cancel</button>
                <button type="submit">Add Job</button>
            </div>

        </form>
    </div>
</body>

</html>