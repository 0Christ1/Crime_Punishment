<?php


$filePath = '/path/to/your/file/or/directory';

// Set the permissions to 0777 (read, write, and execute for owner, group, and others)
if (!chmod($filePath, 0777)) {
    echo "Failed to set permissions for $filePath";
} else {
    echo "Permissions set successfully for $filePath";
}


ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database credentials
$servname = "localhost";
$username = "root";
$password = "";
$dbname = "Project3";

// Establish database connection
$conn = new mysqli($servname, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to select data from the Officers table
$sql = "SELECT Officer_ID, Last, First, Precinct, Badge_Number, Phone, Status FROM Officers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Define the CSV file name and path
    $csvFileName = 'officers_data.csv';
    $csvFilePath = __DIR__ . '/' . $csvFileName;

    // Open/create a file to write to
    $csvFile = fopen($csvFilePath, "w");
    if (!$csvFile) {
        die("Failed to open file for writing. Check permissions for: " . $csvFilePath);
    }

    // Optional: Write column headers to CSV
    $headers = array('Officer ID', 'Last Name', 'First Name', 'Precinct', 'Badge Number', 'Phone', 'Status');
    fputcsv($csvFile, $headers);

    // Fetch each row and write to the CSV file
    while ($row = $result->fetch_assoc()) {
        fputcsv($csvFile, $row);
    }

    // Close the CSV file
    fclose($csvFile);

    echo "Data exported successfully to $csvFileName";

} else {
    echo "0 results";
}

// Close database connection
$conn->close();
?>
