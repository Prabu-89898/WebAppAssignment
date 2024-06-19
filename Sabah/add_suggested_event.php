<?php
include 'db.php';

$id = $_GET['id'];


$result = mysqli_query($conn, "SELECT * FROM suggested_events WHERE id = $id");
$row = mysqli_fetch_assoc($result);

$event_date = $row['event_date'];
$event_description = $row['event_description'];


$query = "INSERT INTO events (event_date, event_description) VALUES ('$event_date', '$event_description')";
mysqli_query($conn, $query);


$query = "DELETE FROM suggested_events WHERE id = $id";
mysqli_query($conn, $query);

header('Location: calendaradmin.php');
?>