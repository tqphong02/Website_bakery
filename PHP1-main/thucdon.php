<?php require('layout/header.php') ?>
<main>
    <div class="container">
        <div id="ant-layout">
        <section class="search-sort">
    <form action="thucdon.php" method="GET" style="display: flex; align-items: center;">
        <label for="search" style="position: relative;">
            <i class="fas fa-search" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"></i>
            <input name="search" id="search" type="text" placeholder="Tìm món hoặc thức ăn" style="width: 700px; padding: 10px 10px 10px 35px; border-radius: 5px; border: 1px solid #ccc;">
        </label>
        <label for="sort" style="margin-left: 20px;">Sắp xếp theo giá:</label>
        <select name="sort" id="sort" onchange="sortProducts(this.value)" style="margin-left: 10px;">
            <option value="asc">Tăng dần</option>
            <option value="desc">Giảm dần</option>
        </select>
        <label for="price-range" style="margin-left: 20px;">Lọc theo giá:</label>
        <select name="price-range" id="price-range" onchange="filterByPrice(this.value)" style="margin-left: 10px;">
    <option value="all">Tất cả</option>
    <option value="0-20">0 - 20.000 VNĐ</option>
    <option value="20-60">20.000 - 60.000 VNĐ</option>
    <option value="60-100">60.000 - 100.000 VNĐ</option>
</select>
    </form>
</section>

<script>
    function filterByPrice(priceRange) {
        var productList = document.querySelectorAll('.product-recently .col');
        productList.forEach(function(item) {
            var priceElement = item.querySelector('.price span');
            if (!priceElement) {
                console.log("Price element not found for:", item);
                return;
            }
            var priceText = priceElement.innerText.replace(' VNĐ', '').replace(',', '');
            var price = parseFloat(priceText);
            if (isNaN(price)) {
                console.log("Price could not be parsed for:", item);
                return;
            }

            var visible = true;

            if (priceRange !== "") {
                switch (priceRange) {
                    case "0-20":
                        visible = (price >= 0 && price <= 20);
                        break;
                    case "20-60":
                        visible = (price > 20 && price <= 60);
                        break;
                    case "60-100":
                        visible = (price > 60 && price <= 100);
                        break;
                    case "all":
                        visible = true;
                        break;
                }
            }

            item.style.display = visible ? "block" : "none";
        });
    }
</script>



    </form>
</section>

        </div>
        <!-- END LAYOUT  -->
        <section class="main">
            <?php
            if (isset($_GET['page'])) {
                $page = trim(strip_tags($_GET['page']));
            } else {
                $page = "";
            }
            switch ($page) {
                case "thucdon":
                    require('menu-con/trasua.php');
                    require('menu-con/caphe.php');
                    require('menu-con/monannhe.php');
                    require('menu-con/banhmi.php');
                    break;
                default:
                    break;
            }
            //switch
            if (isset($_GET['id_category'])) {
                $id_category = trim(strip_tags($_GET['id_category']));
            } else {
                $id_category = 0;
            }
            ?>
            <section class="recently">
                <div class="title">
                    <?php
                    $sql = "select * from category where id=$id_category";
                    $name = executeResult($sql);
                    foreach ($name as $ten) {
                        echo '<h1>' . $ten['name'] . '</h1>';
                    }
                    ?>
                    <?php
// Biến để lưu từ khóa tìm kiếm
$searchKeyword = '';

// Kiểm tra nếu có tham số tìm kiếm được truyền qua URL
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Lưu từ khóa tìm kiếm vào biến $searchKeyword
    $searchKeyword = $search;
    $sql = "SELECT * FROM product WHERE title LIKE '%$search%'";
    $listSearch = executeResult($sql);

    // Kiểm tra xem có sản phẩm tìm kiếm được hay không
    if (count($listSearch) > 0) {
        // Hiển thị thông điệp về sản phẩm vừa tìm kiếm
        echo '<h2>Sản phẩm vừa tìm kiếm: ' . $searchKeyword . '</h2>';
    } else {
        // Nếu không tìm thấy sản phẩm nào, hiển thị thông điệp "Không tìm thấy sản phẩm nào"
        echo '<h2>Không tìm thấy sản phẩm nào.</h2>';
    }
}
?>
                </div>
                <div class="product-recently">
                    <div class="row">
                        <?php
                        $sql = "select * from product where id_category=$id_category";
                        $productList = executeResult($sql);
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
                        <?php
                        if (isset($_GET['search'])) {
                            $search = $_GET['search'];
                            $sql = "SELECT * from product where title like '%$search%'";
                            $listSearch = executeResult($sql);
                            foreach ($listSearch as $item) {
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
                        }
                        ?>
                    </div>
                </div>
            </section>
        </section>
    </div>
    <style>
.search-sort {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-sort form {
            display: flex;
            align-items: center;
            margin-left: auto;
        }

        .search-sort label,
        .search-sort select,
        .search-sort button {
            margin-left: 10px;
        }
    </style>
    <?php require('layout/footer.php') ?>

    <script>
        function sortProducts(order) {
            // Lấy danh sách sản phẩm hiện tại
            var productList = document.querySelectorAll('.product-recently .col');
            // Chuyển NodeList thành mảng để có thể sắp xếp
            var productListArray = Array.from(productList);
            // Sắp xếp mảng sản phẩm dựa vào giá
            productListArray.sort(function(a, b) {
                var priceA = parseFloat(a.querySelector('.price span').innerText.replace(' VNĐ', '').replace(',', ''));
                var priceB = parseFloat(b.querySelector('.price span').innerText.replace(' VNĐ', '').replace(',', ''));
                if (order === 'asc') {
                    return priceA - priceB;
                } else {
                    return priceB - priceA;
                }
            });
            // Xóa các sản phẩm hiện tại
            var productContainer = document.querySelector('.product-recently .row');
            productContainer.innerHTML = '';
            // Thêm lại sản phẩm đã được sắp xếp vào container
            productListArray.forEach(function(item) {
                productContainer.appendChild(item);
            });
        }
    </script>
</main>