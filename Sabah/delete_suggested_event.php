<?php
include 'db.php';

$id = $_GET['id'];

$query = "DELETE FROM suggested_events WHERE id = $id";
mysqli_query($conn, $query);

header('Location: calendaradmin.php');
?>
