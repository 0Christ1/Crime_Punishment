<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$id = $Crime_id = $Crime_code = $Charge_status = $Fine_amount = $Court_fee = $Amount_paid = $Pay_due_date = "";
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
    $Crime_id = $_POST["Crime_id"];
    $Crime_code = $_POST["Crime_Code"];
    $Charge_status = $_POST["Charge_status"];
    $Fine_amount = $_POST["Fine_amount"];
    $Court_fee = $_POST["Court_fee"];
    $Amount_paid = $_POST["Amount_paid"];
    $Pay_due_date = $_POST["Pay_due_date"];

    if (empty($id)) {
        $errorMessage = "Crime Charge ID is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO Crime_charges (Charge_ID, Crime_ID, Crime_Code, Charge_status, Fine_amount, Court_fee, Amount_paid, Pay_due_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisiiis", $id, $Crime_id, $Crime_code, $Charge_status, $Fine_amount, $Court_fee, $Amount_paid, $Pay_due_date);

        if ($stmt->execute()) {
            $successMesssage = "$id is registered successfully!";
            header("Location: ./index.php");
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
    <title>Add Crime Charge</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Crime Charge</h2>
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
                    <input type="text" class="form-control" placeholder = "Charge ID" name="id" value="<?php echo htmlspecialchars($id); ?>">
                </div>
            </div>
        
            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Crime ID" name="Crime_id" value="<?php echo htmlspecialchars($Crime_id); ?>">
                </div>
            </div> 

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Crime Code" name="Crime_Code" value="<?php echo htmlspecialchars($Crime_code); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Charge Status" name="Charge_status" value="<?php echo htmlspecialchars($Charge_status); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Fine Amount" name="Fine_amount" value="<?php echo htmlspecialchars($Fine_amount); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Court Fee" name="Court_fee" value="<?php echo htmlspecialchars($Court_fee); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Amount Paid"  name="Amount_paid" value="<?php echo htmlspecialchars($Amount_paid); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Pay Due Date" name="Pay_due_date" value="<?php echo htmlspecialchars($Pay_due_date); ?>">
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
