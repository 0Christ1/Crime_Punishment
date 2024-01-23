# Overview
Our database-driven website offers a platform that enables users to efficiently manage data with functionalities like retrieving, adding, updating, deleting, and sorting. It supports multiple users, allowing concurrent database manipulation without interference. At the application level, we ensure robust security by verifying user credentials, protecting sensitive information from general access, and implementing auto-logout after 15 minutes. Additionally, our approach includes encrypting sensitive data in the database and designing tables to store information in a general format, enhancing security by avoiding the storage of highly sensitive details.

# Intro Page
![intro_page](/Assets/intro_page.png)

# Login Page
![Log in](/Assets/log_in_page.png)

# Home Page
![Home Page](/Assets/homepage.png)

# Operating with Data
![Display](/Assets/table_display.png)
## Retrieve data
``` php
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
```
## Add data
``` php
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Initialize variables
$id = $last = $first = $precinct = $badge = $phone = $status = "";
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
    $last = $_POST["last"];
    $first = $_POST["first"];
    $precinct = $_POST["precinct"];
    $badge = $_POST["badge"];
    $phone = $_POST["phone"];
    $status = $_POST["status"];

    if (empty($id)) {
        $errorMessage = "Officer ID is required";
    } else {
        $stmt = $conn->prepare("INSERT INTO Officers (Officer_ID, Last, First, Precinct, Badge_Number, Phone, Status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("dssssss", $id, $last, $first, $precinct, $badge, $phone, $status);

        if ($stmt->execute()) {
            $successMesssage = "$first is registered successfully!";
            header("location: ./index.php");
            exit;
        } else {
          echo '<script language="javascript">alert("Error: ' . $stmt->error . '");</script>';
        }

        $stmt->close();
    }
}
$conn->close();
?>
```
## Update data
``` php
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
    $stmt = $conn->prepare("SELECT * FROM Officers WHERE Officer_ID = ?");
    $stmt->bind_param("i", $id); // Change "i" to "s" if Officer_ID is a string
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location: ./index.php");
        exit;
    }

    $id = $row["Officer_ID"];
    $last = $row["Last"];
    $first = $row["First"];
    $precinct = $row["Precinct"];
    $badge = $row["Badge_Number"];
    $phone = $row["Phone"];
    $status = $row["Status"];

} elseif ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST["id"];
    $last = $_POST["last"];
    $first = $_POST["first"];
    $precinct = $_POST["precinct"];
    $badge = $_POST["badge"];
    $phone = $_POST["phone"];
    $status = $_POST["status"];


    if (empty($id)) {
        $errorMessage = "Officer ID is required";
    } else {
        $sql = "UPDATE Officers SET Last = ?, First = ?, Precinct = ?, Badge_Number = ?, Phone = ?, Status = ? WHERE Officer_ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssd", $last, $first, $precinct, $badge, $phone, $status, $id);
        if ($stmt->execute()) {
            $successMesssage = "Officer updated successfully";
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
```
## Delete data
``` php // Database connection
$conn = mysqli_connect($servname, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the 'id' parameter is set in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM Officers WHERE Officer_ID = ?");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    // Bind the parameter to the statement
    $stmt->bind_param("i", $id); // Assuming 'Officer_ID' is an integer

    // Execute the statement
    if ($stmt->execute()) {
        header("location: ./index.php");
        exit;
    } else {
        echo '<script language="javascript">alert("Error deleting record: foreign key constraint");location.href="./index.php";</script>';
    }
    $stmt->close();
}

$conn->close();
?> -->
```
# Advanced PL/SQL commands
**Stored Procedure** 
- retrieve information about criminals based on their association officers
``` sql

DELIMITER $$

DROP PROCEDURE IF EXISTS track_crinimal$$

CREATE PROCEDURE track_crinimal(IN officer_id NUMERIC(8))
BEGIN
    SELECT Criminal.First, Criminal.Last
	FROM Criminal
    WHERE Criminal.Criminal_ID IN (SELECT Criminal_Crime.Criminal_ID
			FROM Criminal_Crime
			INNER JOIN Crime_officers
			ON Criminal_Crime.Crime_ID = Crime_officers.Crime_ID
   			WHERE Crime_officers.Officer_ID = officer_id);

END$$

DELIMITER ;
```
**Function**
- Given a officer ID, the function count_crinimal returns numbers of criminal they have

