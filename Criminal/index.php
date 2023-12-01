<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criminal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Criminal</h2>
        <a class="btn btn-primary" href="./criminal_add.php" role="button">New Criminal</a>
        <a class="btn btn-primary" href="./criminal_sort.php" role="button">Sort by Criminal ID by Ascending</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Criminal ID</th>
                    <th>Last</th>
                    <th>First</th>
                    <th>Street</th>
                    <th>City</th>
                    <th>State</th>
                    <th>Zip</th>
                    <th>Phone</th>
                    <th>V_status</th>
                    <th>P_status</th>
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
                
                $sql = "SELECT * FROM Criminal";
                $result = $conn->query($sql);
                
                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }
                
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                            <td>{$row['Criminal_ID']}</td>
                            <td>{$row['Last']}</td>
                            <td>{$row['First']}</td>
                            <td>{$row['Street']}</td>
                            <td>{$row['City']}</td>
                            <td>{$row['State']}</td>
                            <td>{$row['Zip']}</td>
                            <td>{$row['Phone']}</td>
                            <td>{$row['V_status']}</td>
                            <td>{$row['P_status']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='./criminal_update.php?id=" . $row['Criminal_ID'] . "'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='./criminal_delete.php?id=" . $row['Criminal_ID'] . "'>Delete</a>
                            </td>
                          </tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>    
    </div>
</body>
</html>
