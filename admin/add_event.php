<?php
include("../db.php");

if(isset($_POST['submit'])){
    $event_name = $_POST['event_name'];
    $event_date = $_POST['event_date'];
    $event_time = $_POST['event_time'];
    $event_location = $_POST['event_location'];

    $query = "INSERT INTO events (event_name, event_date, event_time, venue)
              VALUES ('$event_name','$event_date','$event_time','$event_location')";

    mysqli_query($conn, $query);
    echo "<script>alert('Event Added Successfully');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>

    <style>
        body{
            margin:0;
            padding:0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4e73df, #1cc88a);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .container{
            background:#fff;
            padding:40px;
            width:400px;
            border-radius:15px;
            box-shadow:0 10px 25px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            margin-bottom:25px;
            color:#333;
        }

        .form-group{
            margin-bottom:15px;
        }

        label{
            font-weight:bold;
            display:block;
            margin-bottom:5px;
        }

        input{
            width:100%;
            padding:10px;
            border-radius:8px;
            border:1px solid #ccc;
            transition:0.3s;
        }

        input:focus{
            border-color:#4e73df;
            outline:none;
            box-shadow:0 0 5px rgba(78,115,223,0.5);
        }

        .btn{
            width:100%;
            padding:12px;
            background:#4e73df;
            border:none;
            color:#fff;
            font-size:16px;
            border-radius:8px;
            cursor:pointer;
            transition:0.3s;
        }

        .btn:hover{
            background:#2e59d9;
        }

        .back-link{
            text-align:center;
            margin-top:15px;
        }

        .back-link a{
            text-decoration:none;
            color:#4e73df;
            font-weight:bold;
        }

        .back-link a:hover{
            text-decoration:underline;
        }

    </style>
</head>
<body>

<div class="container">
    <h2>Add New Event</h2>

    <form method="POST">
        <div class="form-group">
            <label>Event Name</label>
            <input type="text" name="event_name" required>
        </div>

        <div class="form-group">
            <label>Event Date</label>
            <input type="date" name="event_date" required>
        </div>

        <div class="form-group">
            <label>Event Time</label>
            <input type="time" name="event_time" required>
        </div>

        <div class="form-group">
            <label>Event Location</label>
            <input type="text" name="event_location" required>
        </div>

        <button type="submit" name="submit" class="btn">Add Event</button>
    </form>

    <div class="back-link">
        <a href="dashboard.php">← Back to Dashboard</a>
    </div>
</div>

</body>
</html>