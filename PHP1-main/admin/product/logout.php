<?php
session_start();

// Xóa session và cookie
unset($_SESSION['username']);
setcookie("username", "", time() - 3600, "/");
setcookie("password", "", time() - 3600, "/");

// Chuyển hướng đến trang index của người dùng
header('Location: ../../index.php');
exit();
?>
