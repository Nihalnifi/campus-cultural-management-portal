<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

// Safe check for GET parameter
if(isset($_GET['id']) && !empty($_GET['id'])){
    $id = $_GET['id'];

    $fetch = mysqli_query($conn, "SELECT * FROM registrations WHERE id='$id'");
    $row = mysqli_fetch_assoc($fetch);

    if(!$row){
        echo "Registration not found!";
        exit();
    }

} else {
    echo "No ID Found!";
    exit();
}

// Handle form submission
if(isset($_POST['update'])){
    $name = $_POST['name'];
    $department = $_POST['department'];
    $email = $_POST['email'];
    $event_id = $_POST['event'];

    $event_query = mysqli_query($conn, "SELECT event_name FROM events WHERE id='$event_id'");
    $event_row = mysqli_fetch_assoc($event_query);
    $event_name = $event_row['event_name'];

    mysqli_query($conn, "UPDATE registrations SET 
        name='$name',
        department='$department',
        email='$email',
        event_name='$event_name'
        WHERE id='$id'");

    echo "<script>alert('Updated Successfully'); window.location='view_registration.php';</script>";
}

// Fetch events for dropdown
$events_result = mysqli_query($conn, "SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background: #fff;
            border-radius: 15px;
            padding: 30px 40px;
            width: 500px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: fadeIn 0.8s ease-in-out;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-weight: 600;
        }

        input, select {
            width: 100%;
            padding: 12px 15px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        input:focus, select:focus {
            border-color: #667eea;
            box-shadow: 0 0 8px rgba(102,126,234,0.3);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(90deg, #667eea, #764ba2);
            border: none;
            border-radius: 10px;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102,126,234,0.4);
        }

        .dashboard-btn {
            display: block;
            text-align: center;
            padding: 12px;
            margin-top: 15px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .dashboard-btn:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40,167,69,0.4);
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(-20px);}
            100% { opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Registration</h2>
    <form method="post">
        <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" placeholder="Name" required>
        
        <select name="department" required>
            <option value="">-- Select Department --</option>
            <option value="BSC IT" <?= $row['department']=='BSC IT'?'selected':'' ?>>BSC IT</option>
            <option value="BSC BOT" <?= $row['department']=='BSC BOT'?'selected':'' ?>>BSC BOT</option>
            <option value="BSW" <?= $row['department']=='BSW'?'selected':'' ?>>BSW</option>
            <option value="BCA" <?= $row['department']=='BCA'?'selected':'' ?>>BCA</option>
            <option value="BA ENG" <?= $row['department']=='BA ENG'?'selected':'' ?>>BA ENG</option>
        </select>
        
        <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" placeholder="Email" required>
        
        <select name="event" required>
            <option value="">-- Select Event --</option>
            <?php while($event = mysqli_fetch_assoc($events_result)) { ?>
                <option value="<?= $event['id'] ?>" <?= $event['event_name']==$row['event_name']?'selected':'' ?>><?= $event['event_name'] ?></option>
            <?php } ?>
        </select>
        
        <button type="submit" name="update">Update Registration</button>
    </form>

    <a href="view_registration.php" class="dashboard-btn"> Return to Dashboard</a>
</div>

</body>
</html>