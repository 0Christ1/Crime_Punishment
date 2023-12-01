<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$Code = $description = "";
$errorMessage = $successMesssage = "";

/ Database credentials
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
    $code = $_POST["code"];
    $description = $_POST["description"];

    if (empty($id)) {
        $errorMessage = "Crime Code is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO Crime_Code (Crime_Code, Code_description) VALUES (?, ?)");
        $stmt->bind_param("ds", $code, $description);
        if ($stmt->execute()) {
            $successMesssage = "$code is created successfully!";
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
    <title>Add Crime_Code</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
            <h2>New Crime_Code</h2>
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
                    <label class="col-sm-3 col-form-label">Crime Code</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="id" value="<?php echo htmlspecialchars($id); ?>">
                    </div>
                </div>
                
                <div class="row mb-3">
                    <label class="col-sm-3 col-form-label">Code description</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="last" value="<?php echo htmlspecialchars($last); ?>">
                    </div>
                </div>
            </form>
        </div>
    </body>
    </html>

