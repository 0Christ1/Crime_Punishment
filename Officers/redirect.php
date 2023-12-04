<?php
session_start();

if (!isset($_SESSION['user_role'])) {
    // If user has no role, redirect to register page
    header('Location: ../Registration/index.html');
    exit;
}

$user_role = $_SESSION['user_role']; // 'Junior' or 'Senior'

$redirectUrl = ($user_role == 'Senior') ? "index.php" : "view.php";

header('Location: ' . $redirectUrl);
exit;
?>

