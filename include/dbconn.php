
<?php
// Database connection parameters
$host = 'localhost'; // Hostname
$dbname = 'newssystem'; // Database name
$username = 'root'; // Database username
$password = 'root'; // Database password

try {
    // Establish a database connection
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Set PDO to throw exceptions on error
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Connected successfully"; // Connection successful message
} catch (PDOException $e) {
    // If connection fails, catch and display the error message
    echo "Connection failed: " . $e->getMessage();
}
?>
