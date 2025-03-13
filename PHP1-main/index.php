<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiệm bánh thơm ngon mời bạn ăn nha</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="your-styles.css">
</head>

<body>
    <?php require "layout/header.php"; ?>
    <?php
    require_once('database/config.php');
    require_once('database/dbhelper.php');
    ?>
    <!-- END HEADER -->

    <main>
        <div class="container">
            <div id="ant-layout">
                <section class="search-quan">
                    <i class="fas fa-search"></i>
                    <form action="thucdon.php" method="GET">
                        <input name="search" type="text" placeholder="Tìm món hoặc thức ăn">
                    </form>
                </section>
                <section class="main-layout">
                    <div class="row">
                        <?php
                        $sql = 'select * from category';
                        $categoryList = executeResult($sql);

                        // Mảng chứa các đường dẫn hình ảnh cố định
                        $imagePaths = array(
                            "images/bg/mochi.jpg",
                            "images/bg/donut.jpg",
                            "images/bg/tiramisu.jpg",
                            "images/bg/crepe.jpg"
                        );

                        foreach ($categoryList as $index => $item) {
                            // Lặp lại từ đầu nếu hết hình ảnh
                            $imageIndex = $index % count($imagePaths);
                            $selectedImagePath = $imagePaths[$imageIndex];

                            // Thiết lập màu nền cho từng loại sản phẩm
                            $bgColor = "";
                            switch ($item['name']) {
                                case 'Mochi':
                                    $bgColor = "#f2f2f2"; // Xám nhạt
                                    break;
                                case 'Donut':
                                    $bgColor = "#e0e0e0"; // Xám đậm ít
                                    break;
                                case 'Tiramisu':
                                    $bgColor = "#dcdcdc"; // Xám đậm
                                    break;
                                case 'Crepe':
                                    $bgColor = "#d3d3d3"; // Xám đậm nhiều
                                    break;
                                default:
                                    $bgColor = "#f2f2f2"; // Mặc định là xám nhạt
                            }

                            echo '
                                <div class="box" style="background-color: ' . $bgColor . ';">
                                    <a href="thucdon.php?id_category=' . $item['id'] . '">
                                        <p>' . $item['name'] . '</p>
                                        <div class="bg"></div>
                                        <img class="thumbnail" src="' . $selectedImagePath . '" alt="">
                                    </a>
                                </div>
                            ';
                        }
                        ?>
                    </div>
                </section>

            </div>
            <div class="bg-grey">

            </div>
            <!-- END LAYOUT  -->
            <section class="main">
                <section class="recently" style="background-color: #f2f2f2;">
                    <div class="title">
                        <h1>Được yêu thích nhất</h1>
                    </div>
                    <div class="product-recently" >
                        <div class="row" >
                            <?php
                            // Truy vấn để lấy 4 sản phẩm được yêu thích nhất
                            $sql = 'SELECT product.*, SUM(order_details.quantity) AS total_quantity
                            FROM product
                            JOIN order_details ON order_details.product_id = product.id
                            GROUP BY product.id
                            ORDER BY total_quantity DESC
                            LIMIT 4';

                            // Thực thi truy vấn và lấy kết quả
                            $productList = executeResult($sql);

                            // Kiểm tra nếu có sản phẩm
                            if ($productList) {
                                // Lấy 4 sản phẩm ngẫu nhiên từ $productList
                                $randomProducts = array_rand($productList, 4);

                                // Hiển thị danh sách sản phẩm

                                foreach ($randomProducts as $index) {
                                    $item = $productList[$index];
                                    echo '
                                        <div class="col">
                                            <a href="details.php?id=' . $item['id'] . '">
                                                <img class="thumbnail" src="admin/product/' . $item['thumbnail'] . '" alt="">
                                                <div class="title">
                                                    <p>' . $item['title'] . '</p>
                                                </div>
                                                <div class="price">
                                                    <span>' . number_format($item['price'], 0, ',', '.') . ' VNĐ</span>
                                                </div>
                                                <div class="more">
                                                    <div class="star">
                                                        <img src="images/icon/icon-star.svg" alt="">
                                                        <span>4.6</span>
                                                    </div>
                                                    <div class="time">
                                                        <img src="images/icon/icon-clock.svg" alt="">
                                                        <span>15 comment</span>
                                                    </div>
                                                </div>
                                                <button class="add-cart" onclick="addToCart(' . $item['id'] . ')">Thêm vào giỏ hàng</button>
                                                <button class="buy-now" onclick="buyNow(' . $item['id'] . ')">Mua ngay</button>
                                            </a>
                                        </div>';
                                }
                            } else {
                                // Xử lý khi không có sản phẩm nào được tìm thấy
                                echo "Không có sản phẩm nào được tìm thấy.";
                            }
                            ?>

                        </div>
                    </div>
                </section>
                <!-- end Món ngon gần bạn -->

                <section class="restaurants" style="background-color: #f2f2f2;">
                    <div class="title">
                        <h1>Thực đơn tại <span class="green">Tiệm bánh</span></h1>
                    </div>
                    <div class="product-restaurants">
                        <div class="row">
                            <?php
                            try {
                                if (isset($_GET['page'])) {
                                    $page = $_GET['page'];
                                } else {
                                    $page = 1;
                                }
                                $limit = 12;
                                $start = ($page - 1) * $limit;
                                $sql = "SELECT * FROM product limit $start,$limit";
                                executeResult($sql);
                                // $sql = 'select * from product limit $star,$limit';
                                $productList = executeResult($sql);

                                $index = 1;
                                foreach ($productList as $item) {
                                    echo '
                                        <div class="col">
                                            <a href="details.php?id=' . $item['id'] . '">
                                                <img class="thumbnail" src="admin/product/' . $item['thumbnail'] . '" alt="">
                                                <div class="title">
                                                    <p>' . $item['title'] . '</p>
                                                </div>
                                                <div class="price">
                                                    <span>' . number_format($item['price'], 0, ',', '.') . ' VNĐ</span>
                                                </div>
                                                <div class="more">
                                                    <div class="star">
                                                        <img src="images/icon/icon-star.svg" alt="">
                                                        <span>4.6</span>
                                                    </div>
                                                    <div class="time">
                                                        <img src="images/icon/icon-clock.svg" alt="">
                                                        <span>15 comment</span>
                                                    </div>
                                                </div>
                                                <button class="add-cart" onclick="addToCart(' . $item['id'] . ')">Thêm vào giỏ hàng</button>
                                                <button class="buy-now" onclick="buyNow(' . $item['id'] . ')">Mua ngay</button>
                                            </a>
                                        </div>
                                        ';
                                }
                            } catch (Exception $e) {
                                die("Lỗi thực thi sql: " . $e->getMessage());
                            }
                            ?>
                        </div>
                        <div class="pagination">
                            <ul>
                                <?php
                               try {
                                $conn = new PDO("mysql:host=". HOST . ";dbname=". DATABASE, USERNAME, PASSWORD);
                                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            } catch(PDOException $e) {
                                echo "Connection failed: ". $e->getMessage();
                            }
                            
                            // Query để đếm số lượng sản phẩm
                            $countSql = "SELECT COUNT(*) as total FROM `product`";
                            $countStmt = $conn->prepare($countSql);
                            $countStmt->execute();
                            $totalProducts = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
                            
                            // Số sản phẩm hiển thị trên mỗi trang
                            $perPage = 12;
                            // Tính số trang
                            $totalPages = ceil($totalProducts / $perPage);
                            
                            // Hiển thị phân trang
                            for ($i = 1; $i <= $totalPages; $i++) {
                                if ($i == $currentPage) {
                                    echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
                                } else {
                                    echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
                                }
                            }
                            ?>
                            </ul>
                        </div>
                    </div>
                </section>
            </section>
        </div>
    </main>
    <?php require_once('layout/footer.php'); ?>

    <!-- Đoạn mã JavaScript -->
    <script type="text/javascript">
        // Hàm thêm sản phẩm vào giỏ hàng
        function addToCart(id) {
            // Sử dụng AJAX để gửi yêu cầu POST đến một API hoặc tệp xử lý dữ liệu
            // Trong trường hợp này, tôi giả định rằng bạn có một API hoặc tệp cookie.php xử lý yêu cầu này
            // và trả về kết quả thông báo cho người dùng
            $.post('api/cookie.php', {
                'action': 'add', // Thực hiện hành động thêm vào giỏ hàng
                'id': id,        // ID của sản phẩm
                'num': 1         // Số lượng mặc định là 1
            }, function(data) {
                alert('Đã thêm vào giỏ hàng');
            });
        }

        // Hàm mua sản phẩm ngay lập tức
        function buyNow(id) {
            // Sử dụng AJAX để gửi yêu cầu POST đến một API hoặc tệp xử lý dữ liệu
            // Trong trường hợp này, tôi giả định rằng bạn có một API hoặc tệp cookie.php xử lý yêu cầu này
            // và sau đó chuyển hướng người dùng đến trang thanh toán (checkout.php)
            $.post('api/cookie.php', {
                'action': 'add', // Thực hiện hành động thêm vào giỏ hàng
                'id': id,        // ID của sản phẩm
                'num': 1         // Số lượng mặc định là 1
            }, function(data) {
                location.assign("checkout.php"); // Chuyển hướng người dùng đến trang thanh toán
            });
        }
    </script>
    <style>
        /* CSS cho nút "Thêm vào giỏ hàng" và "Mua ngay" */
        .add-cart {
            display: inline-block;
            background-color: #ff6600; /* Màu cam */
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 10px;
            cursor: pointer; /* Đổi con trỏ thành kiểu chỉ vào */
            transition: background-color 0.3s; /* Hiệu ứng chuyển đổi màu nền */
        }

        .add-cart:hover {
            background-color: #cc5500; /* Màu cam nhạt khi rê chuột vào */
        }

        .buy-now {
            display: inline-block;
            background-color: #ff0000; /* Màu đỏ */
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 10px;
            cursor: pointer; /* Đổi con trỏ thành kiểu chỉ vào */
            transition: background-color 0.3s; /* Hiệu ứng chuyển đổi màu nền */
        }

        .buy-now:hover {
            background-color: #cc0000; /* Màu đỏ nhạt khi rê chuột vào */
        }
    </style>
</body>
</html>
