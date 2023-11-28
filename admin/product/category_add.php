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
            <a href="../index.php" class="text-decoration-none">
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
        <p class="text-center fw-bold fs-3 text-success">Thêm Danh Mục Sản Phẩm</p>
        <form action="category_insert.php" method="POST" class="mb-3">
            <div class="input-group">
                <input type="text" id="category_name" name="category_name" class="form-control" placeholder="Tên danh mục" required>
                <button type="submit" name="submit_category" class="btn btn-primary">Thêm danh mục</button>
            </div>
        </form>
    </div>

    <div class="container col-md-6 mt-5">
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th>STT</th>
                    <th>Tên danh mục</th>
                    <th>Xoá</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../../config.php';
                $id_count = 1;
                $categoryQuery = "SELECT * FROM danhmuc ORDER BY id";
                $result = mysqli_query($con, $categoryQuery);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td class='text-center'>" . $row['id'] . "</td>";
                    echo "<td>" . $row['tendm'] . "</td>";
                    echo "<td class='text-center'><a onclick='return confirm(\"Bạn có chắc muốn xoá " . $row['tendm'] . " không?\")'
                    href='category_delete.php?id=" . $row['id'] . "' class='btn btn-danger'>Xoá</a></td>";
                    echo "</tr>";
                }
                $id_count++;
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>