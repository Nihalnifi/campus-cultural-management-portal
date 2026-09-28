<?php
include("db.php");

$query = "
SELECT 
    events.event_name,
    results.participant_name,
    results.position
FROM results
JOIN events ON results.event_id = events.id
ORDER BY events.event_name, results.position
";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Event Results</title>
<link rel="stylesheet" href="css/style.css">
<style>
table {
    width: 80%;
    margin: auto;
    border-collapse: collapse;
}
th, td {
    padding: 10px;
    text-align: center;
}
th {
    background: #333;
    color: white;
}
h2 {
    text-align: center;
}
</style>
</head>
<body>

<h2>🏆 Event Results</h2>

<table border="1">
<tr>
    <th>Event Name</th>
    <th>participant Name</th>
    <th>Position</th>
</tr>

<?php while ($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?php echo $row['event_name']; ?></td>
    <td><?php echo $row['participant_name']; ?></td>
    <td><?php echo $row['position']; ?></td>
</tr>
<?php } ?>

</table>

<br><br>
<center>
<a href="index.php">⬅ Back to Home</a>
</center>

</body>
</html>