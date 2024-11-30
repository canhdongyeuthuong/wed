<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "quiz";

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Lấy đáp án từ cơ sở dữ liệu
$answers = [];
$sql = "SELECT id, correct_answer FROM questions";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $answers[$row['id']] = $row['correct_answer'];
    }
}

// Tính điểm
$score = 0;
foreach ($_POST as $key => $userAnswer) {
    // Lấy số câu hỏi từ tên input
    $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);

    // So sánh đáp án với câu trả lời
    if (isset($answers[$questionNumber]) && strtoupper($answers[$questionNumber]) === strtoupper($userAnswer)) {
        $score++;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả trắc nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Kết Quả</h2>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Thông tin kết quả</h5>
        </div>
        <div class="card-body">
            <p class="text-center">Bạn đã trả lời đúng <strong><?php echo $score; ?></strong> câu hỏi trong tổng số <strong><?php echo count($answers); ?></strong> câu hỏi.</p>
            <div class="text-center">
                <a href="index.php" class="btn btn-primary">Quay lại</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
$conn->close();
?>