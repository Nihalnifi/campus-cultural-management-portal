<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include("../db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['upload'])) {

    $event_id = $_POST['event_id'];
    $participant_name = $_POST['participant_name'];

    if (!empty($_FILES['certificate']['name'])) {

        $file_name = $_FILES['certificate']['name'];
        $temp_name = $_FILES['certificate']['tmp_name'];

        $new_file_name = time() . "_" . $file_name;
        $folder = "../certificates/" . $new_file_name;

        // Create folder if not exists
        if (!is_dir("../certificates")) {
            mkdir("../certificates", 0777, true);
        }

        if (move_uploaded_file($temp_name, $folder)) {

            $query = "INSERT INTO certificates (event_id, participant_name, certificate_file)
                      VALUES ('$event_id', '$participant_name', '$new_file_name')";

            if (mysqli_query($conn, $query)) {
                header("Location: dashboard.php");
                exit();
            } else {
                die("Database Error: " . mysqli_error($conn));
            }

        } else {
            die("File Upload Failed.");
        }

    } else {
        die("Please select a file.");
    }
}

$events = mysqli_query($conn, "SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload Certificate</title>
    <style>
        body {
            font-family: Arial;
            background: linear-gradient(to right, #43cea2, #185a9d);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-box {
            background: white;
            padding: 30px;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
        }

        label {
            font-weight: bold;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
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
    </style>
</head>

<body>

<div class="form-box">
    <h2>Upload Certificate</h2>

    <form method="POST" enctype="multipart/form-data">

        <label>Select Event</label>
        <select name="event_id" required>
            <option value="">-- Select Event --</option>
            <?php while ($row = mysqli_fetch_assoc($events)) { ?>
                <option value="<?php echo $row['id']; ?>">
                    <?php echo $row['event_name']; ?>
                </option>
            <?php } ?>
        </select>

        <label>Participant Name</label>
        <input type="text" name="participant_name" required>

        <label>Upload Certificate</label>
        <input type="file" name="certificate" required>

        <button type="submit" name="upload" class="btn">
            Upload Certificate
        </button>

    </form>

    <a href="dashboard.php" class="back">← Back to Dashboard</a>
</div>

</body>
</html>