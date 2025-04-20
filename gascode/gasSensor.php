<?php
class gasSensor {
    public $link = '';

    function __construct($gasValue, $status) {
        $this->connect();
        $this->storeInDB($gasValue, $status);
    }

    function connect() {
        // Connect to the MySQL server
        $this->link = mysqli_connect('localhost', 'root', '') or die('Cannot connect to the DB');

        // Select the database
        mysqli_select_db($this->link, 'gas') or die('Cannot select the DB');
    }

    function storeInDB($gasValue, $status) {
        // Sanitize inputs to avoid SQL injection
        $gasValue = mysqli_real_escape_string($this->link, $gasValue);
        $status = mysqli_real_escape_string($this->link, $status);

        // Insert gas value, status, and timestamp into the database
        $query = "INSERT INTO gas_level (gas_value, status, timestamp) 
                  VALUES ('".$gasValue."', '".$status."', NOW())";

        // Execute the query
        $result = mysqli_query($this->link, $query) or die('Errant query:  '.$query);
    }
}

// Check if both gas_value and status are passed via GET
if (!empty($_GET['gas_value']) && !empty($_GET['status'])) {
    $gasSensor = new gasSensor($_GET['gas_value'], $_GET['status']);
}
?>
