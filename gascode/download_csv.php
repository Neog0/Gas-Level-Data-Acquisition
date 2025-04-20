<?php
// Connect to the database
$link = mysqli_connect("localhost", "root", "", "gas");

// Check if the connection is successful
if (!$link) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all readings from the database
$query = "SELECT * FROM gas_level ORDER BY timestamp DESC";
$result = mysqli_query($link, $query);

// Set the headers to prompt the browser to download the file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="gas_readings.csv"');

// Open the output stream for writing the CSV data
$output = fopen('php://output', 'w');

// Write the CSV column headers
fputcsv($output, ['ID', 'Gas Value', 'Status', 'Timestamp']);

// Fetch and write the rows to the CSV
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }
}

// Close the connection
mysqli_close($link);

// Close the output stream
fclose($output);
exit();
?>
