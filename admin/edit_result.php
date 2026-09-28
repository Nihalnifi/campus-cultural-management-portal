<?php
session_start();
include("../db.php");

// Admin session check
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Check if ID exists
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = mysqli_query($conn, "SELECT * FROM results WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "Result not found!";
        exit();
    }
} else {
    echo "No ID found!";
    exit();
}

// Update result
if (isset($_POST['update'])) {

    $name = $_POST['name'];
    $event = $_POST['event'];
    $position = $_POST['position'];

    mysqli_query($conn, "UPDATE results SET 
        participant_name='$name',
        event_name='$event',
        position='$position'
        WHERE id='$id'
    ");

    echo "<script>
            alert('Result Updated Successfully!');
            window.location='view_results.php';
          </script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 450px;
            margin: 80px auto;
        }

        .card {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        .card h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus,
        select:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 5px rgba(102,126,234,0.5);
        }

        .btn {
            width: 100%;
            padding: 10px;
            background: #667eea;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background: #5a67d8;
        }

        .back-btn {
            text-align: center;
            margin-top: 15px;
        }

        .back-btn a {
            text-decoration: none;
            color: #667eea;
            font-weight: bold;
        }

        .back-btn a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <h2>✏ Edit Result</h2>

        <form method="POST">

            <div class="form-group">
                <label>Participant Name</label>
                <input type="text" name="name" 
                value="<?php echo $row['participant_name']; ?>" required>
            </div>

            <div class="form-group">
                <label>Event</label>
                <input type="text" name="event" 
                value="<?php echo $row['event_name']; ?>" required>
            </div>

            <div class="form-group">
                <label>Position</label>
                <select name="position" required>
                    <option value="1st" <?php if($row['position']=="1st") echo "selected"; ?>>1st</option>
                    <option value="2nd" <?php if($row['position']=="2nd") echo "selected"; ?>>2nd</option>
                    <option value="3rd" <?php if($row['position']=="3rd") echo "selected"; ?>>3rd</option>
                </select>
            </div>

            <button type="submit" name="update" class="btn">
                Update Result
            </button>

        </form>

        <div class="back-btn">
            <a href="view_results.php">← Back to Results</a>
        </div>

    </div>
</div>

</body>
</html>