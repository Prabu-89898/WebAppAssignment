<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics</title>
    <style>
        .chart-container, .table-container {
            width: 80%;
            margin: 20px auto;
            display: none;
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
        .highlight {
            background-color: yellow;
        }
        .toggle-buttons {
            width: 80%;
            margin: 20px auto;
            text-align: center;
        }
        .toggle-buttons button {
            margin: 5px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.16.9/xlsx.full.min.js"></script>
</head>
<body>
    <h1>Admin Analytics</h1>

    <?php
    include 'db2.php';

    // Fetch event data
    $eventQuery = "SELECT event_date, COUNT(*) as event_count FROM events GROUP BY event_date";
    $eventResult = mysqli_query($conn, $eventQuery);
    $eventDates = [];
    $eventCounts = [];
    while ($row = mysqli_fetch_assoc($eventResult)) {
        $eventDates[] = $row['event_date'];
        $eventCounts[] = $row['event_count'];
    }

    // Fetch user data
    $userQuery = "SELECT user_type, COUNT(*) as user_count FROM users GROUP BY user_type";
    $userResult = mysqli_query($conn, $userQuery);
    $userTypes = [];
    $userCounts = [];
    while ($row = mysqli_fetch_assoc($userResult)) {
        $userTypes[] = $row['user_type'];
        $userCounts[] = $row['user_count'];
    }

    // Fetch events per month data
    $eventsPerMonthQuery = "SELECT DATE_FORMAT(event_date, '%Y-%m') as month, COUNT(*) as event_count FROM events GROUP BY month";
    $eventsPerMonthResult = mysqli_query($conn, $eventsPerMonthQuery);
    $eventMonths = [];
    $eventMonthCounts = [];
    while ($row = mysqli_fetch_assoc($eventsPerMonthResult)) {
        $eventMonths[] = $row['month'];
        $eventMonthCounts[] = $row['event_count'];
    }

    // Fetch user registrations per month data
    $userRegistrationsPerMonthQuery = "SELECT DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as user_count FROM users GROUP BY month";
    $userRegistrationsPerMonthResult = mysqli_query($conn, $userRegistrationsPerMonthQuery);
    $registrationMonths = [];
    $registrationMonthCounts = [];
    while ($row = mysqli_fetch_assoc($userRegistrationsPerMonthResult)) {
        $registrationMonths[] = $row['month'];
        $registrationMonthCounts[] = $row['user_count'];
    }

    // Fetch recent events data
    $recentEventsQuery = "SELECT * FROM events ORDER BY event_date DESC LIMIT 10";
    $recentEventsResult = mysqli_query($conn, $recentEventsQuery);
    ?>

    <div class="toggle-buttons">
        <!-- <button onclick="showView('eventChartContainer')">Show Event Chart</button> -->
        <button onclick="showView('eventTableContainer')">Show Event Table</button>
        <button onclick="showView('userChartContainer')">Show User Chart</button>
        <button onclick="showView('userTableContainer')">Show User Table</button>
        <button onclick="showView('eventsPerMonthChartContainer')">Show Events Per Month Chart</button>
        <button onclick="showView('eventsPerMonthTableContainer')">Show Events Per Month Table</button>
        <button onclick="showView('registrationsPerMonthChartContainer')">Show Registrations Per Month Chart</button>
        <button onclick="showView('registrationsPerMonthTableContainer')">Show Registrations Per Month Table</button>
    </div>

    

    <!-- Event Table -->
    <div id="eventTableContainer" class="table-container">
        <h2>Events</h2>
        <table id="eventTable">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Event Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($eventDates as $index => $date) {
                    echo "<tr>";
                    echo "<td>$date</td>";
                    echo "<td>{$eventCounts[$index]}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button onclick="downloadTableAsExcel('eventTable', 'EventTable')">Download Event Table as Excel</button>
    </div>

    <!-- User Chart -->
    <div id="userChartContainer" class="chart-container">
        <canvas id="userChart"></canvas>
        <button onclick="downloadChartAsExcel('userChart', 'UserChart')">Download User Chart as Excel</button>
    </div>

    <!-- User Table -->
    <div id="userTableContainer" class="table-container">
        <h2>Users</h2>
        <table id="userTable">
            <thead>
                <tr>
                    <th>User Type</th>
                    <th>User Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($userTypes as $index => $type) {
                    echo "<tr>";
                    echo "<td>$type</td>";
                    echo "<td>{$userCounts[$index]}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button onclick="downloadTableAsExcel('userTable', 'UserTable')">Download User Table as Excel</button>
    </div>

    <!-- Events Per Month Chart -->
    <div id="eventsPerMonthChartContainer" class="chart-container">
        <canvas id="eventsPerMonthChart"></canvas>
        <button onclick="downloadChartAsExcel('eventsPerMonthChart', 'EventsPerMonthChart')">Download Events Per Month Chart as Excel</button>
    </div>

    <!-- Events Per Month Table -->
    <div id="eventsPerMonthTableContainer" class="table-container">
        <h2>Events Per Month</h2>
        <table id="eventsPerMonthTable">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Event Count</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($eventMonths as $index => $month) {
                    echo "<tr>";
                    echo "<td>$month</td>";
                    echo "<td>{$eventMonthCounts[$index]}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button onclick="downloadTableAsExcel('eventsPerMonthTable', 'EventsPerMonthTable')">Download Events Per Month Table as Excel</button>
    </div>

    <!-- Registrations Per Month Chart -->
    <div id="registrationsPerMonthChartContainer" class="chart-container">
        <canvas id="registrationsPerMonthChart"></canvas>
        <button onclick="downloadChartAsExcel('registrationsPerMonthChart', 'RegistrationsPerMonthChart')">Download Registrations Per Month Chart as Excel</button>
    </div>

    <!-- Registrations Per Month Table -->
    <div id="registrationsPerMonthTableContainer" class="table-container">
        <h2>Registrations Per Month</h2>
        <table id="registrationsPerMonthTable">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Registrations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($registrationMonths as $index => $month) {
                    echo "<tr>";
                    echo "<td>$month</td>";
                    echo "<td>{$registrationMonthCounts[$index]}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button onclick="downloadTableAsExcel('registrationsPerMonthTable', 'RegistrationsPerMonthTable')">Download Registrations Per Month Table as Excel</button>
    </div>

    <script>
        // Function to show the selected view and hide others
        function showView(viewID) {
            const views = document.querySelectorAll('.chart-container, .table-container');
            views.forEach(view => {
                view.style.display = 'none';
            });
            document.getElementById(viewID).style.display = 'block';
        }

        // Function to download table as Excel file
        function downloadTableAsExcel(tableID, filename) {
            const table = document.getElementById(tableID);
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.table_to_sheet(table);
            XLSX.utils.book_append_sheet(wb, ws, filename);
            XLSX.writeFile(wb, filename + '.xlsx');
        }

        // Function to download chart as Excel file
        function downloadChartAsExcel(chartID, filename) {
            const canvas = document.getElementById(chartID);
            const dataUrl = canvas.toDataURL('image/png');
            const wb = XLSX.utils.book_new();
            const ws = XLSX.utils.aoa_to_sheet([['Chart']]);
            XLSX.utils.sheet_add_image(ws, {
                image: dataUrl,
                type: 'png',
                position: {r: 0, c: 0, h: 20, w: 20}
            });
            XLSX.utils.book_append_sheet(wb, ws, filename);
            XLSX.writeFile(wb, filename + '.xlsx');
        }

        // // Charts initialization
        // const eventCtx = document.getElementById('eventChart').getContext('2d');
        // const eventChart = new Chart(eventCtx, {
        //     type: 'line',
        //     data: {
        //         labels: <?php echo json_encode($eventDates); ?>,
        //         datasets: [{
        //             label: 'Number of Events',
        //             data: <?php echo json_encode($eventCounts); ?>,
        //             backgroundColor: 'rgba(75, 192, 192, 0.2)',
        //             borderColor: 'rgba(75, 192, 192, 1)',
        //             borderWidth: 1
        //         }]
        //     },
        //     options: {
        //         scales: {
        //             y: {
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });

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

        // Initially show the event chart
        showView('eventChartContainer');
    </script>
</body>
</html>