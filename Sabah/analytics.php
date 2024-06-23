<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.sheetjs.com/xlsx-0.19.0/package/dist/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="analytics.css">
    <style>
        .toggle-buttons button {
            margin: 5px;
        }
        .chart-container, .table-container {
            display: none;
        }
    </style>
</head>
<body>
<?php
        // Fetch FAQ Data
        include 'db2.php';
        $faqQuestions = [];
        $faqAnswers = [];
        $faqSql = "SELECT question, answer FROM faqs";
        $faqResult = $conn->query($faqSql);
        if ($faqResult->num_rows > 0) {
            while($row = $faqResult->fetch_assoc()) {
                $faqQuestions[] = $row['question'];
                $faqAnswers[] = $row['answer'];
            }
        }

        // Fetch New Users Data
        $newUserNames = [];
        $newUserEmails = [];
        $newUsersSql = "SELECT Name, email FROM new_users";
        $newUsersResult = $conn->query($newUsersSql);
        if ($newUsersResult->num_rows > 0) {
            while($row = $newUsersResult->fetch_assoc()) {
                $newUserNames[] = $row['Name'];
                $newUserEmails[] = $row['email'];
            }
        }

        // Fetch New Registers Data
        $newRegisters = [];
        $newRegistersSql = "SELECT * FROM new_registers";
        $newRegistersResult = $conn->query($newRegistersSql);
        if ($newRegistersResult->num_rows > 0) {
            while($row = $newRegistersResult->fetch_assoc()) {
                // Check if 'ID' and 'DateRegistered' keys exist in $row
                $id = isset($row['ID']) ? $row['ID'] : 'N/A';
                $name = isset($row['Name']) ? $row['Name'] : 'N/A';
                $email = isset($row['Email']) ? $row['Email'] : 'N/A';
                $dateRegistered = isset($row['DateRegistered']) ? $row['DateRegistered'] : 'N/A';
                
                $newRegisters[] = [
                    'ID' => $id,
                    'Name' => $name,
                    'Email' => $email,
                    'DateRegistered' => $dateRegistered
                ];
            }
        }

        // Fetch Suggestions Data
        $suggestions = [];
        $suggestionsSql = "SELECT * FROM suggestions";
        $suggestionsResult = $conn->query($suggestionsSql);
        if ($suggestionsResult->num_rows > 0) {
            while($row = $suggestionsResult->fetch_assoc()) {
                // Example of handling optional keys in suggestions table
                $id = isset($row['ID']) ? $row['ID'] : 'N/A';
                $suggestion = isset($row['Suggestion']) ? $row['Suggestion'] : 'N/A';
                $userID = isset($row['UserID']) ? $row['UserID'] : 'N/A';
                
                $suggestions[] = [
                    'ID' => $id,
                    'Suggestion' => $suggestion,
                    'UserID' => $userID
                ];
            }
        }

        // Fetch Events Data
        $eventDates = [];
        $eventCounts = [];
        $eventsSql = "SELECT event_date, COUNT(*) as event_count FROM calendarevents GROUP BY event_date";
        $eventsResult = $conn->query($eventsSql);
        if ($eventsResult->num_rows > 0) {
            while($row = $eventsResult->fetch_assoc()) {
                $eventDates[] = $row['event_date'];
                $eventCounts[] = $row['event_count'];
            }
        }

        // Fetch Suggested Events Data
        $suggestedEvents = [];
        $suggestedEventsSql = "SELECT * FROM suggested_events";
        $suggestedEventsResult = $conn->query($suggestedEventsSql);
        if ($suggestedEventsResult->num_rows > 0) {
            while($row = $suggestedEventsResult->fetch_assoc()) {
                // Example of handling optional keys in suggested_events table
                $id = isset($row['ID']) ? $row['ID'] : 'N/A';
                $eventName = isset($row['EventName']) ? $row['EventName'] : 'N/A';
                $eventDate = isset($row['EventDate']) ? $row['EventDate'] : 'N/A';
                
                $suggestedEvents[] = [
                    'ID' => $id,
                    'EventName' => $eventName,
                    'EventDate' => $eventDate
                ];
            }
        }

        
