<?php
include 'db.php';


$sql = "CREATE DATABASE IF NOT EXISTS flower_db";
if ($conn->query($sql) === TRUE) {
    echo "Tạo thành công.<br>";
} else {
    echo "Lỗi: " . $conn->error . "<br>";
}

$conn->select_db('flower_db');

$sql = "CREATE TABLE IF NOT EXISTS flowers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    image VARCHAR(255)
)";
if ($conn->query($sql) === TRUE) {
    echo "Tạo thành công bảng 'flowers'.<br>";
} else {
    echo "Lỗi: " . $conn->error . "<br>";
}

$flowers = [
    ['name' => 'Đỗ Quyên', 'description' => 'Loài hoa màu sắc tươi sáng, nở vào mùa xuân.', 'image' => 'images/doquyen.jpg'],
    ['name' => 'Hải Đường', 'description' => 'Loài hoa có màu đỏ nổi bật, thích hợp trồng trong mùa xuân.', 'image' => 'images/haiduong.jpg'],
    ['name' => 'Mai', 'description' => 'Loài hoa biểu tượng của mùa Tết, có màu vàng tươi.', 'image' => 'images/mai.jpg'],
    ['name' => 'Tường Vy', 'description' => 'Loài hoa nhỏ xinh, thường thấy ở những khu vườn cổ kính.', 'image' => 'images/tuongvy.jpg']
];


foreach ($flowers as $flower) {
    $sql = "INSERT INTO flowers (name, description, image) VALUES ('" . $conn->real_escape_string($flower['name']) . "', '" . $conn->real_escape_string($flower['description']) . "', '" . $conn->real_escape_string($flower['image']) . "')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Đã thêm hoa " . $flower['name'] . " vào cơ sở dữ liệu.<br>";
    } else {
        echo "Lỗi thêm hoa: " . $conn->error . "<br>";
    }
}

$conn->close();
?>