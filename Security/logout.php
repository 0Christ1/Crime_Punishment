<?php
session_start(); 
session_unset();
session_destroy();
echo '<script language="javascript">alert("Logout Successfully"); location.href="../Login/index.php";</script>';
exit;
?>
