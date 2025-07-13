<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}
require '../includes/db.php';

$id = $_GET['id'];
$conn->query("DELETE FROM jobs WHERE id = $id");

header("Location: dashboard.php");
exit;
