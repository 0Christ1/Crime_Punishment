<?php
session_start();
include 'connect.php'; // 引入数据库连接

// 检查POST变量是否被设置
if (isset($_POST['Badge_Number']) && isset($_POST['password'])) {
    $Badge_Number = $_POST['Badge_Number'];
    $password = $_POST['password'];

    // SQL查询验证徽章号和密码
    $sql = "SELECT * FROM Officers WHERE Badge_Number = '$Badge_Number' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['Badge_Number'] = $Badge_Number;
        // 重定向到主页或者其他页面
        //header("Location: welcome.php");
        echo "Login successful";
    } else {
        echo "Incorrect Badge Number or password";
    }
    $conn->close();
} else {
    // 如果Badge_Number和password没有在POST中设置，显示错误信息或登录表单
    echo "Please enter Badge Number and password";
}
?>
