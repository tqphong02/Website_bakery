<?php
require_once('../database/dbhelper.php');

$id = $title = $price = $number = $thumbnail = $content = $id_category = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Xử lý dữ liệu form
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price = $_POST['price'];
    $number = $_POST['number'];
    $content = $_POST['content'];
    $id_category = $_POST['id_category'];

    // Xử lý upload hình ảnh thumbnail
    if (isset($_FILES["thumbnail"])) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["thumbnail"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Kiểm tra xem file hình ảnh có hợp lệ không
        $check = getimagesize($_FILES["thumbnail"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File không phải là hình ảnh.";
            $uploadOk = 0;
        }

        // Kiểm tra kích thước file
        if ($_FILES["thumbnail"]["size"] > 500000) {
            echo "File ảnh quá lớn.";
            $uploadOk = 0;
        }

        // Kiểm tra định dạng file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Chỉ chấp nhận file JPG, JPEG, PNG & GIF.";
            $uploadOk = 0;
        }

        // Upload file nếu không có lỗi
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $target_file)) {
                $thumbnail = $target_file;
            } else {
                echo "Có lỗi khi tải lên file.";
            }
        }
    }

    // Lưu thông tin sản phẩm vào cơ sở dữ liệu
    $created_at = $updated_at = date('Y-m-d H:i:s');
    if ($id == '') {
        $sql = "INSERT INTO product (title, price, number, thumbnail, content, id_category, created_at, updated_at) 
                VALUES ('$title', '$price', '$number', '$thumbnail', '$content', '$id_category', '$created_at', '$updated_at')";
    } else {
        $sql = "UPDATE product SET title='$title', price='$price', number='$number', thumbnail='$thumbnail', 
                content='$content', id_category='$id_category', updated_at='$updated_at' WHERE id='$id'";
    }

    execute($sql);

    // Chuyển hướng về trang danh sách sản phẩm sau khi lưu
    header('Location: index.php');
    die();
}

// Lấy thông tin sản phẩm để chỉnh sửa nếu có
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE id='$id'";
    $product = executeSingleResult($sql);
    if ($product != null) {
        $title = $product['title'];
        $price = $product['price'];
        $number = $product['number'];
        $thumbnail = $product['thumbnail'];
        $content = $product['content'];
        $id_category = $product['id_category'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Thêm/Sửa Sản Phẩm</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
</head>
<body>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link" href="../index.php">Thống kê</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php">Quản lý danh mục</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../product/">Quản lý sản phẩm</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Quản lý giỏ hàng</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../login/logout.php">Đăng xuất</a>
        </li>
    </ul>

    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2 class="text-center">Thêm/Sửa Sản Phẩm</h2>
            </div>
            <div class="panel-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="text" name="id" value="<?= $id ?>" hidden>
                    <div class="form-group">
                        <label for="title">Tên Sản Phẩm:</label>
                        <input type="text" class="form-control" id="title" name="title" value="<?= $title ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="id_category">Chọn Danh Mục:</label>
                        <select class="form-control" id="id_category" name="id_category" required>
                            <option value="">Chọn danh mục</option>
                            <?php
                            $sql = 'SELECT * FROM category';
                            $categoryList = executeResult($sql);
                            foreach ($categoryList as $item) {
                                if ($item['id'] == $id_category) {
                                    echo '<option value="' . $item['id'] . '" selected>' . $item['name'] . '</option>';
                                } else {
                                    echo '<option value="' . $item['id'] . '">' . $item['name'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="price">Giá Sản Phẩm:</label>
                        <input type="text" class="form-control" id="price" name="price" value="<?= $price ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="number">Số Lượng Sản Phẩm:</label>
                        <input type="number" class="form-control" id="number" name="number" value="<?= $number ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail:</label>
                        <input type="file" class="form-control-file" id="thumbnail" name="thumbnail" onchange="updateThumbnail()">
                        <img src="<?= $thumbnail ?>" style="max-width: 200px" id="img_thumbnail">
                    </div>
                    <div class="form-group">
                        <label for="content">Nội dung:</label>
                        <textarea class="form-control" id="content" name="content" rows="5" required><?= $content ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Lưu</button>
                    <a href="javascript:history.go(-1)" class="btn btn-warning">Quay lại</a>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function updateThumbnail() {
            var file = $('#thumbnail')[0].files[0];
            var reader = new FileReader();
            reader.onloadend = function() {
                $('#img_thumbnail').attr('src', reader.result);
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
                $('#img_thumbnail').attr('src', '');
            }
        }
        
        $(document).ready(function() {
            $('#content').summernote({
                height: 200
            });
        });
    </script>
</body>
</html>
