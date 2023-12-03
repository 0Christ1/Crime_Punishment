<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Officers</h2>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Officer ID</th>
                    <th>Last</th>
                    <th>First</th>
                    <th>Precinct</th>
                    <th>Badge Number</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servname = "localhost";
                $username = "root";
                $password = "";
                $dbname = "Project3";
                
                // Database connection
                $conn = mysqli_connect($servname, $username, $password, $dbname);
                if(!$conn){
                    die("Connection failed: " . mysqli_connect_error());
                }
                
                $sql = "SELECT * FROM Officers";
                $result = $conn->query($sql);
                
                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }
                
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                            <td>{$row['Officer_ID']}</td>
                            <td>{$row['Last']}</td>
                            <td>{$row['First']}</td>
                            <td>{$row['Precinct']}</td>
                            <td>{$row['Badge_Number']}</td>
                            <td>{$row['Phone']}</td>
                            <td>{$row['Status']}</td>
                          </tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>    
    </div>
</body>
</html>