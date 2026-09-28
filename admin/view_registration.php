<?php
session_start();
include("../db.php");

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

// DELETE FUNCTION
if(isset($_GET['delete_id']) && !empty($_GET['delete_id'])){
    $delete_id = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM registrations WHERE id='$delete_id'");
    echo "<script>alert('Registration Deleted Successfully'); window.location='view_registration.php';</script>";
    exit();
}

// FETCH DATA
$result = mysqli_query($conn, "SELECT * FROM registrations ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Registrations</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg,#667eea,#764ba2);
            margin: 0;
            padding: 30px;
        }

        h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 25px;
        }

        .top-bar {
            text-align: center;
            margin-bottom: 20px;
        }

        .dashboard-btn {
            padding: 10px 18px;
            background: #28a745;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            transition: 0.3s;
        }

        .dashboard-btn:hover {
            background: #218838;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
        }

        .table-container {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: linear-gradient(90deg,#667eea,#764ba2);
            color: #fff;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        tr:hover {
            background: #f3f4f6;
            transition: 0.2s;
        }

        .btn {
            padding: 6px 14px;
            border-radius: 6px;
            text-decoration: none;
            color: #fff;
            font-size: 14px;
            font-weight: 500;
            transition: 0.3s;
        }

        .edit-btn {
            background: #007bff;
        }

        .edit-btn:hover {
            background: #0056b3;
            box-shadow: 0 4px 10px rgba(0,123,255,0.4);
        }

        .delete-btn {
            background: #dc3545;
        }

        .delete-btn:hover {
            background: #b02a37;
            box-shadow: 0 4px 10px rgba(220,53,69,0.4);
        }

        @media(max-width:768px){
            table { font-size: 14px; }
        }
.edit-btn, .delete-btn {
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    display: inline-block;
    transition: all 0.3s ease;
    margin: 2px;
}

/* EDIT BUTTON */
.edit-btn {
    background: linear-gradient(135deg, #4CAF50, #2e7d32);
    color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.edit-btn:hover {
    background: linear-gradient(135deg, #43a047, #1b5e20);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

/* DELETE BUTTON */
.delete-btn {
    background: linear-gradient(135deg, #f44336, #b71c1c);
    color: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.delete-btn:hover {
    background: linear-gradient(135deg, #e53935, #7f0000);
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}
    </style>

    <script>
        function confirmDelete(id){
            if(confirm("Are you sure you want to delete this registration?")){
                window.location = "view_registration.php?delete_id=" + id;
            }
        }
    </script>

</head>
<body>

<h2> View Registrations</h2>

<div class="top-bar">
    <a href="dashboard.php" class="dashboard-btn"> Return to Dashboard</a>
</div>

<div class="table-container">
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Department</th>
            <th>Email</th>
            <th>Event</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['department']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['event_name']) ?></td>
            <td>
    <a href="edit_registration.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>

    <a href="view_registration.php?delete_id=<?php echo $row['id']; ?>" 
       onclick="return confirm('Are you sure?');"
       class="delete-btn">
       Delete
    </a>
</td>        </tr>
        <?php } ?>

    </table>
</div>

</body>
</html>