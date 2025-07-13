<?php
// Escape and sanitize output
function e($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Check admin login status
function require_admin()
{
    if (!isset($_SESSION['admin'])) {
        header("Location: login.php");
        exit;
    }
}

// Format date
function format_date($datetime)
{
    return date('d M Y, h:i A', strtotime($datetime));
}

// Check if resume is PDF
function is_pdf($file_type)
{
    return $file_type === 'application/pdf';
}
