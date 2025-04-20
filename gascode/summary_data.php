<?php
$link = mysqli_connect("localhost", "root", "", "gas");

if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

$summary = [
    "total" => 0,
    "max" => 0,
    "min" => 0,
    "avg" => 0,
    "unstable" => 0,
    "danger" => 0
];

// Total, Max, Min, Avg
$result = mysqli_query($link, "SELECT COUNT(*) as total, MAX(gas_value) as max, MIN(gas_value) as min, AVG(gas_value) as avg FROM gas_level");
if ($row = mysqli_fetch_assoc($result)) {
    $summary["total"] = $row["total"];
    $summary["max"] = $row["max"];
    $summary["min"] = $row["min"];
    $summary["avg"] = round($row["avg"]);
}

// Count unstable (gas_value between 150 and 249)
$result = mysqli_query($link, "SELECT COUNT(*) as count FROM gas_level WHERE gas_value >= 150 AND gas_value < 250");
if ($row = mysqli_fetch_assoc($result)) {
    $summary["unstable"] = $row["count"];
}

// Count danger (status = 'Gas Detected')
$result = mysqli_query($link, "SELECT COUNT(*) as count FROM gas_level WHERE status = 'Gas Detected'");
if ($row = mysqli_fetch_assoc($result)) {
    $summary["danger"] = $row["count"];
}

echo json_encode($summary);
mysqli_close($link);
?>