?>
   <div class="toggle-buttons">
        <button onclick="showView('eventChartContainer')">Show Event Chart</button>
        <button onclick="showView('userChartContainer')">Show User Chart</button>
        <button onclick="showView('faqTableContainer')">Show FAQ Table</button>
        <button onclick="showView('newUsersTableContainer')">Show New Users Table</button>
        <button onclick="showView('newRegistersTableContainer')">Show New Registers Table</button>
        <button onclick="showView('suggestionsTableContainer')">Show Suggestions Table</button>
        <button onclick="showView('suggestedEventsTableContainer')">Show Suggested Events Table</button>
    </div>

    <div id="eventChartContainer" class="chart-container">
        <canvas id="eventChart"></canvas>
        <button onclick="downloadTableAsExcel('eventTable', 'EventTable')">Download Event Table as Excel</button>
    </div>

    <div id="userChartContainer" class="chart-container">
        <canvas id="userChart"></canvas>
        <button onclick="downloadTableAsExcel('userTable', 'UserTable')">Download User Table as Excel</button>
    </div>

    <!-- FAQ Table -->
    <div id="faqTableContainer" class="table-container">
        <h2>FAQs</h2>
        <table id="faqTable">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($faqQuestions as $index => $question) : ?>
                <tr>
                    <td><?= $question ?></td>
                    <td><?= $faqAnswers[$index] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button onclick="downloadTableAsExcel('faqTable', 'FAQTable')">Download FAQ Table as Excel</button>
    </div>

    <!-- New Users Table -->
    <div id="newUsersTableContainer" class="table-container">
        <h2>New Users</h2>
        <table id="newUsersTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($newUserNames as $index => $name) : ?>
                <tr>
                    <td><?= $name ?></td>
                    <td><?= $newUserEmails[$index] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button onclick="downloadTableAsExcel('newUsersTable', 'NewUsersTable')">Download New Users Table as Excel</button>
    </div>

    <!-- New Registers Table -->
    <div id="newRegistersTableContainer" class="table-container">
        <h2>New Registers</h2>
        <table id="newRegistersTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date Registered</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($newRegisters as $register) : ?>
                <tr>
                    <td><?= $register['ID'] ?></td>
                    <td><?= $register['Name'] ?></td>
                    <td><?= $register['Email'] ?></td>
                    <td><?= $register['DateRegistered'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button onclick="downloadTableAsExcel('newRegistersTable', 'NewRegistersTable')">Download New Registers Table as Excel</button>
    </div>

    <!-- Suggestions Table -->
    <div id="suggestionsTableContainer" class="table-container">
        <h2>Suggestions</h2>
        <table id="suggestionsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Suggestion</th>
                    <th>User ID</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($suggestions as $suggestion) : ?>
                <tr>
                    <td><?= $suggestion['ID'] ?></td>
                    <td><?= $suggestion['Suggestion'] ?></td>
                    <td><?= $suggestion['UserID'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button onclick="downloadTableAsExcel('suggestionsTable', 'SuggestionsTable')">Download Suggestions Table as Excel</button>
    </div>

    <!-- Suggested Events Table -->
    <div id="suggestedEventsTableContainer" class="table-container">
        <h2>Suggested Events</h2>
        <table id="suggestedEventsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Event Name</th>
                    <th>Event Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($suggestedEvents as $event) : ?>
                <tr>
                    <td><?= $event['ID'] ?></td>
                    <td><?= $event['EventName'] ?></td>
                    <td><?= $event['EventDate'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button onclick="downloadTableAsExcel('suggestedEventsTable', 'SuggestedEventsTable')">Download Suggested Events Table as Excel</button>
    </div>

    <script>
        const views = document.querySelectorAll('.chart-container, .table-container');
        views.forEach(view => view.style.display = 'none');

        function showView(viewId) {
            views.forEach(view => view.style.display = 'none');
            document.getElementById(viewId).style.display = 'block';
        }

        function downloadTableAsExcel(tableId, filename) {
            const table = document.getElementById(tableId);
            const wb = XLSX.utils.table_to_book(table);
            XLSX.writeFile(wb, `${filename}.xlsx`);
        }

        // Event Chart
        const eventDates = <?= json_encode($eventDates) ?>;
        const eventCounts = <?= json_encode($eventCounts) ?>;

        const ctxEventChart = document.getElementById('eventChart').getContext('2d');
        new Chart(ctxEventChart, {
            type: 'bar',
            data: {
                labels: eventDates,
                datasets: [{
                    label: 'Event Count',
                    data: eventCounts,
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

        // User Chart
        const userNames = <?= json_encode($newUserNames) ?>;
        const userEmails = <?= json_encode($newUserEmails) ?>;

        const ctxUserChart = document.getElementById('userChart').getContext('2d');
        new Chart(ctxUserChart, {
            type: 'pie',
            data: {
                labels: userNames,
                datasets: [{
                    label: 'User Emails',
                    data: userEmails.map(email => 1),
                    backgroundColor: userNames.map((_, i) => `hsl(${i * 30}, 70%, 50%)`)
                }]
            }
        });
    </script>
</body>
</html>