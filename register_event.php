<?php
// Database connection
include("db.php");

// Fetch all events
$events = mysqli_query($conn, "SELECT * FROM events");

// Handle form submission
if (isset($_POST['submit'])) {

    $student_name = $_POST['student_name'];
    $register_no  = $_POST['register_no'];
    $department   = $_POST['department'];
    $event_id     = $_POST['event_id'];

    $insert = "INSERT INTO event_registrations 
               (student_name, register_no, department, event_id) 
               VALUES ('$student_name', '$register_no', '$department', '$event_id')";

    if (mysqli_query($conn, $insert)) {
        $msg = "✅ Registration Successful!";
    } else {
        $msg = "❌ Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Event Registration</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<h2>Student Event Registration</h2>

<?php if (isset($msg)) { ?>
    <p style="color:green;"><?php echo $msg; ?></p>
<?php } ?>

<form method="POST">

    <input type="text" name="student_name" placeholder="Student Name" required><br><br>

    <input type="text" name="register_no" placeholder="Register Number" required><br><br>

    <input type="text" name="department" placeholder="Department" required><br><br>

    <select name="event_id" required>
        <option value="">-- Select Event --</option>
        <?php while ($row = mysqli_fetch_assoc($events)) { ?>
            <option value="<?php echo $row['id']; ?>">
                <?php echo $row['event_name']; ?>
            </option>
        <?php } ?>
    </select><br><br>

    <button type="submit" name="submit">Register</button>

</form>

<br>
<a href="index.php">⬅ Back to Home</a>

</body>
</html>