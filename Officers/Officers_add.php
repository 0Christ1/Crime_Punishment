<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$id = $last = $first = $precinct = $badge = $phone = $status = "";
$errorMessage = $successMesssage = "";

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

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $last = $_POST["last"];
    $first = $_POST["first"];
    $precinct = $_POST["precinct"];
    $badge = $_POST["badge"];
    $phone = $_POST["phone"];
    $status = $_POST["status"];

    if (empty($id)) {
        $errorMessage = "Officer ID is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO Officers (Officer_ID, Last, First, Precinct, Badge_Number, Phone, Status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssiss", $id, $last, $first, $precinct, $badge, $phone, $status);

        if ($stmt->execute()) {
            $successMesssage = "$first is registered successfully!";
            header("location: ./index.php");
            exit;
        } else {
            $errorMessage = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
$conn->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Officer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Officer</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong><?php echo htmlspecialchars($errorMessage); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <?php if (!empty($successMesssage)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong><?php echo htmlspecialchars($successMesssage); ?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Officer ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo htmlspecialchars($id); ?>">
                </div>
            </div>
            
            <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Last Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="last" value="<?php echo htmlspecialchars($last); ?>">
        </div>
    </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">First Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="first" value="<?php echo htmlspecialchars($first); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Precinct</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="precinct" value="<?php echo htmlspecialchars($precinct); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Badge Number</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="badge" value="<?php echo htmlspecialchars($badge); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="status" value="<?php echo htmlspecialchars($status); ?>">
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
