<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách điểm danh</title>
    <!-- Thêm liên kết đến Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Danh sách điểm danh</h2>
        <?php
        // Bước 1: Thiết lập thông tin kết nối đến cơ sở dữ liệu
        $servername = "localhost";
        $username = "root"; // Tên người dùng mặc định của XAMPP
        $password = ""; // Mật khẩu mặc định của XAMPP (thường là rỗng)
        $dbname = "students"; // Tên cơ sở dữ liệu của bạn

        // Bước 2: Tạo kết nối đến cơ sở dữ liệu
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Bước 3: Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Bước 4: Truy vấn dữ liệu từ bảng
        $sql = "SELECT * FROM ktpm3_danh_sach_diem_danh";
        $result = $conn->query($sql);

        // Bước 5: Hiển thị dữ liệu
        if ($result->num_rows > 0) {
            // Tạo bảng với Bootstrap
            echo "<table class='table table-striped table-bordered'>
                    <thead class='thead-dark'>
                        <tr>
                            <th>COL 1</th>
                            <th>COL 2</th>
                            <th>COL 3</th>
                            <th>COL 4</th>
                            <th>COL 5</th>
                            <th>COL 6</th>
                            <th>COL 7</th>
                        </tr>
                    </thead>
                    <tbody>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["COL 1"] . "</td>
                        <td>" . $row["COL 2"] . "</td>
                        <td>" . $row["COL 3"] . "</td>
                        <td>" . $row["COL 4"] . "</td>
                        <td>" . $row["COL 5"] . "</td>
                        <td>" . $row["COL 6"] . "</td>
                        <td>" . $row["COL 7"] . "</td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-warning' role='alert'>0 kết quả</div>";
        }

        // Bước 6: Đóng kết nối
        $conn->close();
        ?>
    </div>

    <!-- Thêm liên kết đến Bootstrap JS và jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>