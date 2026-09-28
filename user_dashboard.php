<?php
session_start();
include("db.php");

if (!isset($_SESSION['participant'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['participant'];

$query = mysqli_query($conn, "SELECT * FROM registrations WHERE email='$email'");

if (!$query) {
    die("Query Failed: " . mysqli_error($conn));
}

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
} else {
    echo "No user data found!";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>User Dashboard</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #141E30, #243B55);
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

/* Main Card */
.card {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(12px);
    padding: 30px;
    width: 100%;
    max-width: 420px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.4);
    text-align: center;
    color: white;
}

/* Profile */
.profile {
    width: 85px;
    height: 85px;
    border-radius: 50%;
    background: white;
    color: #243B55;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 38px;
    font-weight: 700;
    margin: 0 auto 20px auto;
}

/* Title */
h2 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 20px;
}

/* Detail Boxes */
.detail-box {
    background: rgba(255,255,255,0.15);
    padding: 12px 15px;
    border-radius: 10px;
    margin: 12px 0;
    text-align: left;
    transition: 0.3s;
    display: flex;
    align-items: center;
    font-size: 15px;
}

.detail-box:hover {
    background: rgba(255,255,255,0.25);
    transform: translateX(4px);
}

.detail-box strong {
    color: #00ffff;
    margin-right: 5px;
}

.icon {
    font-size: 18px;
    margin-right: 12px;
}

/* Buttons */
.download-btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 22px;
    background: linear-gradient(135deg, #00c851, #007e33);
    color: white;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    border-radius: 8px;
    transition: 0.3s;
}

.download-btn:hover {
    transform: translateY(-3px);
}

.logout-btn {
    display: inline-block;
    margin-top: 15px;
    padding: 9px 18px;
    background: #ff4444;
    color: white;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    border-radius: 8px;
    transition: 0.3s;
}

.logout-btn:hover {
    background: #cc0000;
}
</style>
</head>

<body>

<div class="card">

    <div class="profile">
        <?php echo strtoupper(substr($row['name'],0,1)); ?>
    </div>

    <h2>Welcome, <?php echo $row['name']; ?> </h2>

    <div class="detail-box">
        <span class="icon"></span>
        <span><strong>Email:</strong> <?php echo $row['email']; ?></span>
    </div>

    <div class="detail-box">
        <span class="icon"></span>
        <span><strong>Department:</strong> <?php echo $row['department']; ?></span>
    </div>

    <div class="detail-box">
        <span class="icon"></span>
        <span><strong>Event:</strong> <?php echo $row['event_name']; ?></span>
    </div>

    <a href="download_certificate.php" class="download-btn">
         Download Certificate
    </a>

    <br>

    <a href="logout_user.php" class="logout-btn">
        Logout
    </a>

</div>

</body>
</html>