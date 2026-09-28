<?php
include("db.php");
$upcoming = mysqli_query($conn, "SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kalaithiruvizha - Campus Cultural Management Portal</title>

    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
        }

        /* Navbar */
        .navbar {
            background: #1e272e;
            padding: 15px 50px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .logo {
            color: #f39c12;
            font-size: 22px;
            font-weight: bold;
        }

        .navbar ul {
            list-style: none;
            display: flex;
            gap: 25px;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: 0.3s;
        }

        .navbar ul li a:hover {
            color: #f39c12;
        }

        /* Hero Section */
        .hero {
            height: 90vh;
            background: linear-gradient(to right, #3498db, #8e44ad);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            color: white;
        }

        .hero h1 {
            font-size: 45px;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 18px;
        }

        .btn {
            margin-top: 20px;
            padding: 12px 30px;
            background: #f39c12;
            color: white;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn:hover {
            background: #e67e22;
            transform: scale(1.05);
        }

        /* About Section */
        .about {
            padding: 60px 40px;
            text-align: center;
        }

        .about h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        /* Popular Events */
        .events {
            padding: 60px 40px;
            background: #ffffff;
            text-align: center;
        }

        .event-container {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 30px;
        }

        .event-card {
            background: #ecf0f1;
            padding: 25px;
            width: 250px;
            border-radius: 12px;
            transition: 0.3s;
        }

        .event-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        /* Upcoming Events */
        .upcoming {
            padding: 60px 40px;
            background: #f4f6f9;
            text-align: center;
        }

        .upcoming-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 25px;
            margin-top: 30px;
        }

        .upcoming-card {
            background: white;
            width: 280px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.15);
            transition: 0.3s;
        }

        .upcoming-card:hover {
            transform: translateY(-10px);
        }

        .upcoming-card h3 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .date {
            font-size: 14px;
            color: #555;
            margin-bottom: 10px;
        }

        /* Footer */
        footer {
            background: #1e272e;
            color: white;
            text-align: center;
            padding: 15px;
        }

    </style>
</head>

<body>

<!-- Navbar -->
<div class="navbar">
    <div class="logo">EVENTZAA</div>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="register.php">Register</a></li>
        <li><a href="login.php">Login</a></li>
        <li><a href="admin_login.php">Admin</a></li>
    </ul>
</div>

<!-- Hero Section -->
<div class="hero">
    <h1>Welcome to Kalaithiruvizha 2026</h1>
    <p>Celebrate Talent. Showcase Creativity. Create Memories.</p>
    <a href="register.php" class="btn">Register Now</a>
</div>

<!-- About -->
<div class="about">
    <h2>About the Event</h2>
    <p>
        Kalaithiruvizha is our college cultural festival where students participate 
        in various technical and non-technical events. This portal helps students 
        register, check results, and download certificates easily.
    </p>
</div>

<!-- Popular Events -->
<div class="events">
    <h2>Popular Events</h2>

    <div class="event-container">
        <div class="event-card">
            <h3>🎤 Singing</h3>
            <p>Show your musical talent and win exciting prizes.</p>
        </div>

        <div class="event-card">
            <h3>💃 Dance</h3>
            <p>Express your creativity and performance skills.</p>
        </div>

        <div class="event-card">
            <h3>💻 Coding</h3>
            <p>Compete and prove your programming ability.</p>
        </div>
    </div>
</div>

<!-- Upcoming Events -->
<div class="upcoming">
    <h2>Upcoming Events</h2>

    <div class="upcoming-container">

    <?php
    if(mysqli_num_rows($upcoming) > 0){
        while($row = mysqli_fetch_assoc($upcoming)){
    ?>
        <div class="upcoming-card">
            <h3><?php echo $row['event_name']; ?></h3>
            <div class="date">
                📅 <?php echo $row['event_date']; ?><br>
                ⏰ <?php echo $row['event_time']; ?>
            </div>
            <p><?php echo $row['description']; ?></p>
        </div>
    <?php
        }
    } else {
        echo "<p>No upcoming events available.</p>";
    }
    ?>

    </div>
</div>

<!-- Footer -->
<footer>
    © 2026 Kalaithiruvizha | Government Arts and Science College
</footer>

</body>
</html>