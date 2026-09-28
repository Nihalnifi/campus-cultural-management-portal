<?php
session_start();
include("../db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$msg = "";

if (isset($_POST['upload'])) {
    $name = $_POST['name'];

    $file = $_FILES['certificate']['name'];
    $tmp = $_FILES['certificate']['tmp_name'];

    move_uploaded_file($tmp, "../certificates/" . $file);

    $msg = "Certificate uploaded successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Certificate</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="header">Upload Certificate</div>

<div class="container">
    <div class="card">

        <?php if ($msg) echo "<p style='color:green'>$msg</p>"; ?>

        <form method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Participant Name" required>
            <input type="file" name="certificate" required>
            <button class="btn" name="upload">Upload</button>
        </form>

    </div>
</div>

</body>
</html>