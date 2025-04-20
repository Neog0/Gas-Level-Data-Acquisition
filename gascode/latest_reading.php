<?php
header('Content-Type: application/json');

// Establishing the database connection
$link = mysqli_connect("localhost", "root", "", "gas");

if (!$link) {
    // Returning an error message in case of failed connection
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Query to fetch the latest gas value and status
$query = "SELECT gas_value, status FROM gas_level ORDER BY timestamp DESC LIMIT 1";
$result = mysqli_query($link, $query);

if ($result && mysqli_num_rows($result) > 0) {
    // Fetching the result as an associative array
    $row = mysqli_fetch_assoc($result);
    echo json_encode($row);
} else {
    // If no data is found, returning default 'Safe' status
    echo json_encode(["gas_value" => 0, "status" => "Safe"]);
}

// Closing the database connection
mysqli_close($link);
?>