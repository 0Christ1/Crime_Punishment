<?php
include "connect.php";

// Get the values from the form
$un = mysqli_real_escape_string($conn, $_POST['uname']);
$enteredPassword = mysqli_real_escape_string($conn, $_POST['pwd']);

$sql = "SELECT * FROM users WHERE username = '$un'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if(password_verify($enteredPassword, $row['password'])){
        // Password is correct
        echo '<script language="javascript">alert("Login Successful!");location.href="../Mainframe/index.html";</script>';
    } else {
        // Password is incorrect
        echo '<script language="javascript">alert("Incorrect Username or Password!");location.href="./index.html";</script>';
    }
} else {
    // User does not exist
    echo '<script language="javascript">alert("User does not exist. Please Register!");location.href="../Registration/index.html";</script>';
}
?>