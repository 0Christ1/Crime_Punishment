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
if (isset($_GET['id'])) {
    $code = $_GET['id'];

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM Crime_Codes WHERE Crime_Code = ?");
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
        echo '<script language="javascript">alert("Error deleting record: foreign key constraint");location.href="./index.php";</script>';
    }

    $stmt->close();
}

$conn->close();
?>

