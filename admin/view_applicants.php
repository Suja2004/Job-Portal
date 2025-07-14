<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require '../includes/db.php';

$job_id = $_GET['id'];
$job_stmt = $conn->prepare("SELECT title FROM jobs WHERE id = ?");
$job_stmt->bind_param("i", $job_id);
$job_stmt->execute();
$job_result = $job_stmt->get_result();
$job = $job_result->fetch_assoc();
$job_title = $job['title'] ?? 'Unknown Job';
$order = (isset($_GET['order']) && strtolower($_GET['order']) === 'desc') ? 'DESC' : 'ASC';
$toggle_order = ($order === 'ASC') ? 'desc' : 'asc';

$applicants = $conn->query("SELECT * FROM applications WHERE job_id = $job_id ORDER BY applied_at $order");

?>

<!DOCTYPE html>
<html>

<head>
    <title>Applicants</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <div class="header">
        <?php include '../includes/logo.php'; ?>
        <a href="logout.php">Logout</a>
    </div>
    <div class="dashboard">
        <h2>Applicants for: <?= htmlspecialchars($job_title) ?></h2>

        <div class="top-section">
            <a href="dashboard.php">Back to Dashboard</a>
            <a href="export_csv.php?id=<?= $job_id ?>">Export CSV</a>
        </div>
        <div class="table-wrapper">

            <table class="applicant-table">
                <thead>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Resume</th>
                    <th>
                        <a href="?id=<?= $job_id ?>&order=<?= $toggle_order ?>" style="color:#fff">Applied At
                            (<?= $order === 'ASC' ? '⬆️' : '⬇️' ?>)
                        </a>
                    </th>
                </thead>
                <tbody>
                    <?php while ($app = $applicants->fetch_assoc()): ?>
                        <tr>
                            <td><?= $app['full_name'] ?></td>
                            <td><a href="mailto:<?= $app['email'] ?>"><?= $app['email'] ?></a></td>
                            <td><?= $app['phone'] ?></td>
                            <td><a href="../resumes/<?= $app['resume'] ?>" download>Download</a></td>
                            <td><?= $app['applied_at'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>