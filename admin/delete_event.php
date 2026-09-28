<?php
include("../db.php");

if (isset($_GET['id'])) {

    $id = intval($_GET['id']);

    $delete = "DELETE FROM events WHERE id=$id";
    mysqli_query($conn, $delete);

    header("Location: view_events.php");
    exit();

} else {
    echo "No ID Found!";
}
?>