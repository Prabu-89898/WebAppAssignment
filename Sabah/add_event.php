<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Sanitize and validate input
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $event_description = mysqli_real_escape_string($conn, $_POST['event_description']);

    // Check if event date is empty
    if (empty($event_date)) {
        die("Error: Event date is required. <a href='javascript:history.back()'>Go back</a>");
    }

    // Check if event date is in the past
    $today = date('Y-m-d');
    if ($event_date < $today) {
        die("Error: Event date cannot be in the past. <a href='javascript:history.back()'>Go back</a>");
    }

    // Insert into database
    $query = "INSERT INTO events (event_date, event_description) VALUES ('$event_date', '$event_description')";
    if (mysqli_query($conn, $query)) {
        header('Location: calendaradmin.php');
        exit(); // Ensure no further code execution after redirection
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    die("Error: POST method required.");
}
?>