<?php
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
    $id = $_GET["id"];

    // Using prepared statement for security
    $stmt = $conn->prepare("SELECT * FROM Appeal WHERE Appeal_ID = ?");
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./index.php");
        exit;
    }

    $id = $row["Appeal_ID"];
    $Crime_ID = $row["Crime_ID"];
    $Filling_date = $row["Filling_date"];
    $Hearing_date = $row["Hearing_date"];
    $Status = $row["Status"];
}elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $Crime_ID = $_POST["Crime_ID"];
    $Filling_date = $_POST["Filling_date"];
    $Hearing_date = $_POST["Hearing_date"];
    $Status = $_POST["Status"];

    if (empty($id)) {
        $errorMessage = "Appeal ID is required";
    } else {
        $sql = "UPDATE Appeal SET Crime_ID = ?, Filling_date = ?, Hearing_date = ?, Status = ? WHERE Appeal_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("isssi", $Crime_ID, $Filling_date, $Hearing_date, $Status, $id);
        if ($stmt->execute()) {
            $successMesssage = "Appeal updated successfully";
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
            <input type="text" class="form-control"placeholder = "Crime_ID" name="Crime_ID" value="<?php echo htmlspecialchars($Crime_ID); ?>">
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
