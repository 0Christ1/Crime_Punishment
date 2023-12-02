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
        <h2>List of Crime</h2>
        <a class="btn btn-primary" href="./Officer_add.php" role="button">New Officer</a>
        <a class="btn btn-primary" href="./officer_sort.php" role="button">Sort by Officer ID by Ascending</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Crime ID</th>
                    <th>Classification</th>
                    <th>Date_charged</th>
                    <th>Status</th>
                    <th>Hearing_date</th>
                    <th>Appeal_cut_date</th>
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

                    $sql = "SELECT * FROM Crime ORDER BY Crime_ID";
                    $result = $conn->query($sql);

                    if (!$result) {
                        die("Invalid query: " . $conn->error);
                    }
                    
                    while($row = $result->fetch_assoc()){
                        echo "<tr>
                                <td>{$row['Crime_ID']}</td>
                                <td>{$row['Classification']}</td>
                                <td>{$row['Date_charged']}</td>
                                <td>{$row['Status']}</td>
                                <td>{$row['Hearing_date']}</td>
                                <td>{$row['Appeal_cut_date']}</td>
                                <td>
                                    <a class='btn btn-primary btn-sm' href='./Crime_update.php?id=" . $row['Crime_ID'] . "'>Edit</a>
                                    <a class='btn btn-danger btn-sm' href='./Crime_delete.php?id=" . $row['Crime_ID'] . "'>Delete</a>
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
    
    