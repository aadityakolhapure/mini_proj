<?php
include('../includes/config.php');

// Fetch data from the database
$sqlQuery = "SELECT emp_id, FirstName, Av_leave FROM tblemployees";
$result = mysqli_query($conn, $sqlQuery);
$data = array();
foreach ($result as $row) {
    $data[] = $row;
}
mysqli_close($conn);

// Output JSON data
$jsonData = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        div#chart-container {
            height: 400px;
            width: 563px;
        }
    </style>
    <meta charset="UTF-8">
    <title>Employee Leave Chart</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div id="chart-container">
        <canvas id="graphCanvas"></canvas>
    </div>

    <script>
        $(document).ready(function() {
            var jsonData = <?php echo $jsonData; ?>; // Embed the JSON data directly

            var names = [];
            var leaves = [];
            for (var i in jsonData) {
                names.push(jsonData[i].FirstName);
                leaves.push(jsonData[i].Av_leave);
            }

            var chartdata = {
                labels: names,
                datasets: [{
                    label: 'Employee Leave',
                    backgroundColor: '#49e2ff',
                    borderColor: '#46d5f1',
                    hoverBackgroundColor: '#CCCCCC',
                    hoverBorderColor: '#666666',
                    data: leaves
                }]
            };

            var graphTarget = $("#graphCanvas");
            var barGraph = new Chart(graphTarget, {
                type: 'bar',
                data: chartdata
            });
        });
    </script>
</body>

</html>