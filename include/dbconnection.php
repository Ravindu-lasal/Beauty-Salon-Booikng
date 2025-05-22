<?php
$host = 'localhost';
$username = 'root'; 
$password = '';
$database = 'loreal_salon';


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $username, $password, $database);

    $conn->set_charset("utf8mb4");
    echo "Connection successful!";
    
} catch (Exception $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

