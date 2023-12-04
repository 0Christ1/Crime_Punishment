<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$id = $Criminal_ID = $Prob_ID = $Type = $Start_date = $End_date = $Violations = "";
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
    $Criminal_ID = $_POST["Criminal_ID"];
    $Prob_ID = $_POST["Prob_ID"];
    $Type = $_POST["Type"];
    $Start_date = $_POST["Start_date"];
    $End_date = $_POST["End_date"];
    $Violations = $_POST["Violations"];

    if (empty($id)) {
        $errorMessage = "Sentence ID is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO Sentences (Sentence_ID, Criminal_ID, Prob_ID, Type, Start_date, End_date, Violations) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("dddsssd", $id, $Criminal_ID, $Prob_ID, $Type, $Start_date, $End_date, $Violations);

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
    <title>Add Sentences</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>New Sentences</h2>
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
                    <input type="text" class="form-control" placeholder = "Sentence ID" name="id" value="<?php echo htmlspecialchars($id); ?>">
                </div>
            </div>
            
            <div class="row mb-3">
        <div class="col-sm-6">
            <input type="text" class="form-control" placeholder = "Criminal ID" name="Criminal_ID" value="<?php echo htmlspecialchars($Criminal_ID); ?>">
        </div>
    </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Probation ID" name="Prob_ID" value="<?php echo htmlspecialchars($Prob_ID); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Type" name="Type" value="<?php echo htmlspecialchars($Type); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Start Date" name="Start_date" value="<?php echo htmlspecialchars($Start_date); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "End Date" name="End_date" value="<?php echo htmlspecialchars($End_date); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6">
                    <input type="text" class="form-control" placeholder = "Violations" name="Violations" value="<?php echo htmlspecialchars($Violations); ?>">
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


   