<?php
session_start();
include("../db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['submit'])) {

    $student_name = $_POST['student_name'];
    $register_no = $_POST['register_no'];
    $event_name = $_POST['event_name'];

    $file = $_FILES['certificate']['name'];
    $tmp = $_FILES['certificate']['tmp_name'];

    move_uploaded_file($tmp, "../certificates/uploads/" . $file);

    mysqli_query($conn, "INSERT INTO certificates 
        (student_name, register_no, event_name, file_name)
        VALUES ('$student_name','$register_no','$event_name','$file')");

    $msg = "✅ Certificate Uploaded Successfully";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Upload Certificate</title>
<link rel="stylesheet" href="../css/admin.css">
</head>
<body>

<h2>Upload Certificate</h2>

<?php if(isset($msg)) echo "<p style='color:green;'>$msg</p>"; ?>

<form method="POST" enctype="multipart/form-data">

<input type="text" name="student_name" placeholder="Student Name" required><br><br>

<input type="text" name="register_no" placeholder="Register Number" required><br><br>

<input type="text" name="event_name" placeholder="Event Name" required><br><br>

<input type="file" name="certificate" accept=".pdf" required><br><br>

<button type="submit" name="submit">Upload Certificate</button>

</form>

<br>
<a href="dashboard.php">⬅ Back</a>

</body>
</html>