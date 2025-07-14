<?php
require '../includes/db.php';

$job_id = $_GET['id'];
$job = $conn->query("SELECT * FROM jobs WHERE id=$job_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Apply - <?= htmlspecialchars($job['title']) ?></title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>

    <form class="applyForm" id="applyForm" method="POST" enctype="multipart/form-data">
        <h2>Apply for <?= htmlspecialchars($job['title']) ?> Position</h2>
        <input type="hidden" name="job_id" value="<?= $job_id ?>">
        <input name="full_name" placeholder="Full Name" required>
        <input name="email" type="email" placeholder="Email" required>
        <input name="phone" placeholder="Phone" required>
        <div class="file-input">
            <label for="resume-upload" class="custom-file-label">Upload Resume (PDF)</label>
            <input type="file" id="resume-upload" name="resume" accept="application/pdf" required>
        </div>
        <div class="form-actions">
            <button type="button" onclick="window.history.back()">Cancel</button>
            <button type="submit">Submit Application</button>
        </div>

    </form>

    <script>
        document.getElementById("applyForm").addEventListener("submit", function(e) {
            e.preventDefault();
            const form = e.target;
            const formData = new FormData(form);

            fetch("submit_application.php", {
                    method: "POST",
                    body: formData
                }).then(res => res.text())
                .then(data => {
                    alert(data);
                    form.reset();
                }).catch(err => {
                    alert("Submission failed.");
                    console.error(err);
                });
        });
    </script>

</body>

</html>