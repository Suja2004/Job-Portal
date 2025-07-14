<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require '../includes/db.php';
require '../includes/functions.php';
require_admin();

$result = $conn->query("SELECT * FROM jobs ORDER BY created_at DESC");

// Get applicant count per job
$applicant_counts = [];
$counts_result = $conn->query("SELECT job_id, COUNT(*) as count FROM applications GROUP BY job_id");
while ($row = $counts_result->fetch_assoc()) {
    $applicant_counts[$row['job_id']] = $row['count'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <div class="header">
        <?php include '../includes/logo.php'; ?>
        <a href="logout.php">Logout</a>
    </div>
    <div class="dashboard">
        <div class="top-section">
            <h2 class="title">Admin Dashboard</h2>
            <a href="add_job.php" class="add-job-link">Add New Job</a>
        </div>

        <div class="table-wrapper">
            <table class="job-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Location</th>
                        <th>Status</th>
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td><?= htmlspecialchars($row['location']) ?></td>
                            <td><?= $row['status'] ?></td>
                            <td><?= date("d M Y", strtotime($row['deadline'])) ?></td>
                            <td class="actions">
                                <a href="edit_job.php?id=<?= $row['id'] ?>" title="Edit">📝</a>
                                <a href="delete_job.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this job?')" title="Delete">🗑️</a>
                                <a href="view_applicants.php?id=<?= $row['id'] ?>" title="View Applicants">
                                    👁️ (<?= $applicant_counts[$row['id']] ?? 0 ?>)
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>



</body>

</html>