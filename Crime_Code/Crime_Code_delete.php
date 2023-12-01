<?php
// Database credentials
$servname = "localhost";
$username = "root";
$password = "";
$dbname = "Project3";

//Database connection
$conn = mysqli_connect($servname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the 'Crime_Code' parameter is set in the URL
if (isset($_GET['Crime_Code'])) {
    $code = $_GET['Crime_Code'];

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM Crime_Code WHERE Crime_Code = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the parameter to the statement
    $stmt->bind_param("d", $code); // Assuming 'Crime_Code' is an double

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
        header("location: ./index.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

