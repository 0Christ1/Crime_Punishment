<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime_Code</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2>List of Crime_Code</h2>
        <a class="btn btn-primary" href="./Crime_Code_add.php" role="button">New Crime_Code</a>
        <a class="btn btn-primary" href="./Crime_Code_sort.php" role="button">Sort by Crime_Code by Ascending</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Crime_Code </th>
                    <th>Code_desciption</th>
                <tr>
            </thead>
            <tbody>
                <?php
                $servname = "localhost";
                $username = "root";
                $password = "";
                $dbname = "Project3";

                //Database connection
                $conn = mysqli_connect($servname, $username, $password, $dbname);
                if(!$conn){
                    die("Connection failed: " . mysqli_connect_error());
                }
                
<<<<<<< HEAD
                $sql = "SELECT * FROM Crime_Code";
=======
                $sql = "SELECT * FROM Crime_Codes";
>>>>>>> 2215780ae2ec8cdcb18f174bb504e0b2c5c77a0a
                $result = $conn->query($sql);
                
                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }

                while ($row = $result -> fetch_assoc()){
                    echo "<tr>
                            <td>{$row['Crime_Code']}</td>
                            <td>{$row['Code_description']}</td>
                           
                            <td>
                                <a class='btn btn-primary btn-sm' href='./Crime_Code_update.php?id=" . $row['Crime_Code'] . "'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='./Crime_Code_delete.php?id=" . $row['Crime_Code'] . "'>Delete</a>
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