``` sql

DELIMITER //
CREATE OR REPLACE FUNCTION count_crinimal(officer_id NUMERIC(8)) RETURNS INT DETERMINISTIC
BEGIN
	DECLARE count INT;
    SET count = (
        SELECT COUNT(Criminal_ID)
			FROM Criminal
    		WHERE Criminal.Criminal_ID IN (
                SELECT Criminal_Crime.Criminal_ID
				FROM Criminal_Crime
				INNER JOIN Crime_officers
				ON Criminal_Crime.Crime_ID = Crime_officers.Crime_ID
   				WHERE Crime_officers.Officer_ID = officer_id));
    RETURN count;
END //

DELIMITER ;
```


# Design Database
Below is an Entity-Relationship (E-R) diagram that features a set of normalized tables, which are described using Schema statements.
![ERD](/Assets/ERD.png)

# Part of SQL commands to build a database
``` sql
CREATE TABLE Officers
(
    Officer_ID      NUMERIC(8),
    Last            VARCHAR(15),
    First           VARCHAR(10),
    Precinct        CHAR(4) NOT NULL,
    Badge           VARCHAR(14) UNIQUE,
    Phone           CHAR(10),
    Status          CHAR(1) DEFAULT 'A',
    CONSTRAINT O_ID PRIMARY KEY(Officer_ID)
);

INSERT INTO Officers (Officer_ID, Last, First, Precinct, Badge, Phone, Status) VALUES 
(80000001, 'Cena', 'John', '0101', 'B123456', '5552000001', 'A'),
(80000002, 'Johnson', 'Emily', '0102', 'B123457', '5552000002', 'A'),
(80000003, 'Williams', 'Michael', '0103', 'B123458', '5552000003', 'A'),
(80000004, 'Brown', 'Sarah', '0104', 'B123459', '5552000004', 'I'),
(80000005, 'Jones', 'Robert', '0105', 'B123460', '5552000005', 'A'),
(80000006, 'Garcia', 'Maria', '0106', 'B123461', '5552000006', 'A'),
(80000007, 'Miller', 'James', '0107', 'B123462', '5552000007', 'A'),
(80000008, 'Davis', 'Linda', '0108', 'B123463', '5552000008', 'A'),
(80000009, 'Rodriguez', 'Carlos', '0109', 'B123464', '5552000009', 'I'),
(80000010, 'Martinez', 'Jessica', '0110', 'B123465', '5552000010', 'A');
```

# Instructions to run
-- The database is hosted locally within an XAMPP development environment, accessible via 'localhost' on the default port '3306'
-- First, launch the XAMPP Control Panel. Then navigate to “htdocs” folder in your XAMPP and create a new folder named “NYUPD”. 
-- Afterward, access phpMyAdmin and import the SQL file provided. Last, go to the web browser, and enter “http://localhost/nyupd/”. Therefore, you can deploy our app.

# Database security at the database level
In the database, we create a role column for the users table, which classifies users as “junior” or “senior” with juniors granted read-only access and seniors granted adding, updating, deleting and sorting. The security is established for end users by adding a role column to the users database that allows users to be categorized as "junior" or "senior" with varying levels of access. With this configuration, users' access to the application or system is restricted, with different permissions granted to junior and senior users within the database. It is a type of user-facing security mechanism known as role-based access control, or RBAC.

**Set Privileges To Users**
- SQL commands to set privileges

``` sql
CREATE ROLE Senior_Police_Officer;

GRANT SELECT, INSERT, UPDATE, DELETE ON * Senior_Police_Officer WITH GRANT OPTION;
```


# Database security at the database level
We incorporate hash function in our app, which user passwords are securely hashed before they were stored. In this way, it could ensure users’ privacy since even if the developers of the database is accessed, the actual passwords remain undisclosed. Therefore, this significantly enhances user data security. The screenshot of the developer page is shown below, as you can see, the password has been hashed.
``` php
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
```





