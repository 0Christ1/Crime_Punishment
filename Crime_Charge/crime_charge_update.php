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
    $stmt = $conn->prepare("SELECT * FROM Crime_charges WHERE Charge_ID = ?");
    $stmt->bind_param("i", $id); // Change "i" to "s" if Charge_ID is a string
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./index.php");
        exit;
    }

    $id = $row["Charge_ID"];
    $Crime_ID = $row["Crime_ID"];
    $Crime_Code = $row["Crime_Code"];
    $Charge_status = $row["Charge_status"];
    $Fine_amount = $row["Fine_amount"];
    $Court_fee = $row["Court_fee"];
    $Amount_paid = $row["Amount_paid"];
    $Pay_due_date = $row["Pay_due_date"];

} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $Crime_ID = $_POST["Crime_ID"];
    $Crime_Code = $_POST["Crime_Code"];
    $Charge_status = $_POST["Charge_status"];
    $Fine_amount = $_POST["Fine_amount"];
    $Court_fee = $_POST["Court_fee"];
    $Amount_paid = $_POST["Amount_paid"];
    $Pay_due_date = $_POST["Pay_due_date"];

    if (empty($id)) {
        $errorMessage = "Charge ID is required";
    } else {
        $sql = "UPDATE Crime_charges SET Crime_ID = ?, Crime_code = ?, Charge_status = ?, Fine_amount = ?, Court_fee = ?, Amount_paid = ?, Pay_due_date = ? WHERE Charge_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddsdddsd", $Crime_ID, $Crime_Code, $Charge_status, $Fine_amount, $Court_fee, $Amount_paid, $Pay_due_date);
        if ($stmt->execute()) {
            $successMesssage = "Crime charges updated successfully";
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
    <title>Update Crime Charges</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Crime Charges</h2>
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
            <input type="hidden" name="id" value='<?php echo htmlspecialchars($id); ?>'>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Charge ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo htmlspecialchars($id); ?>">
                </div>
            </div>
            
            <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Crime_ID</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="Crime_ID" value="<?php echo htmlspecialchars($Crime_ID); ?>">
        </div>
    </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Crime_Code</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Crime_Code" value="<?php echo htmlspecialchars($Crime_Code); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Charge_status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Charge_status" value="<?php echo htmlspecialchars($Charge_status); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Fine_amount</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Fine_amount" value="<?php echo htmlspecialchars($Fine_amount); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Court_fee</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Court_fee" value="<?php echo htmlspecialchars($Court_fee); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Amount_paid</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Amount_paid" value="<?php echo htmlspecialchars($Amount_paid); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Pay_due_date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Pay_due_date" value="<?php echo htmlspecialchars($Pay_due_date); ?>">
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

