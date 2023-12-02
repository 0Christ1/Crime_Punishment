<?php
// Initialize error and success messages
$errorMessage = $successMessage = "";

// Database credentials
$servname = "localhost";
$username = "root";
$password = "";
$dbname = "Project3";

// Database connection
$conn = mysqli_connect($servname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    if (!isset($_GET["id"])) {
        header("location: ./index.php");
        exit;
    }
    $code = $_GET["id"];
    
    // Using prepared statement for security
    $stmt = $conn->prepare("SELECT * FROM Crime_Codes WHERE Crime_code = ?");
    $stmt->bind_param("i", $code); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./index.php");
        exit;
    }
    $code = $row["Crime_Code"];
    $description = $row["Code_description"];
} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $code = $_POST["code"];
    $description = $_POST["description"];

    if (empty($code)) {
        $errorMessage = "Crime Code is required";
    } else {
        $sql = "UPDATE Crime_Codes SET Code_description = ? WHERE Crime_Code = ?"; 
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $description, $code);
        if ($stmt->execute()) {
            $successMessage = "Crime Code updated successfully";
        } else {
            $errorMessage = "Error updating record: " . $conn->error;
        }
        $stmt->close();

        header("location: ./index.php");
        exit;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Crime Code</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>Crime Code Details</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo htmlspecialchars($errorMessage); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($successMessage)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo htmlspecialchars($successMessage); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="post">
            <input type="hidden" name="code" value='<?php echo htmlspecialchars($code); ?>'>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crime Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="code" value="<?php echo htmlspecialchars($code); ?>" required>
                </div>
            </div>
        
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Code Description</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="description" value="<?php echo htmlspecialchars($description); ?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="./index.php" role="button">Cancel</a>
            </div>
        </div>
    </form>

    </div>
</body>
</html>
