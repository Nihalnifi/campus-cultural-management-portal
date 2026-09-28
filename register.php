<?php
include("db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
// Handle form submission
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $event_id = $_POST['event'];
    $department = $_POST['department'];
    $password = $_POST['password'];

    // Get event name from event_id
    $event_query = mysqli_query($conn, "SELECT event_name FROM events WHERE id='$event_id'");
    $event_row = mysqli_fetch_assoc($event_query);
    $event_name = $event_row['event_name'];

    // Insert participant
    $query = "INSERT INTO registrations(name,email,event_name,department,password)
              VALUES('$name','$email','$event_name','$department','$password')";
   if(mysqli_query($conn, $query)){

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'yourgmail@gmail.com'; // your gmail
        $mail->Password   = 'your_app_password';   // app password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('yourgmail@gmail.com', 'Campus Cultural Portal');
        $mail->addAddress($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'Event Registration Successful';
        $mail->Body    = "
            <h2>Registration Confirmed 🎉</h2>
            <p>Hello <b>$name</b>,</p>
            <p>You have successfully registered for <b>$event_name</b>.</p>
            <p>Thank you!</p>
        ";

        $mail->send();

        echo "<script>alert('Registration Successful! Email Sent.');</script>";

    } catch (Exception $e) {
        echo "<script>alert('Registered but Email Failed');</script>";
    }

} else {
    echo "<script>alert('Error in Registration');</script>";
}
}

// Fetch all events for dropdown
$events_result = mysqli_query($conn, "SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Participant Registration</title>
    <meta charset="UTF-8">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4e73df, #1cc88a);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: white;
            padding: 30px;
            width: 400px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            animation: fadeIn 0.8s ease-in-out;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4e73df;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
            outline: none;
            transition: 0.3s;
        }

        input:focus, select:focus {
            border-color: #4e73df;
            box-shadow: 0 0 5px rgba(78,115,223,0.5);
        }

        button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 8px;
            background: #4e73df;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            background: #2e59d9;
            transform: scale(1.05);
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .footer-text {
            text-align: center;
            font-size: 12px;
            margin-top: 15px;
            color: #888;
        }

.home-btn {
    position: absolute;
    top: 20px;
    left: 20px;
    padding: 8px 16px;
    background: linear-gradient(135deg, #007bff, #00c6ff);
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
    transition: 0.3s;
}

.home-btn:hover {
    background: linear-gradient(135deg, #0056b3, #0099cc);
    transform: scale(1.05);
}

    </style>
</head>
<body>

<a href="index.php" class="home-btn"> Home</a>
<div class="card">
    <h2> Register for Event</h2>

    <form method="post">
        <input type="text" name="name" placeholder="Full Name" required>

        <input type="email" name="email" placeholder="Email Address" required>

        <!-- Event Dropdown -->
        <select name="event" required>
            <option value="">-- Select Event --</option>
            <?php while($event = mysqli_fetch_assoc($events_result)) { ?>
                <option value="<?= $event['id'] ?>"><?= $event['event_name'] ?></option>
            <?php } ?>
        </select>

        <!-- Department Dropdown -->
        <select name="department" required>
            <option value="">-- Select Department --</option>
            <option value="BSC IT">BSC IT</option>
            <option value="BA ENG">BA ENG</option>
            <option value="BSC CS">BSC CS</option>
            <option value="BSC BOT">BSC BOT</option>
            <option value="BCA">BCA</option>
        </select>

        <input type="password" name="password" placeholder="Create Password" required>

        <button type="submit" name="register">Register Now</button>
    </form>

    <div class="footer-text">
        © 2026 Campus Cultural Management Portal
    </div>
</div>

</body>
</html>