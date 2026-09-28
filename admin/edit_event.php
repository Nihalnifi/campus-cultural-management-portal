<?php
session_start();
include("../db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($conn, "SELECT * FROM events WHERE id=$id");
    $row = mysqli_fetch_assoc($result);
} else {
    echo "No ID Found!";
    exit();
}

if (isset($_POST['update'])) {

    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];

    mysqli_query($conn, "UPDATE events SET 
        event_name='$event_name',
        event_date='$event_date',
        event_time='$event_time'
        WHERE id=$id");

    header("Location: view_events.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Event</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: white;
            padding: 30px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input:focus {
            border-color: #667eea;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #28a745;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background: #218838;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 10px;
            text-decoration: none;
            color: #555;
        }

        .back:hover {
            color: #000;
        }
    </style>
</head>

<body>

<div class="form-container">
    <h2>Edit Event</h2>

    <form method="POST">
        <label>Event Name</label>
        <input type="text" name="event_name"
               value="<?php echo $row['event_name']; ?>" required>

        <label>Event Date</label>
        <input type="date" name="event_date"
               value="<?php echo $row['event_date']; ?>" required>

        <label>Event Time</label>
        <input type="time" name="event_time"
               value="<?php echo $row['event_time']; ?>" required>

        <button type="submit" name="update" class="btn">
            Update Event
        </button>
    </form>

    <a href="view_events.php" class="back">← Back to Events</a>
</div>

</body>
</html>