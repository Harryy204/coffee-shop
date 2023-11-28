<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Admin</title>

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <style>
        p,
        .card-text {
            padding: 5px;
            background-color: #f5f5f5;
            border-radius: 10px;
            font-size: 20px;
            border: #000;
            margin: 10px 0;
            color: #999;
        }
    </style>
</head>

<?php
session_start();
if (!$_SESSION['admin']) {
    header("location: login/login.php");
}
include '../config.php';
?>

<body>
    <!-- header -->
    <nav class="navbar bg-dark">
        <div class="container-fluid text-white">
            <a href="#" class="text-decoration-none">
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

    <section class="dashboard">
        <div class="container">
            <h2 class="display-4 text-center text-danger text">Quản Lý</h2>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Xin chào!</h3>
                            <p class="card-text"><?php echo $_SESSION['admin']; ?></p>
                            <a href="../user/login/edit_pro.php" class="btn btn-primary">Cập nhật tài khoản</a>
                        </div>
                    </div>
                </div>
                <!-- quán lý hoá đơn -->
                <div class="col-md-4">
                    <div class="card">
                        <?php
                        $select_order = $con->prepare("SELECT * FROM `hoadon`");
                        $select_order->execute();
                        $total_order = $select_order->get_result()->num_rows;
                        ?>
                        <div class="card-body">
                            <h3 class="card-title">Hoá đơn</h3>
                            <h3 class="card-text">Số lượng: <?php echo $total_order ?></h3>
                            <a href="orders.php" class="btn btn-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <!-- quản lý danh mục -->
                <div class="col-md-4">
                    <div class="card">
                        <?php
                        $select_category = $con->prepare("SELECT * FROM `danhmuc`");
                        $select_category->execute();
                        $total_category = $select_category->get_result()->num_rows;
                        ?>
                        <div class="card-body">
                            <h3 class="card-title">Danh mục sản phẩm</h3>
                            <h3 class="card-text">Số lượng: <?php echo $total_category; ?></h3>
                            <a href="./product/category_add.php" class="btn btn-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- quản lý sản phẩm -->
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="card">
                        <?php
                        $select_products = $con->prepare("SELECT * FROM `sanpham`");
                        $select_products->execute();
                        $total_products = $select_products->get_result()->num_rows;
                        ?>
                        <div class="card-body">
                            <h3 class="card-title">Sản phẩm đã thêm</h3>
                            <h3 class="card-text">Số lượng: <?php echo $total_products; ?></h3>
                            <a href="./product/index.php" class="btn btn-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <!-- quản lý người dùng -->
                <div class="col-md-4">
                    <div class="card">
                        <?php
                        $select_users = $con->prepare("SELECT * FROM `nguoidung`");
                        $select_users->execute();
                        $total_users = $select_users->get_result()->num_rows;
                        ?>
                        <div class="card-body">
                            <h3 class="card-title">Người dùng</h3>
                            <h3 class="card-text">Số lượng: <?php echo $total_users; ?></h3>
                            <a href="user.php" class="btn btn-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <!-- quản lý bình luận -->
                <div class="col-md-4">
                    <div class="card">
                    <?php
                        $select_comments = $con->prepare("SELECT * FROM `binhluan`");
                        $select_comments->execute();
                        $total_comments = $select_comments->get_result()->num_rows;
                        ?>
                        <div class="card-body">
                            <h3 class="card-title">Bình luận</h3>
                            <h3 class="card-text">Số lượng: <?php echo $total_comments; ?></h3>
                            <a href="comments.php" class="btn btn-primary">Xem thêm</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
