<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Calendar</title>
    <style>
        /* Add basic styling for the calendar */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            height: 100px;
            vertical-align: top;
        }
        .navigation {
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Admin Calendar</h1>

    <?php
    function build_calendar($month, $year) {
        include 'db.php';
        
        $daysOfWeek = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
        $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
        $numberDays = date('t', $firstDayOfMonth);
        $dateComponents = getdate($firstDayOfMonth);
        $monthName = $dateComponents['month'];
        $dayOfWeek = $dateComponents['wday'];
        $calendar = "<table>";
        $calendar .= "<caption>$monthName $year</caption>";
        $calendar .= "<tr>";

        foreach ($daysOfWeek as $day) {
            $calendar .= "<th>$day</th>";
        }

        $calendar .= "</tr><tr>";

        if ($dayOfWeek > 0) {
            $calendar .= str_repeat('<td></td>', $dayOfWeek);
        }

        $currentDay = 1;

        $month = str_pad($month, 2, "0", STR_PAD_LEFT);

        while ($currentDay <= $numberDays) {
            if ($dayOfWeek == 7) {
                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";
            }

            $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
            $date = "$year-$month-$currentDayRel";

            $calendar .= "<td><strong>$currentDay</strong><br>";

            $query = "SELECT * FROM events WHERE event_date = '$date'";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $calendar .= $row['event_description'] . "<br>";
                $calendar .= "<a href='delete_event.php?id=" . $row['id'] . "'>Delete</a><br>";
            }

            $calendar .= "</td>";
            $currentDay++;
            $dayOfWeek++;
        }

        if ($dayOfWeek != 7) {
            $remainingDays = 7 - $dayOfWeek;
            $calendar .= str_repeat('<td></td>', $remainingDays);
        }

        $calendar .= "</tr>";
        $calendar .= "</table>";

        return $calendar;
    }

    $dateComponents = getdate();
    if (isset($_GET['month']) && isset($_GET['year'])) {
        $month = $_GET['month'];
        $year = $_GET['year'];
    } else {
        $month = $dateComponents['mon'];
        $year = $dateComponents['year'];
    }

    echo build_calendar($month, $year);
    ?>

    <div class="navigation">
        <a href="?month=<?php echo $month == 1 ? 12 : $month - 1; ?>&year=<?php echo $month == 1 ? $year - 1 : $year; ?>">&lt; Previous</a>
        &nbsp;|&nbsp;
        <a href="?month=<?php echo $month == 12 ? 1 : $month + 1; ?>&year=<?php echo $month == 12 ? $year + 1 : $year; ?>">Next &gt;</a>
    </div>

    <h2>Add an Event</h2>
    <form action="add_event.php" method="POST">
        <label for="event_date">Date:</label>
        <input type="date" id="event_date" name="event_date" required>
        <br>
        <label for="event_description">Description:</label>
        <input type="text" id="event_description" name="event_description" required>
        <br>
        <button type="submit">Add Event</button>
    </form>

    <h2>Suggested Events</h2>
    <table>
        <thead>
            <tr>
                <th>Day</th>
                <th>Events</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db.php';
            $result = mysqli_query($conn, "SELECT * FROM suggested_events ORDER BY event_date");

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['event_date'] . "</td>";
                echo "<td>" . $row['event_description'] . "</td>";
                echo "<td>
                        <a href='add_suggested_event.php?id=" . $row['id'] . "'>Add</a> |
                        <a href='delete_suggested_event.php?id=" . $row['id'] . "'>Delete</a>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>