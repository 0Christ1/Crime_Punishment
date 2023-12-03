<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appeal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Appeal</h2>
        <a class="btn btn-primary" href="./Appeal_add.php" role="button">New Appeal</a>
        <a class="btn btn-primary" href="./Appeal_sort.php" role="button">Sort by Appeal ID by Ascending</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Appeal ID</th>
                    <th>Crime_ID</th>
                    <th>Filling_date</th>
                    <th>Hearing_date</th>
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

                    $sql = "SELECT * FROM Appeal ORDER BY Appeal_ID";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    }
                    
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>{$row['Appeal_ID']}</td>
                                <td>{$row['Crime_ID']}</td>
                                <td>{$row['Filling_date']}</td>
                                <td>{$row['Hearing_date']}</td>
                                <td>{$row['Status']}</td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='./Appeal_update.php?id=" . $row['Appeal_ID'] . "'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href='./Appeal_delete.php?id=" . $row['Appeal_ID'] . "'>Delete</a>
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
    
    