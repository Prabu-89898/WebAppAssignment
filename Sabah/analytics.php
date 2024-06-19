<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics</title>
    <style>
        .chart-container {
            width: 80%;
            margin: 20px auto;
        }
        .table-container {
            width: 80%;
            margin: 20px auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h1>Admin Analytics</h1>

    <?php
    include 'db2.php';

    
    $eventQuery = "SELECT event_date, COUNT(*) as event_count FROM events GROUP BY event_date";
    $eventResult = mysqli_query($conn, $eventQuery);
    $eventDates = [];
    $eventCounts = [];
    while ($row = mysqli_fetch_assoc($eventResult)) {
        $eventDates[] = $row['event_date'];
        $eventCounts[] = $row['event_count'];
    }

    
    $userQuery = "SELECT user_type, COUNT(*) as user_count FROM users GROUP BY user_type";
    $userResult = mysqli_query($conn, $userQuery);
    $userTypes = [];
    $userCounts = [];
    while ($row = mysqli_fetch_assoc($userResult)) {
        $userTypes[] = $row['user_type'];
        $userCounts[] = $row['user_count'];
    }

    
    $eventsPerMonthQuery = "SELECT DATE_FORMAT(event_date, '%Y-%m') as month, COUNT(*) as event_count FROM events GROUP BY month";
    $eventsPerMonthResult = mysqli_query($conn, $eventsPerMonthQuery);
    $eventMonths = [];
    $eventMonthCounts = [];
    while ($row = mysqli_fetch_assoc($eventsPerMonthResult)) {
        $eventMonths[] = $row['month'];
        $eventMonthCounts[] = $row['event_count'];
    }

    
    $userRegistrationsPerMonthQuery = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as user_count FROM users GROUP BY month";
    $userRegistrationsPerMonthResult = mysqli_query($conn, $userRegistrationsPerMonthQuery);
    $registrationMonths = [];
    $registrationMonthCounts = [];
    while ($row = mysqli_fetch_assoc($userRegistrationsPerMonthResult)) {
        $registrationMonths[] = $row['month'];
        $registrationMonthCounts[] = $row['user_count'];
    }

    
    $recentEventsQuery = "SELECT * FROM events ORDER BY event_date DESC LIMIT 10";
    $recentEventsResult = mysqli_query($conn, $recentEventsQuery);
    ?>

    <div class="chart-container">
        <canvas id="eventChart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="userChart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="eventsPerMonthChart"></canvas>
    </div>

    <div class="chart-container">
        <canvas id="registrationsPerMonthChart"></canvas>
    </div>

    <div class="table-container">
        <h2>Recent Events</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($recentEventsResult)) {
                    echo "<tr>";
                    echo "<td>" . $row['event_date'] . "</td>";
                    echo "<td>" . $row['event_description'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        
        const eventCtx = document.getElementById('eventChart').getContext('2d');
        const eventChart = new Chart(eventCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($eventDates); ?>,
                datasets: [{
                    label: 'Number of Events',
                    data: <?php echo json_encode($eventCounts); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        
        const userCtx = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(userCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($userTypes); ?>,
                datasets: [{
                    label: 'Number of Users',
                    data: <?php echo json_encode($userCounts); ?>,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        
        const eventsPerMonthCtx = document.getElementById('eventsPerMonthChart').getContext('2d');
        const eventsPerMonthChart = new Chart(eventsPerMonthCtx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($eventMonths); ?>,
                datasets: [{
                    label: 'Events Per Month',
                    data: <?php echo json_encode($eventMonthCounts); ?>,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        
        const registrationsPerMonthCtx = document.getElementById('registrationsPerMonthChart').getContext('2d');
        const registrationsPerMonthChart = new Chart(registrationsPerMonthCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($registrationMonths); ?>,
                datasets: [{
                    label: 'User Registrations Per Month',
                    data: <?php echo json_encode($registrationMonthCounts); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>