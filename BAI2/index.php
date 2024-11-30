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

// Lấy câu hỏi từ cơ sở dữ liệu
$sql = "SELECT id, question, correct_answer FROM questions"; // Sửa tên cột ở đây
$result = $conn->query($sql);

$all_questions = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $all_questions[] = $row;
    }
} else {
    echo "Không có câu hỏi nào.";
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trắc Nghiệm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Bài Trắc Nghiệm</h2>
    <form method="POST" action="result.php">
        <?php foreach ($all_questions as $question): ?>
            <div class='card mb-4'>
                <div class='card-header'><strong><?php echo $question['question']; ?></strong></div>
                <div class='card-body'>
                    <?php foreach (['A', 'B', 'C', 'D'] as $option): ?>
                        <div class='form-check'>
                            <input class='form-check-input' type='radio' name='question<?php echo $question['id']; ?>' value='<?php echo $option; ?>' id='question<?php echo $question['id'] . $option; ?>'>
                            <label class='form-check-label' for='question<?php echo $question['id'] . $option; ?>'><?php echo $option; ?>. Đáp án cho câu <?php echo $question['id']; ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">Nộp bài</button>
    </form>
</div>
</body>
</html>

<?php
$conn->close();
?>