<?php
require_once('database/dbhelper.php');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Check if status is set in POST data
    if (isset($_POST['status'])) {
        $status = $_POST['status'];
        // Get the order_id from POST data
        $order_id = $_POST['order_id'];
        // Update order_details table with new status
        $sql = "UPDATE `order_details` SET `status` = '$status' WHERE `order_id` = $order_id";
        execute($sql);
        // Redirect to dashboard.php after updating
        header("Location: dashboard.php");
        exit();
    }
}

$order_id = ''; // Initialize $order_id variable
?>

<!DOCTYPE html>
<html>

<head>
    <title>Quản lý giỏ hàng</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="category/index.php">Thống kê</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="category/index.php">Quản lý danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="product/">Quản lý sản phẩm</a>
        </li>
        <li class="nav-item ">
            <a class="nav-link active" href="dashboard.php">Quản lý giỏ hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../login/logout.php">Đăng xuất</a>
        </li>
    </ul>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Edit</h2>
            </div>
            <div class="panel-body">
                <form action="" method="POST">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr style="font-weight: 500;text-align: center;">
                                <td width="50px">STT</td>
                                <td width="200px">Tên User</td>
                                <td>Tên Sản Phẩm/<br>Số lượng</td>
                                <td>Tổng tiền</td>
                                <td width="250px">Địa chỉ</td>
                                <td>Số điện thoại</td>
                                <td>Trạng thái</td>
                                <!-- <td width="50px">Lưu</td> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                if (isset($_GET['order_id'])) {
                                    $order_id = $_GET['order_id'];
                                }
                                $count = 0;
                                $sql = "SELECT * from orders, order_details, product
                                where order_details.order_id=orders.id and product.id=order_details.product_id and order_id=$order_id";
                                $order_details_List = executeResult($sql);
                                foreach ($order_details_List as $item) {
                                    echo '
                                        <tr style="text-align: center;">
                                            <td width="50px">' . (++$count) . '</td>
                                            <td style="text-align:center">' . $item['fullname'] . '</td>
                                            <td>' . $item['title'] . '<br>(<strong>' . $item['num'] . '</strong>)</td>
                                            <td class="b-500 red">' . number_format($item['price'], 0, ',', '.') . '<span> VNĐ</span></td>
                                            <td width="100px">' . $item['address'] . '</td>
                                            <td width="100px">' . $item['phone_number'] . '</td>
                                            <td>
                                                <select name="status" id="status" onchange="this.form.submit()">
                                                    <option value="Đang chuẩn bị" ' . ($item['status'] == 'Đang chuẩn bị' ? 'selected' : '') . '>Đang chuẩn bị</option>
                                                    <option value="Đang giao" ' . ($item['status'] == 'Đang giao' ? 'selected' : '') . '>Đang giao</option>
                                                    <option value="Đã nhận hàng" ' . ($item['status'] == 'Đã nhận hàng' ? 'selected' : '') . '>Đã nhận hàng</option>
                                                    <option value="Đã hủy" ' . ($item['status'] == 'Đã hủy' ? 'selected' : '') . '>Đã hủy</option>
                                                </select>
                                                <input type="hidden" name="order_id" value="' . $item['order_id'] . '">
                                            </td>
                                        </tr>
                                    ';
                                    $order_id = $item['order_id']; // Move this line inside the loop
                                }
                            } catch (Exception $e) {
                                die("Lỗi thực thi sql: " . $e->getMessage());
                            }
                            ?>
                        </tbody>
                    </table>
                    <a href="dashboard.php" class="btn btn-warning">Back</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
