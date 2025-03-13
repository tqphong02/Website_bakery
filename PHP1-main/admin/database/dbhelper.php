<?php
require_once('config.php');
try {
    $conn = new PDO("mysql:host=".HOST.";dbname=".DATABASE, USERNAME, PASSWORD);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: ". $e->getMessage();
}

function execute($sql)
{
    global $conn;
    try {
        // Thực thi truy vấn
        return $conn->exec($sql);
    } catch(PDOException $e) {
        echo "Execute failed: " . $e->getMessage();
        return false;
    }
}
function executeResult($sql) {
    global $conn;
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            return $result;
        } else {
            return [];
        }
    } catch(PDOException $e) {
        echo "Execute result failed: " . $e->getMessage();
        return [];
    }
}
function executeSingleResult($sql)
{
    global $conn;
    try {
        // Thực thi truy vấn
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Execute single result failed: " . $e->getMessage();
        return null;
    }
}
function getConnection() {
    global $conn;
    return $conn;
}
?>