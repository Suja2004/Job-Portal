<?php
require '../includes/db.php';

$job_id = $_GET['id'];
$job = $conn->query("SELECT * FROM jobs WHERE id=$job_id")->fetch_assoc();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Apply - <?= htmlspecialchars($job['title']) ?></title>
</head>

<body>
    <h2>Apply for <?= htmlspecialchars($job['title']) ?></h2>
    <form id="applyForm" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="job_id" value="<?= $job_id ?>">
        <input name="full_name" placeholder="Full Name" required><br><br>
        <input name="email" type="email" placeholder="Email" required><br><br>
        <input name="phone" placeholder="Phone" required><br><br>
        <input type="file" name="resume" accept="application/pdf" required><br><br>
        <button type="submit">Submit Application</button>
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
                    alert(data); // or use a modal
                    form.reset(); // clear form
                }).catch(err => {
                    alert("Submission failed.");
                    console.error(err);
                });
        });
    </script>

</body>

</html>