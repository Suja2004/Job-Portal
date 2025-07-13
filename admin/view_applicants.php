<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require '../includes/db.php';

$job_id = $_GET['id'];
$applicants = $conn->query("SELECT * FROM applications WHERE job_id = $job_id ORDER BY applied_at DESC");
?>

<!DOCTYPE html>
<html>

<head>
    <title>Applicants</title>
</head>

<body>
    <h2>Applicants for Job ID <?= $job_id ?></h2>
    <a href="dashboard.php">Back to Dashboard</a> |
    <a href="export_csv.php?id=<?= $job_id ?>">Export CSV</a>
    <table border="1" cellpadding="6">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Resume</th>
            <th>Applied At</th>
        </tr>
        <?php while ($app = $applicants->fetch_assoc()): ?>
            <tr>
                <td><?= $app['full_name'] ?></td>
                <td><?= $app['email'] ?></td>
                <td><?= $app['phone'] ?></td>
                <td><a href="../resumes/<?= $app['resume'] ?>" download>Download</a></td>
                <td><?= $app['applied_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>