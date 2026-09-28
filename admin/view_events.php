<?php
session_start();
include("../db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM events");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Events</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .container {
            width: 90%;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table thead {
            background: #007bff;
            color: white;
        }

        table th, table td {
            padding: 12px;
            text-align: center;
        }

        table th {
            font-size: 16px;
        }

        table tr {
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background: #f1f1f1;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            font-size: 14px;
        }

        .edit-btn {
            background: #28a745;
        }

        .edit-btn:hover {
            background: #218838;
        }

        .delete-btn {
            background: #dc3545;
        }

        .delete-btn:hover {
            background: #c82333;
        }

        .add-btn {
            background: #007bff;
            display: inline-block;
            margin-bottom: 15px;
        }

        .add-btn:hover {
            background: #0056b3;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Event Management</h2>

    <a href="add_event.php" class="btn add-btn">+ Add New Event</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Event Name</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['event_name']; ?></td>
                <td><?php echo $row['event_date']; ?></td>
                <td><?php echo $row['event_time']; ?></td>
                <td>
                    <a href="edit_event.php?id=<?php echo $row['id']; ?>" 
                       class="btn edit-btn">Edit</a>

                    <a href="delete_event.php?id=<?php echo $row['id']; ?>" 
                       class="btn delete-btn"
                       onclick="return confirm('Are you sure you want to delete this event?');">
                       Delete
                    </a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

</div>

</body>
</html>