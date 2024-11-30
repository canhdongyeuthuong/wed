<?php
include 'db.php';
$sql = "SELECT * FROM flowers";
$result = $conn->query($sql);
$flowers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $flowers[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Danh Sách Hoa</h1>
        <div class="row">
            <?php foreach ($flowers as $flower): ?>
                <div class="col-md-4">
                    <div class="card">
                        <img src="<?php echo $flower['image']; ?>" class="card-img-top" alt="<?php echo $flower['name']; ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $flower['name']; ?></h5>
                            <p class="card-text"><?php echo $flower['description']; ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>