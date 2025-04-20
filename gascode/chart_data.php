<?php
header('Content-Type: application/json');

// Connect to database
$link = mysqli_connect("localhost", "root", "", "gas");

// Check connection
if (!$link) {
    die(json_encode(["error" => "Database connection failed"]));
}

// Fetch the latest reading
$queryCurrent = "SELECT gas_value, status, timestamp FROM gas_level ORDER BY timestamp DESC LIMIT 1";
$resultCurrent = mysqli_query($link, $queryCurrent);

if ($resultCurrent && mysqli_num_rows($resultCurrent) > 0) {
    $current = mysqli_fetch_assoc($resultCurrent);

    // Calculate status based on gas_value
    $gasValue = intval($current['gas_value']);
    if ($gasValue > 250) {
        $current['status'] = 'Gas Detected';
    } elseif ($gasValue > 150) {
        $current['status'] = 'Unstable';
    } else {
        $current['status'] = 'Safe';
    }

} else {
    // Fallback if no data
    $current = [
        'gas_value' => 0,
        'status' => 'Safe',
        'timestamp' => null
    ];
}

// Fetch last 20 records for chart
$queryChart = "SELECT gas_value, timestamp FROM gas_level ORDER BY timestamp DESC LIMIT 20";
$resultChart = mysqli_query($link, $queryChart);

$chart_data = [];

if ($resultChart && mysqli_num_rows($resultChart) > 0) {
    while ($row = mysqli_fetch_assoc($resultChart)) {
        $chart_data[] = $row;
    }
}

// Ensure chart data is in chronological order
$chart_data = array_reverse($chart_data);

// Output JSON
echo json_encode([
    'current' => $current,
    'chart_data' => $chart_data
]);

// Close DB
mysqli_close($link);
?>

