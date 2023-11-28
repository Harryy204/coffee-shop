<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
</head>
<?php
session_start();
if (!$_SESSION['admin']) {
    header("location: login/login.php");
}
?>

<body>
    <!-- header -->
    <nav class="navbar bg-dark">
        <div class="container-fluid text-white">
            <a href="index.php" class="text-decoration-none">
                <h4 class="navbar-brand fw-bold text-white" style="margin: 0;">COFFEE</h4>
            </a>
            <span>
                <i class="fa-solid fa-user-shield"></i>
                Xin chào, <?php echo $_SESSION['admin']; ?>|
                <i class="fas fa-sign-out-alt"></i>
                <a href="../user/login/logout.php" class="text-decoration-none text-white">Đăng xuất</a>|
                <a href="../index.php" class="text-decoration-none text-white">Khách truy cập</a>
            </span>
        </div>
    </nav>
    <button class="bg-success fw-bold"><a href="../index.php" class=" text-decoration-none pe-2 text-white"><i class="fa-sharp fa-solid fa-circle-left" style="margin: 5px;"></i>Trang Quản Lý</a></button>
    <div class="container">
        <div class="row">
            <div class="col-md-5 m-auto border mt-3">
                <!-- Tạo form thêm sản phẩm -->
                <form action="insert.php" method="POST" enctype="multipart/form-data">
                    <p class="text-center fw-bold fs-3 text-success">Chi tiết sản phẩm</p>

                    <div class="mb-3">
                        <label class="form-label">Nhập tên sản phẩm:</label>
                        <input type="text" name="tensp" class="form-control ml-100" placeholder="Nhập tên sản phẩm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nhập giá sản phẩm:</label>
                        <input type="number" name="gia" class="form-control" placeholder="Nhập giá" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thêm ảnh sản phẩm:</label>
                        <input type="file" name="img" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nhập số lượng sản phẩm:</label>
                        <input type="number" name="soluong" class="form-control" placeholder="Nhập số lượng" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nhập mô tả sản phẩm:</label>
                        <input type="text" name="mota" class="form-control" placeholder="Nhập mô tả" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Chọn danh mục:</label>
                        <select class="form-select" name="category_id">
                            <?php
                            include '../../config.php';
                            $categoryQuery = "SELECT * FROM danhmuc";
                            $categoryResult = mysqli_query($con, $categoryQuery);
                            while ($category = mysqli_fetch_array($categoryResult)) {
                                echo '<option value="' . $category['id'] . '">' . $category['tendm'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <button name="submit" class="bg-danger fs-5 fw-bold mb-3 form-control text-white">Thêm sản phẩm</button>
                </form>
            </div>
        </div>

        <!-- hiển thị sản phẩm -->
        <div class="container">
            <div class="row">
                <div class="col-md-12 m-auto">

                    <table class="table border border-dark table-hover border mt-5">

                        <thead class="bg-dark text-white fs-5 font-monnospace text-center">
                            <th>Id</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Ảnh</th>
                            <th>Phân loại</th>
                            <th>Số lượng</th>
                            <th>Mô tả</th>
                            <th>Xóa</th>
                            <th>Cập nhật</th>
                        </thead>

                        <tbody class="text-center">
                            <?php
                            include '../../config.php';
                            $record = mysqli_query($con, "SELECT * FROM `sanpham`");
                            $id_count = 1;
                            while ($row = mysqli_fetch_array($record)) {
                                $description = '<div style="max-width: 200px; word-wrap: break-word; margin:0 auto;">' . $row['mota'] . '</div>';

                                echo "
                                <tr>
                                <td>$id_count</td>
                                <td>$row[tensp]</td>
                                <td>$row[gia]</td>
                                <td><img src= '$row[img]' width='200px' height='150px'></td>
                                <td>$row[iddm]</td>
                                <td>$row[soluong]</td>
                                <td>$description</td>
                                <td><a onclick='return confirm(\"Bạn có chắc muốn xoá ".$row['tensp']." không?\")'
                                href= 'delete.php?id=$row[id]' class='btn btn-outline-danger'>Xóa</a></td>
                                <td><a href='update.php? id= $row[id]' class='btn btn-danger'>Cập nhật</a></td>
                                </tr>
                                ";
                                $id_count++;
                            }

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</body>

</html>