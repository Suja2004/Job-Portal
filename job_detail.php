<?php
require './includes/db.php';

if (!isset($_GET['id'])) {
    die("Job ID is missing.");
}

$job_id = (int)$_GET['id'];
$stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ? AND status = 'Open'");
$stmt->bind_param("i", $job_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Job not found or is closed.");
}

$job = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <title><?= htmlspecialchars($job['title']) ?> - Job Details</title>
</head>

<body>
    <a href="index.php">← Back to Job Listings</a>
    <h1><?= htmlspecialchars($job['title']) ?></h1>
    <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
    <p><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>
    <p><strong>Skills:</strong> <?= htmlspecialchars($job['skills']) ?></p>
    <p><strong>Deadline:</strong> <?= htmlspecialchars($job['deadline']) ?></p>

    <hr>
    <p><strong>Description:</strong></p>
    <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>

    <br>
    <a href="../applications/apply.php?id=<?= $job['id'] ?>">
        <button>Apply Now</button>
    </a>
</body>

</html>