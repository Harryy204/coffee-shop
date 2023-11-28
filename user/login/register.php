<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/footer.css">
    <style>
        .have-account a{
            text-decoration: none;
            color: black;
        }
        .have-account a:hover{
            color: green;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    // đếm số lượng sản phẩm có trong giỏ hàng
    $count = 0;
    if (isset($_SESSION['cart'])) {
        $count = count($_SESSION['cart']);
    }
    ?>
    <nav class="navbar navbar-expand-lg bg-dark" style="font-family: 'Roboto', sans-serif;">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="./index.php">COFFEE</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../../index.php"><i class="fa-solid fa-house" style="margin: 3px;"></i>Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../../about.php"><i class="fa-solid fa-users" style="margin: 3px;"></i>Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"><i class="fa-solid fa-store" style="margin: 3px;"></i>Thực đơn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="#"><i class="fa-solid fa-cart-shopping" style="margin: 3px;"></i>Giỏ hàng</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../../contact.php"><i class="fa-solid fa-envelope" style="margin: 3px;"></i>Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-md-6 mt-5 mb-5 m-auto shadow">
                <p class="text-success text-center fw-bold fs-5 mt-3">Đăng Ký</p>
                <form action="insert.php" method="POST">
                    <div class="mb-3">
                        <label for="">Tên Đăng Nhập</label>
                        <input type="text" id="name" name="name" placeholder="Nhập Tên Đăng Nhập" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Địa Chỉ Email</label>
                        <input type="email" id="email" name="email" placeholder="Nhập Địa Chỉ Email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Số Điện Thoại</label>
                        <input type="number" id="number" name="number" placeholder="Nhập Số Điện Thoại" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Nhập Mật Khẩu</label>
                        <input type="password" id="password" name="password" placeholder="Nhập Mật Khẩu" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="">Địa Chỉ</label>
                        <input type="text" id="address" name="address" placeholder="Nhập Địa Chỉ" class="form-control" required>
                    </div>
                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        <button name="submit" type="submit" class="w-50 bg-success fs-4 fw-bold text-white rounded">Đăng Ký</button>
                    </div>
                    <div class="have-account d-flex justify-content-between">
                    <p>Bạn đã có tài khoản?</p>
                    <a href="login.php">Đăng Nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include '../../layout/footer.php'; ?>
</body>
</html>