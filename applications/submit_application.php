<?php
header("Content-Type: text/plain");

require '../includes/db.php';
require '../includes/functions.php';

$job_id = $_POST['job_id'];
$name = $_POST['full_name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$resume = $_FILES['resume'];

if (!is_pdf($_FILES['resume']['type'])) {
    die("Only PDF files are allowed.");
}

// Prevent duplicate application
$check = $conn->prepare("SELECT * FROM applications WHERE job_id = ? AND email = ?");
$check->bind_param("is", $job_id, $email);
$check->execute();
$exists = $check->get_result()->fetch_assoc();

if ($exists) {
    die("You’ve already applied for this job.");
}

// Save file
$filename = time() . '_' . basename($resume['name']);
$target = "../resumes/" . $filename;
move_uploaded_file($resume['tmp_name'], $target);

// Insert record
$stmt = $conn->prepare("INSERT INTO applications (job_id, full_name, email, phone, resume) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("issss", $job_id, $name, $email, $phone, $filename);
$stmt->execute();

echo "Application submitted successfully!";
