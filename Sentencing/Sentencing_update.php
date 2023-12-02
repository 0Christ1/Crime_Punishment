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
    $stmt = $conn->prepare("SELECT * FROM Sentences WHERE Sentence_ID = ?");
    $stmt->bind_param("i", $id); // Change "i" to "s" if Officer_ID is a string
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./index.php");
        exit;
    }

    $id = $row["Sentence_ID"];
    $Criminal_ID = $row["Criminal_ID"];
    $Prob_ID = $row["Prob_ID"];
    $Type = $row["Type"];
    $Start_date = $row["Start_date"];
    $End_date = $row["End_date"];
    $Violations = $row["Violations"];

} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
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
        $sql = "UPDATE Sentences SET Criminal_ID = ?, Prob_ID = ?, Type = ?, Start_date = ?, End_date = ?, Violations = ? WHERE Sentence_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("dddsssd", $last, $first, $precinct, $badge, $phone, $status, $id);
        if ($stmt->execute()) {
            $successMesssage = "Sentence updated successfully";
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
    <title>Update Sentences</title>
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
            <input type="hidden" name="id" value='<?php echo htmlspecialchars($id); ?>'>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Sentence ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="id" value="<?php echo htmlspecialchars($id); ?>">
                </div>
            </div>
            
            <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Criminal_ID</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="Criminal_ID" value="<?php echo htmlspecialchars($Criminal_ID); ?>">
        </div>
    </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Prob_ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Prob_ID" value="<?php echo htmlspecialchars($Prob_ID); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Type</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Type" value="<?php echo htmlspecialchars($Type); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Start_date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Start_date" value="<?php echo htmlspecialchars($Start_date); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">End_date</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="End_date" value="<?php echo htmlspecialchars($End_date); ?>">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Violations</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="Violations" value="<?php echo htmlspecialchars($Violations); ?>">
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
