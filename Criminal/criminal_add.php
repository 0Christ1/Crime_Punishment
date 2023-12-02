<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$id = $last = $first = $street = $city = $state = $zip = $phone = $v_status = $p_status =  "";
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
    $street = $_POST["street"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $zip = $_POST["zip"];
    $phone = $_POST["phone"];
    $v_status = $_POST["v_status"];
    $p_status = $_POST["p_status"];


    if (empty($id)) {
        $errorMessage = "Criminal ID is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO Criminal (Criminal_ID, Last, First, Street, City, State, Zip, Phone, V_status, P_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("dsssssssss", $id, $last, $first, $street, $city, $state, $zip, $phone, $v_status, $p_status);

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
    <title>Add Criminal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Criminal</h2>
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
                <label class="col-sm-3 col-form-label">Criminal ID</label>
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
                <label class="col-sm-3 col-form-label">Street</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="street" value="<?php echo htmlspecialchars($street); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">City</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="city" value="<?php echo htmlspecialchars($city); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">State</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="state" value="<?php echo htmlspecialchars($state); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Zip</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="zip" value="<?php echo htmlspecialchars($zip); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">V_status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="v_status" value="<?php echo htmlspecialchars($v_status); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">P_status</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="p_status" value="<?php echo htmlspecialchars($p_status); ?>">
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