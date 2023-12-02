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
    $stmt = $conn->prepare("SELECT * FROM Crime WHERE Crime_ID = ?");
    $stmt->bind_param("i", $id); 
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./index.php");
        exit;
    }

    $id = $row["Crime_ID"];
    $Classification = $row["Classification"];
    $Date_charged = $row["Date_charged"];
    $Status = $row["Status"];
    $Hearing_date = $row["Hearing_date"];
    $Appeal_cut_date = $row["Appeal_cut_date"];

}elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
        $id = $_POST["id"];
        $Classification = $_POST["Classification"];
        $Date_charged = $_POST["Date_charged"];
        $Status = $_POST["Status"];
        $Hearing_date = $_POST["Hearing_date"];
        $Appeal_cut_date = $_POST["Appeal_cut_date"];

    if (empty($id)) {
        $errorMessage = "Crime ID is required";
    } else {
        $sql = "UPDATE Crime SET Classification = ?, Date_charged = ?, Status = ?, Hearing_date = ?, Appeal_cut_date = ? WHERE Crime_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $Classification, $Date_charged, $Status, $Hearing_date, $Appeal_cut_date, $id);
        if ($stmt->execute()) {
            $successMesssage = "Crime updated successfully";
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
    <title>Add Crime</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Crime</h2>
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
                <label class="col-sm-3 col-form-label">Crime ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo htmlspecialchars($id); ?>">
                </div>
            </div>
        
            <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Classification</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="Classification" value="<?php echo htmlspecialchars($Classification); ?>">
        </div>
    </div> 

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Date_charged</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Date_charged" value="<?php echo htmlspecialchars($Date_charged); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Status" value="<?php echo htmlspecialchars($Status); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Hearing_date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Hearing_date" value="<?php echo htmlspecialchars($Hearing_date); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Appeal_cut_date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Appeal_cut_date" value="<?php echo htmlspecialchars($Appeal_cut_date); ?>">
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
