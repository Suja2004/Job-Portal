<?php
require './includes/db.php';

// Filter values
$location = $_GET['location'] ?? '';
$salary = $_GET['salary'] ?? '';
$keyword = $_GET['keyword'] ?? '';
$limit = 5;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM jobs WHERE status = 'Open'";
$params = [];

if ($location !== '') {
    $sql .= " AND location LIKE ?";
    $params[] = "%$location%";
}
if ($salary !== '') {
    $sql .= " AND salary >= ?";
    $params[] = $salary;
}
if ($keyword !== '') {
    $sql .= " AND (title LIKE ? OR description LIKE ? OR skills LIKE ?)";
    $params[] = "%$keyword%";
    $params[] = "%$keyword%";
    $params[] = "%$keyword%";
}

$sql .= " LIMIT $limit OFFSET $offset";

$stmt = $conn->prepare($sql);

$types = str_repeat("s", count($params));
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();

$total_result = $conn->query("SELECT FOUND_ROWS() AS total")->fetch_assoc();
$total_jobs = $total_result['total'];
$total_pages = ceil($total_jobs / $limit);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Job Listings</title>
</head>

<body>
    <h1>Available Jobs</h1>
    <p>
        <a href="./admin/login.php">
            <button>Post a Job</button>
        </a>
    </p>

    <form method="GET">
        <input type="text" name="location" placeholder="Location" value="<?= htmlspecialchars($location) ?>">
        <input type="number" name="salary" placeholder="Minimum Salary" value="<?= htmlspecialchars($salary) ?>">
        <input type="text" name="keyword" placeholder="Keyword" value="<?= htmlspecialchars($keyword) ?>">
        <button type="submit">Filter</button>
        <a href="index.php">Reset</a>
    </form>

    <br>

    <?php if ($result->num_rows === 0): ?>
        <p>No jobs found.</p>
    <?php else: ?>
        <?php while ($job = $result->fetch_assoc()): ?>
            <div style="border:1px solid #ccc; padding:10px; margin:10px 0;">
                <h2><?= htmlspecialchars($job['title']) ?></h2>
                <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
                <p><strong>Salary:</strong> <?= htmlspecialchars($job['salary']) ?></p>
                <p><strong>Skills:</strong> <?= htmlspecialchars($job['skills']) ?></p>
                <p><?= nl2br(htmlspecialchars(substr($job['description'], 0, 150))) ?>...</p>
                <a href="job_detail.php?id=<?= $job['id'] ?>">View Details & Apply</a>
            </div>
        <?php endwhile; ?>
        <?php if ($total_pages > 1): ?>
            <div style="margin-top:20px;">
                <?php if ($page > 1): ?>
                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>">← Prev</a>
                <?php endif; ?>
                Page <?= $page ?> of <?= $total_pages ?>
                <?php if ($page < $total_pages): ?>
                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>">Next →</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    <?php endif; ?>
</body>

</html>