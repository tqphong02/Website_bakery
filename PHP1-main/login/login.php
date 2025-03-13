<?php

require_once('../database/config.php');
require_once('../database/dbhelper.php');

// Xử lý đăng nhập
if (isset($_POST["submit"]) && $_POST["username"] != '' && $_POST["password"] != '') {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Truy vấn dữ liệu từ cơ sở dữ liệu để kiểm tra tài khoản và mật khẩu
    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$password' ";
    $user = executeSingleResult($sql);

    if ($user) {
        // Đăng nhập thành công, thiết lập cookie cho tên người dùng
        setcookie("username", $username, time() + 30 * 24 * 60 * 60, '/');
        
        // Kiểm tra nếu là người dùng thông thường và không phải là admin
        if ($username != 'admin') {
            // Chuyển hướng đến trang index của người dùng
            echo '<script language="javascript">
                alert("Đăng nhập thành công!"); 
                window.location = "../index.php";
            </script>';
            exit(); // Dừng việc thực thi mã PHP sau khi chuyển hướng
        } else {
            // Nếu là admin, chuyển hướng đến trang quản trị
            echo '<script language="javascript">
                alert("Đăng nhập Admin thành công!"); 
                window.location = "../admin/index.php";
            </script>';
            exit(); // Dừng việc thực thi mã PHP sau khi chuyển hướng
        }
    } else {
        // Đăng nhập thất bại, hiển thị thông báo và giữ người dùng lại trên trang đăng nhập
        echo '<script language="javascript">
            alert("Tài khoản và mật khẩu không chính xác !");
            window.location = "login.php";
        </script>';
        exit(); // Dừng việc thực thi mã PHP sau khi chuyển hướng
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="plugin/fontawesome/css/all.css">
    <link rel="stylesheet" href="header.css">
    <title>Đăng nhập</title>
</head>

<body>
    <div id="wrapper" style="padding-bottom: 4rem;">
        <header>
            <div class="container">
                <section class="logo">
                    <a href="../index.php"><img src="../images/OIP1.jpg" alt=""></a>
                </section>
                <nav>
                    <ul>
                        <li><a href="../index.php">Trang chủ</a></li>
                        <li class="nav-cha">
                            <a href="../thucdon.php?page=thucdon">Thực đơn</a>
                            <ul class="nav-con">
                                <?php
                                // Lấy danh sách danh mục từ cơ sở dữ liệu
                                $sql = "SELECT * FROM category";
                                $result = executeResult($sql);
                                foreach ($result as $item) {
                                    echo '<li><a href="../thucdon.php?id_category=' . $item['id'] . '">' . $item['name'] . '</a></li>';
                                }
                                ?>
                            </ul>
                        </li>
                        <li><a href="../about.php">Về chúng tôi</a></li>
                        <li><a href="../sendMail.php">Liên hệ</a></li>
                    </ul>
                </nav>
                <section class="menu-right">
                    <div class="cart">
                        <a href="../cart.php"><img src="../images/icon/cart.svg" alt=""></a>
                        <?php
                        // Hiển thị số lượng sản phẩm trong giỏ hàng
                        $cart = [];
                        if (isset($_COOKIE['cart'])) {
                            $json = $_COOKIE['cart'];
                            $cart = json_decode($json, true);
                        }
                        $count = 0;
                        foreach ($cart as $item) {
                            $count += $item['num']; // đếm tổng số item
                        }
                        ?>
                    </div>
                    <div class="login">
                        <?php
                        // Hiển thị tùy chọn đăng nhập hoặc tên người dùng đã đăng nhập
                        if (isset($_COOKIE['username'])) {
                            echo '<a style="color:black;" href="">' . $_COOKIE['username'] . '</a>
                            <div class="logout">
                                <a href="changePass.php"><i class="fas fa-exchange-alt"></i>Đổi mật khẩu</a> <br>
                                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Đăng xuất</a>
                            </div>
                            ';
                        } else {
                            echo '<a href="login.php"">Đăng nhập</a>';
                        }
                        ?>
                    </div>
                </section>
            </div>
        </header>
        <div class="container">
            <form action="login.php" method="POST">
                <h1 style="text-align: center;">Đăng nhập hệ thống</h1>
                <div class="form-group">
                    <label for="">Tài khoản:</label>
                    <input type="text" name="username" class="form-control" placeholder="Tài khoản">
                </div>
                <div class="form-group">
                    <label for="">Mật khẩu:</label>
                    <input type="password" name="password" class="form-control" placeholder="Mật khẩu">
                </div>
                <a href="forget.php">Quên mật khẩu</a>
                <div style="padding-top: 5px;" class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Đăng nhập">
                    <p style="padding-top: 1rem;">Bạn chưa có tài khoản? <a href="reg.php">Đăng ký</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
