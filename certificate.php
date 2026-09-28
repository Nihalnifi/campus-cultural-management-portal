<?php
include("db.php");

if (isset($_POST['search'])) {
    $reg = $_POST['register_no'];

    $result = mysqli_query($conn, 
        "SELECT * FROM certificates WHERE register_no='$reg'");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Download Certificate</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>🎓 Download Certificate</h2>

<form method="POST">
    <input type="text" name="register_no" placeholder="Enter Register Number" required>
    <button type="submit" name="search">Search</button>
</form>

<br>

<?php if (isset($result) && mysqli_num_rows($result) > 0) { ?>
<table border="1" cellpadding="10">
<tr>
    <th>Student</th>
    <th>Event</th>
    <th>Certificate</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['student_name']; ?></td>
    <td><?php echo $row['event_name']; ?></td>
    <td>
        <a href="certificates/uploads/<?php echo $row['file_name']; ?>" download>
            Download
        </a>
    </td>
</tr>
<?php } ?>
</table>
<?php } ?>
</body>
</html>