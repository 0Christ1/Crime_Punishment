<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$id = $Crime_ID = $Filling_date = $Hearing_date = $Status = "";
$errorMessage = $successMesssage = "";

//Database credentials 
$servname = "localhost";
$username = "root";
$password = "";
$dbname = "Project3";

//Database connection
$conn = mysqli_connect($servname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

//Check for form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $Crime_ID = $_POST["Crime_ID"];
    $Filling_date = $_POST["Filling_date"];
    $Hearing_date = $_POST["Hearing_date"];
    $Status = $_POST["Status"];

    if (empty($id)) {
        $errorMessage = "Appeal ID is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO Appeal (Appeal_ID, Crime_ID, Filling_date, Hearing_date, Status) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ddsss", $id, $Crime_ID, $Filling_date, $Hearing_date, $Status);

        if ($stmt->execute()) {
            $successMesssage = "$id is registered successfully!";
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
    <title>Add Appeal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Appeal</h2>
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
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Appeal ID" name="id" value="<?php echo htmlspecialchars($id); ?>">
                </div>
            </div>
        
            <div class="row mb-3">
        <div class="col-sm-6">
            <input type="text" class="form-control" placeholder = "Crime_ID" name="Crime_ID" value="<?php echo htmlspecialchars($Crime_ID); ?>">
        </div>
    </div> 

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Filling_date" name="Filling_date" value="<?php echo htmlspecialchars($Filling_date); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Hearing_date" name="Hearing_date" value="<?php echo htmlspecialchars($Hearing_date); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Status" name="Status" value="<?php echo htmlspecialchars($Status); ?>">
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


