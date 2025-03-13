<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiệm bánh thơm ngon mời bạn ăn nha</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="your-styles.css">
    <style>
        /* CSS cho phần sản phẩm */
        .title {
            margin-bottom: 20px;
        }

        .main-order {
            display: flex;
            flex-direction: column; /* Sắp xếp theo cột */
            align-items: center; /* Căn giữa theo chiều ngang */
            text-align: center; /* Căn giữa nội dung */
        }

        .main-order h1 {
            font-size: 24px;
            margin-bottom: 10px; /* Khoảng cách giữa tiêu đề và hình ảnh */
        }

        .main-order img {
            width: 200px; /* Điều chỉnh kích thước ảnh */
            margin-bottom: 20px; /* Khoảng cách giữa hình ảnh và nội dung bên dưới */
        }

        .box {
            display: flex;
            align-items: center;
        }

        .box img {
            width: 100px; /* Điều chỉnh kích thước ảnh */
            margin-right: 20px; /* Khoảng cách giữa hình ảnh và nội dung */
        }

        .about {
            flex: 1; /* Sử dụng phần còn lại của không gian */
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            text-align: left; /* Căn trái nội dung */
        }

        .size,
        .number {
            margin-bottom: 10px;
        }

        .size p {
            font-weight: bold;
        }

        .size ul {
            list-style-type: none;
        }

        .size ul li {
            display: inline-block;
            margin-right: 10px;
        }

        .size ul li a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .number input {
            width: 50px;
            padding: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .price {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .price span {
            color: #ff6600;
        }

        .buy-now {
            display: inline-block;
            background-color: #4882c6;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .buy-now:hover {
            background-color: #336699;
        }

        .title .main-order {
            background-color: #e0e0e0; /* Màu nền tối hơn */
            padding: 60px; /* Tăng khoảng cách từ nội dung ra viền của background */
            border-radius: 50px; /* Làm mềm các góc một chút nhiều hơn */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15); /* Tạo bóng đổ đậm hơn */
            margin: 30px 0; /* Tăng khoảng cách trên và dưới để phân tách rõ ràng hơn với các phần khác */
        }
        /* CSS cho phần gợi ý sản phẩm */
/* CSS cho phần gợi ý sản phẩm */
.suggested-products {
    background-color: #f9f9f9; /* Màu nền cho phần gợi ý sản phẩm */
    padding: 20px;
    border-radius: 10px;
    margin-top: 20px;
}

.suggested-products h1 {
    font-size: 20px;
    margin-bottom: 10px;
}

.suggested-products .row {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.suggested-products .col {
    flex: 0 0 calc(33.33% - 20px);
    margin-bottom: 20px;
}

.suggested-products .col a {
    display: block;
    text-decoration: none;
    color: #333;
}

.suggested-products .col img {
    width: 100%;
    border-radius: 5px;
}

.suggested-products .col .about {
    padding: 10px;
    background-color: #fff;
    border-radius: 5px;
    margin-top: 10px;
}

.suggested-products .col .about .title {
    font-weight: bold;
    margin-bottom: 5px;
}

.suggested-products .col .about .title p {
    font-size: 16px;
}

.suggested-products .col .about .title span {
    color: #ff6600;
}

    </style>
</head>
<body>
<?php require "layout/header.php"; ?>
<?php
require_once('database/config.php');
require_once('database/dbhelper.php');
require_once('utils/utility.php');
// Lấy id từ trang index.php truyền sang rồi hiển thị nó
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = 'select * from product where id=' . $id;
    $product = executeSingleResult($sql);
    // Kiểm tra nếu ko có id sp đó thì trả về index.php
    if ($product == null) {
        header('Location: index.php');
        die();
    }
}
?>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=264339598396676&autoLogAppEvents=1" nonce="8sTfFiF4"></script>
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
        </div>
        <section class="main">
            <section class="oder-product">
                <div class="title">
                    <section class="main-order">
                        <h1><?= $product['title'] ?></h1>
                        <div class="box">
                            <img src="<?='admin/product/'.$product['thumbnail'] ?>" alt="">
                            <div class="about">
                                <p><?= $product['content'] ?></p>
                                <div class="size">
                                    <p>Size:</p>
                                    <ul>
                                        <li><a href="">S</a></li>
                                        <li><a href="">M</a></li>
                                        <li><a href="">L</a></li>
                                    </ul>
                                </div>
                                <div class="number">
                                    <span class="number-buy">Số lượng</span>
                                    <input id="num" type="number" value="1" min="1" onchange="updatePrice()">
                                </div>
                                <p class="price">Giá: <span id="price"><?= number_format($product['price'], 0, ',', '.') ?></span><span> VNĐ</span><span class="gia none"><?= $product['price'] ?></span></p>
                                <button class="add-cart" onclick="addToCart(<?= $id ?>)"><i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng</button>
                                <button class="buy-now" onclick="buyNow(<?= $id ?>)">Mua ngay</button>
                                <script>
                                    function updatePrice() {
                                        var price = document.getElementById('price').innerText; // giá tiền
                                        var num = document.querySelector('#num').value; // số lượng
                                        var gia1 = document.querySelector('.gia').innerText;
                                        var gia = price.match(/\d/g);
                                        gia = gia.join("");
                                        var tong = gia1 * num;
                                        document.getElementById('price').innerHTML = tong.toLocaleString();
                                    }
                                </script>
                            </div>
                        </div>
                        <div class="fb-comments" data-href="http://localhost/PROJECT/details.php" data-width="750" data-numposts="5"></div>
                    </section>
                </div>
                <aside class="suggested-products">
    <h1>Gợi ý cho bạn</h1>
    <div class="row">
        <?php
        $sql = "SELECT * FROM product WHERE id <> $id ORDER BY RAND() LIMIT 3";
        $suggestedProducts = executeResult($sql);
        foreach ($suggestedProducts as $item) {
            echo '
                <div class="col">
                    <a href="details.php?id=' . $item['id'] . '">
                        <img src="admin/product/'.$item['thumbnail'] . '" alt="">
                        <div class="about">
                            <div class="title">
                                <p>' . $item['title'] . '</p>
                                <span>Giá: ' . number_format($item['price'], 0, ',', '.') . ' VNĐ' . '</span>
                            </div>
                        </div>
                    </a>
                </div>
            ';
        }
        ?>
    </div>
</aside>


            </section>
            <section class="restaurants">
                <div class="title">
                    <h1>Thực đơn tại <span class="green">Tiệm bánh</span></h1>
                </div>
                <div class="product-restaurants">
                    <div class="row">
                        <?php
                        $sql = 'select * from product limit 8';
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
                                    </a>
                                </div>
                                ';
                        }
                        ?>
                    </div>
                </div>
            </section>
        </section>
    </div>
</main>
<?php require_once('layout/footer.php'); ?>
<script type="text/javascript">
    function addToCart(id) {
        var num = document.querySelector('#num').value; // số lượng
        $.post('api/cookie.php', {
            'action': 'add',
            'id': id,
            'num': num
        }, function(data) {
            location.reload()
        })
    }

    function buyNow(id) {
        $.post('api/cookie.php', {
            'action': 'add',
            'id': id,
            'num': 1
        }, function(data) {
            location.assign("checkout.php");
        })
    }
</script>
</body>
</html>
