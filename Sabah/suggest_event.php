<?php
include 'db.php';

$event_date = $_POST['event_date'];
$event_description = $_POST['event_description'];

$query = "INSERT INTO suggested_events (event_date, event_description) VALUES ('$event_date', '$event_description')";
mysqli_query($conn, $query);

header('Location: calendar.php');
?>