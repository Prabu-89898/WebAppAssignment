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

