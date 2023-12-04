<?php
session_start();
include "connect.php";

$un = mysqli_real_escape_string($conn, $_POST['uname']);
$enteredPassword = mysqli_real_escape_string($conn, $_POST['pwd']);

$sql = "SELECT * FROM users WHERE username = '$un'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1){
    $row = mysqli_fetch_assoc($result);
    if(password_verify($enteredPassword, $row['password'])){
        $_SESSION['user_role'] = $row['role']; 
        $_SESSION['login_time'] = time(); 
        echo '<script language="javascript">alert("Welcome Back, ' . $un .'!"); location.href="../Mainframe/index.php";</script>';
    } else {
        echo '<script language="javascript">alert("Incorrect Username or Password!");location.href="./index.html";</script>';
    }
} else {
    echo '<script language="javascript">alert("User does not exist. Please Register!");location.href="../Registration";</script>';
}
?>
