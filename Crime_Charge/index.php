<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crime Charge</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5"> 
        <h2>List of Crime Charge</h2>
        <a class="btn btn-primary" href="./crime_charge_add.php" role="button">New Crime Charge</a>
        <a class="btn btn-primary" href="./crime_charge_sort.php" role="button">Sort by Crime Charge ID by Ascending</a>
        <br>
        <table class="table">
            <thead> 
                <tr>
                    <th>Charge ID</th>
                    <th>Crime ID</th>
                    <th>Crime Code</th>
                    <th>Charge Status</th>
                    <th>Fine Amount</th>
                    <th>Court Fee</th>
                    <th>Amount Paid</th>
                    <th>Pay Due Date</th>
                    <th>Action</th>
                </tr> 
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

                $sql = "SELECT * FROM Crime_charges";
                $result = $conn->query($sql);
                
                if (!$result) {
                    die("Invalid query: " . $conn->error);
                }

                while($row = $result->fetch_assoc()){
                    echo "<tr>
                            <td>{$row['Charge_ID']}</td>
                            <td>{$row['Crime_ID']}</td>
                            <td>{$row['Crime_Code']}</td>
                            <td>{$row['Charge_status']}</td>
                            <td>{$row['Fine_amount']}</td>
                            <td>{$row['Court_fee']}</td>
                            <td>{$row['Amount_paid']}</td>
                            <td>{$row['Pay_due_date']}</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='./crime_charge_update.php?id=" . $row['Charge_ID'] . "'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='./crime_charge_delete.php?id=" . $row['Charge_ID'] . "'>Delete</a>
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
