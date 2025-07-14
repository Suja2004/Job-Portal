<?php
require './includes/db.php';

// Filter values
$location = $_GET['location'] ?? '';
$salary = $_GET['salary'] ?? '';
$keyword = $_GET['keyword'] ?? '';
$deadline = $_GET['deadline'] ?? '';
$limit = 8;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM jobs WHERE status = 'Open'";
$params = [];

if ($location !== '') {
    $sql .= " AND location LIKE ?";
    $params[] = "%$location%";
}
if ($salary !== '') {
    $sql .= " AND salary_min >= ?";
    $params[] = (int)$salary;
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
    <title>Job Portal</title>
    <link rel="stylesheet" href="./assets/styles.css">
</head>

<body>
    <div class="header">
        <?php include './includes/logo.php'; ?>
        <p>
            <a href="./admin/dashboard.php">
                Post a Job
            </a>
        </p>
    </div>

    <form method="GET" class="filter-form">
        <input type="text" name="location" placeholder="Location" value="<?= htmlspecialchars($location) ?>">
        <input type="number" name="salary" placeholder="Minimum Salary" value="<?= htmlspecialchars($salary) ?>">
        <input type="text" name="keyword" placeholder="Keyword" value="<?= htmlspecialchars($keyword) ?>">
        <div class="filter-buttons">
            <button type="submit">Filter</button>
            <button><a href="/index.php">Reset</a></button>
        </div>
    </form>

    <br>
    <div class="job-list">
        <?php if ($result->num_rows === 0): ?>
            <p>No jobs found.</p>
        <?php else: ?>
            <?php while ($job = $result->fetch_assoc()): ?>
                <div class="job-item">
                    <div class="title">
                        <h2><?= htmlspecialchars($job['title']) ?></h2>
                        <p><?= date("d M Y", strtotime($job['deadline'])) ?></p>
                    </div>
                    <p><strong>Location:</strong> <?= htmlspecialchars($job['location']) ?></p>
                    <p><strong>Salary:</strong> ₹<?= number_format($job['salary_min']) ?></p>
                    <p><strong>Skills:</strong> <?= htmlspecialchars($job['skills']) ?></p>
                    <a href="job_detail.php?id=<?= $job['id'] ?>">View Details & Apply</a>
                </div>
            <?php endwhile; ?>
    </div>
    <?php if ($total_pages > 1): ?>
        <div class="pagination">
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