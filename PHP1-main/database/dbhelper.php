<?php
try {
    $conn = new PDO("mysql:host=". 'db'. ";dbname=". 'asm_php1', 'root', 'test');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
}
require_once('config.php');
function execute($sql)
{
    // Sử dụng hằng số từ file config.php
    $conn = new PDO("mysql:host=". 'db'. ";dbname=". 'asm_php1', 'root', 'test');

    // Thực thi truy vấn
    $conn->exec($sql);

    // Đóng kết nối
    $conn = null;
}

function executeResult($sql)
{
    // Sử dụng hằng số từ file config.php
   $conn = new PDO("mysql:host=". 'db'. ";dbname=". 'asm_php1', 'root', 'test'); 
    // Thực thi truy vấn
    $result = $conn->query($sql);

    // Lấy dữ liệu từ kết quả
    $data = [];
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    // Đóng kết nối
    $conn = null;

    return $data;
}

function executeSingleResult($sql)
{
    // Sử dụng hằng số từ file config.php
    $conn = new PDO("mysql:host=". 'db'. ";dbname=". 'asm_php1', 'root', 'test');

    // Thực thi truy vấn
    $result = $conn->query($sql);

    // Lấy một hàng kết quả
    $row = $result->fetch(PDO::FETCH_ASSOC);

    // Đóng kết nối
    $conn = null;

    return $row;
}

?>
