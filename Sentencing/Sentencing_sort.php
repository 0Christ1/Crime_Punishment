<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sentences</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Sentences</h2>
        <a class="btn btn-primary" href="./Sentences_add.php" role="button">New Sentence</a>
        <a class="btn btn-primary" href="./Sentences_sort.php" role="button">Sort by Sentence ID by Ascending</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Sentence ID</th>
                    <th>Criminal_ID</th>
                    <th>Prob_ID</th>
                    <th>Type</th>
                    <th>Start_date</th>
                    <th>End_date</th>
                    <th>Violations</th>
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
                
                $sql = "SELECT * FROM Sentences ORDER BY Sentence_ID";
                $result = $conn->query($sql);
                
                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }
                
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                            <td>{$row['Sentence_ID']}</td>
                            <td>{$row['Criminal_ID']}</td>
                            <td>{$row['Prob_ID']}</td>
                            <td>{$row['Type']}</td>
                            <td>{$row['Start_date']}</td>
                            <td>{$row['End_date']}</td>
                            <td>{$row['Violations']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='./Sentences_update.php?id=" . $row['Sentences_ID'] . "'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='./Sentences_delete.php?id=" . $row['Sentences_ID'] . "'>Delete</a>
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

