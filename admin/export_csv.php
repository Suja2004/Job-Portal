<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require '../includes/db.php';

$job_id = $_GET['id'];
$results = $conn->query("SELECT full_name, email, phone, resume, applied_at FROM applications WHERE job_id = $job_id");

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="applicants_job_' . $job_id . '.csv"');

$output = fopen("php://output", "w");
fputcsv($output, ['Name', 'Email', 'Phone', 'Resume File', 'Applied At']);

while ($row = $results->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit;
