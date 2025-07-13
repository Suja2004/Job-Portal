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
</head>

<body>
    <h2>Job Listings</h2>
    <a href="add_job.php">Add New Job</a> | <a href="logout.php">Logout</a>
    <table border="1" cellpadding="8">
        <tr>
            <th>Title</th>
            <th>Location</th>
            <th>Status</th>
            <th>Deadline</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['location']) ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['deadline'] ?></td>
                <td>
                    <a href="edit_job.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete_job.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this job?')">Delete</a> |
                    <a href="view_applicants.php?id=<?= $row['id'] ?>">
                        Applicants (<?= $applicant_counts[$row['id']] ?? 0 ?>)
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>