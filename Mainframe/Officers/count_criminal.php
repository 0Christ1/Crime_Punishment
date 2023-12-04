<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Count Criminals</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
    <h1>Enter Officer ID to Count Associated Criminals</h1>
    <form action="count_criminal.php" method="post">
        <label for="officer_id">Officer ID:</label>
        <input type="number" id="officer_id" name="officer_id" required>
        <input type="submit" value="Submit">
    </form>

    <table class="table">
            <thead>
                <tr>
                    <th>Number of Criminal</th>
                </tr>
            </thead>
    <tbody>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $officer_id = isset($_POST['officer_id']) ? (int)$_POST['officer_id'] : 0;

        // Database connection variables
        $servname = "localhost";
        $username = "root";
        $password = "";
        $dbname = "Project3";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // SQL to call the function
        $sql = "SELECT count_crinimal(?) AS criminal_count";

        // Prepare statement
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Error preparing statement: " . $conn->error);
        }

        // Bind parameters and execute
        $stmt->bind_param("i", $officer_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Output data of each row
            $row = $result->fetch_assoc();
            echo "<tr>
                    <td>{$row['criminal_count']}</td>
                </tr>";
        } else {
            echo "0 results";
        }

        $stmt->close();
        $conn->close();
    }
    ?>
    </div>
</body>
</html>
