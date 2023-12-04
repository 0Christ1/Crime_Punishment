<?php
session_start();

if (!isset($_SESSION['user_role'])) {
    header('Location: ../Login/index.php'); 
    exit;
}

$user_role = $_SESSION['user_role'];
$page = $_GET['page'];


if ($user_role == 'Senior') {
    switch ($page) {
        case 'Crime':
            $redirectUrl = "../Mainframe/Crime/index.php";
            break;
        case 'CrimeCode':
            $redirectUrl = "../Mainframe/Crime_Code/index.php";
            break;
        case 'CrimeCharges':
            $redirectUrl = "../Mainframe/Crime_Charges/index.php";
            break;
        case 'Criminal':
            $redirectUrl = "../Mainframe/Criminal/index.php";
            break;
        case 'Officers':
            $redirectUrl = "../Mainframe/Officers/index.php";
            break;
        case 'Sentencing':
            $redirectUrl = "../Mainframe/Sentencing/index.php";
            break;
        case 'Appeal':
            $redirectUrl = "../Mainframe/Appeal/index.php";
            break;
        default:
            $redirectUrl = "../Mainframe/index.php"; // 默认情况下重定向到主页面
    }
} else { 
    switch ($page) {
        case 'Crime':
            $redirectUrl = "../Mainframe/Crime/Crime_view.php";
            break;
        case 'CrimeCode':
            $redirectUrl = "../Mainframe/Crime_Code/view.php";
            break;
        case 'CrimeCharges':
            $redirectUrl = "../Mainframe/Crime_Charges/view.php";
            break;
        case 'Criminal':
            $redirectUrl = "../Mainframe/Criminal/view.php";
            break;
        case 'Officers':
            $redirectUrl = "../Mainframe/Officers/view.php";
            break;
        case 'Sentencing':
            $redirectUrl = "../Mainframe/Sentencing/view.php";
            break;
        case 'Appeal':
            $redirectUrl = "../Mainframe/Appeal/view.php";
            break;
        default:
            $redirectUrl = "../Mainframe/index.php";
    }
}

header('Location: ' . $redirectUrl);
exit;
?>
