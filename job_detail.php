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
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <div class="header">
        <?php include './includes/logo.php'; ?>
    </div>
    <a href="index.php" class="return-link">← Back to Job Listings</a>
    <div class="container">
        <div class="details" id="job-details">
            <h1><?= htmlspecialchars($job['title']) ?></h1>
            <div class="details-list">
                <p>Location: <?= htmlspecialchars($job['location']) ?></p>
                <p>Salary: ₹<?= htmlspecialchars($job['salary_min']) ?></p>
                <p>Skills: <?= htmlspecialchars($job['skills']) ?></p>
                <p>Deadline: <?= date("d M Y", strtotime($job['deadline'])) ?></p>
            </div>
        </div>
        <div class="apply" id="apply-section">
            <h2>Interested in this job?</h2>
            <p>Click the button below to apply.</p>
            <a href="../applications/apply.php?id=<?= $job['id'] ?>">
                <button>Apply Now</button>
            </a>
        </div>
        <div class="description" id="job-description">
            <h2>Description:</h2>
            <p><?= nl2br(htmlspecialchars($job['description'])) ?></p>
        </div>
    </div>
</body>

</html>