<?php
session_start();
include("../db.php");

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// DELETE LOGIC
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM results WHERE id='$delete_id'");
    header("Location: view_results.php");
    exit();
}

$result = mysqli_query($conn, "SELECT * FROM results ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Results</title>
<style>
body
{
    font-family: Arial;
    background: linear-gradient(to right,#667eea,#764ba2);
}
.container{
    width:95%;
    margin:40px auto;
    background:white;
    padding:30px;
    border-radius:10px;
}
table{
    width:100%;
    border-collapse:collapse;
}
th{
    background:#667eea;
    color:white;
    padding:10px;
}
td{
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
}
.edit{
    background:green;
    color:white;
    padding:5px 10px;
    text-decoration:none;
}
.delete{
    background:red;
    color:white;
    padding:5px 10px;
    text-decoration:none;
}
.top-buttons {
    margin-bottom: 15px;
}

.dashboard-btn {
    display: inline-block;
    padding: 8px 15px;
    background: #28a745;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    font-weight: bold;
    transition: 0.3s;
}

.dashboard-btn:hover {
    background: #218838;
}
</style>
</head>
<body>

<div class="container">
<h2 align="center">Manage Results</h2>
<div class="top-buttons">
    <a href="dashboard.php" class="dashboard-btn"> Return to Dashboard</a>
</div>
<table>
<tr>
<th>ID</th>
<th>Event</th>
<th>Participant</th>
<th>Email</th>
<th>Position</th>
<th>Action</th>
</tr>

<?php
if(mysqli_num_rows($result)>0){
while($row=mysqli_fetch_assoc($result)){
?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['event_name']; ?></td>
<td><?php echo $row['participant_name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['position']; ?></td>
<td>
<a class="edit" href="edit_result.php?id=<?php echo $row['id']; ?>">Edit</a>
<a class="delete" href="view_results.php?delete_id=<?php echo $row['id']; ?>" 
onclick="return confirm('Are you sure?')">Delete</a>
</td>
</tr>
<?php
}
}else{
echo "<tr><td colspan='6'>No Results Found</td></tr>";
}
?>

</table>
</div>
</body>
</html>