<?php
include 'db.php';
$editFlower = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "INSERT INTO flowers (name, description, image) VALUES ('$name', '$description', '$image')";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

if (isset($_POST['delete'])) {
    $indexToDelete = $_POST['index'];
    $sql = "DELETE FROM flowers WHERE id = $indexToDelete";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

if (isset($_GET['edit'])) {
    $indexToEdit = $_GET['edit'];
    $sql = "SELECT * FROM flowers WHERE id = $indexToEdit";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $editFlower = $result->fetch_assoc();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
    $indexToEdit = $_POST['index'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "UPDATE flowers SET name = '$name', description = '$description', image = '$image' WHERE id = $indexToEdit";
    if ($conn->query($sql) === TRUE) {
        header("Location: admin.php");
        exit;
    } else {
        echo "Lỗi: " . $conn->error;
    }
}

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
    <title>Quản Lý Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container py-5">
        <h1 class="text-center mb-4">Quản Lý Hoa</h1>
        <h3><?php echo $editFlower ? "Sửa Hoa" : "Thêm Hoa"; ?></h3>
        <form method="POST">
            <input type="hidden" name="index" value="<?php echo $editFlower ? $editFlower['id'] : ''; ?>">

            <div class="mb-3">
                <input type="text" class="form-control" name="name" placeholder="Tên Hoa" value="<?php echo $editFlower ? $editFlower['name'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="description" placeholder="Mô Tả" value="<?php echo $editFlower ? $editFlower['description'] : ''; ?>" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" name="image" placeholder="Đường Dẫn Ảnh" value="<?php echo $editFlower ? $editFlower['image'] : ''; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary" name="<?php echo $editFlower ? 'edit' : 'add'; ?>">
                <?php echo $editFlower ? "Cập Nhật Hoa" : "Thêm Hoa"; ?>
            </button>
        </form>

        <h2 class="mt-5">Danh Sách Hoa</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Tên Hoa</th>
                    <th>Mô Tả</th>
                    <th>Ảnh</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flowers as $flower): ?>
                    <tr>
                        <td><?php echo $flower['name']; ?></td>
                        <td><?php echo $flower['description']; ?></td>
                        <td><img src="<?php echo $flower['image']; ?>" width="100" height="100"></td>
                        <td>
                            <a href="admin.php?edit=<?php echo $flower['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <form method="POST" class="d-inline">
                                <input type="hidden" name="index" value="<?php echo $flower['id']; ?>">
                                <button type="submit" class="btn btn-danger btn-sm" name="delete">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>