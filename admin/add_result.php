<?php
session_start();
include("../db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../phpmailer/src/Exception.php';
require '../phpmailer/src/PHPMailer.php';
require '../phpmailer/src/SMTP.php';

if (!isset($_SESSION['admin'])) {
    header("Location: ../login.php");
    exit();
}

$msg = "";

if (isset($_POST['submit'])) {

    $event_name = $_POST['event_name'];
    $participant_name = $_POST['participant_name'];
    $email = $_POST['email'];
    $position = $_POST['position'];

    // Insert into database
    $query = "INSERT INTO results (event_name, participant_name, email, position)
              VALUES ('$event_name', '$participant_name', '$email', '$position')";

    if (mysqli_query($conn, $query)) {

        // Send Email
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'yourgmail@gmail.com';      // 🔴 Your Gmail
            $mail->Password   = 'your_app_password';        // 🔴 Gmail App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('yourgmail@gmail.com', 'Kalaithiruvizha');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = "Congratulations! You are a Winner 🎉";
            $mail->Body    = "
                Hello <b>$participant_name</b>,<br><br>
                Congratulations! 🎉<br>
                You secured <b>$position</b> position in the event <b>$event_name</b>.<br><br>
                Regards,<br>
                Campus Cultural Management Team
            ";

            $mail->send();
            $msg = "Result Added & Email Sent Successfully!";
        } 
        catch (Exception $e) {
            $msg = "Result Added but Email Sending Failed.";
        }
    } 
    else {
        $msg = "Database Insert Failed!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Result - Kalaithiruvizha</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 420px;
            background: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            animation: fadeIn 0.6s ease-in-out;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #2a5298;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: 0.3s;
        }

        input:focus {
            border-color: #2a5298;
            box-shadow: 0 0 5px rgba(42,82,152,0.5);
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 18px;
            border-radius: 8px;
            border: none;
            background: linear-gradient(135deg, #28a745, #218838);
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
            transform: scale(1.03);
        }

        .msg {
            text-align: center;
            margin-top: 15px;
            padding: 10px;
            border-radius: 6px;
            background: #d4edda;
            color: #155724;
            font-size: 14px;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #2a5298;
            font-weight: bold;
            transition: 0.3s;
        }

        a:hover {
            color: #1e3c72;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<div class="container">
    <h2> Add Event Result</h2>

    <?php if ($msg != "") echo "<div class='msg'>$msg</div>"; ?>

    <form method="post">
        <input type="text" name="event_name" placeholder=" Event Name" required>
        <input type="text" name="participant_name" placeholder=" Participant Name" required>
        <input type="email" name="email" placeholder=" Participant Email" required>
        <input type="text" name="position" placeholder=" Position (1st / 2nd / 3rd)" required>
        <button type="submit" name="submit"> Add Result</button>
    </form>

    <a href="dashboard.php">⬅ Back to Dashboard</a>
</div>

</body>
</html>