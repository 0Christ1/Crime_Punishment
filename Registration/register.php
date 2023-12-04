<?php
include "connect.php";

// Get the values from the form
$firstname = $_POST['fname'];
$lastname = $_POST['lname'];
$username = $_POST['uname'];
$password = $_POST['pwd'];
$role = $_POST['role'];

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if user already exists
$checkUserSql = "SELECT * FROM users WHERE username = '$username'";
$checkUserResult = mysqli_query($conn, $checkUserSql);

if (mysqli_num_rows($checkUserResult) > 0) {
    // User already exists, redirect to login page
    echo '<script language="javascript">alert("'.$username.' already exists, Please Login!"); location.href="../Login/index.html";</script>';
} else {
    // User doesn't exist, proceed with registration
    $sql = "INSERT INTO users(firstname, lastname, username, password, role) VALUES ('$firstname', '$lastname', '$username', '$hashed_password', '$role')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Registration successful, redirect to mainframe
        echo '<script language="javascript">alert("' . $firstname . ', Registered successfully!"); location.href="../Mainframe/index.html";</script>';
    } else {
        // Registration failed, handle error
        echo '<script language="javascript">alert("Registration failed, Please try again!");</script>';
    }
}

$conn->close();
?>
