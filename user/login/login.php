<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/footer.css">
    <style>
        .have-account a {
            text-decoration: none;
            color: black;
        }

        .have-account a:hover {
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
                        <a class="nav-link text-white" href="../../store.php"><i class="fa-solid fa-store" style="margin: 3px;"></i>Thực đơn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../../cartView.php"><i class="fa-solid fa-cart-shopping" style="margin: 3px;"></i>Giỏ hàng</a>
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
            <div class="col-md-5 mt-5 mb-5 m-auto shadow">
                <p class="text-success text-center fw-bold fs-5 mt-3">Đăng Nhập</p>
                <form action="login1.php" method="POST">
                    <div class="mb-3">
                        <label for="email">Nhập Địa Chỉ Email</label>
                        <input type="email" id="email" name="email" placeholder="Nhập Địa Chỉ Email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="password">Nhập Mật Khẩu</label>
                        <input type="password" id="password" name="password" placeholder="Nhập Mật Khẩu" class="form-control" required>
                    </div>
                    <div class="mb-3 d-flex justify-content-center align-items-center">
                        <button name="submit" class="w-50 bg-success fs-4 fw-bold text-white rounded">Đăng Nhập</button>
                    </div>
                    <div class="have-account pb-3 d-flex justify-content-between">
                        <a href="forgot_pass.php">Bạn đã quên mật khẩu?</a>
                        <a href="register.php">Đăng Ký Ngay</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include '../../layout/footer.php'; ?>

</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    include 'config.php';
    $result = mysqli_query($con, "SELECT * FROM `nguoidung` WHERE (email = '$email') AND matkhau = '$password'");

    // kiểm tra xem người dùng có tồn tại và đúng mật khẩu không
    if (mysqli_num_rows($result) > 0) {
        $user_info = mysqli_fetch_assoc($result);

        // lưu vai trò của người dùng vào biến session
        $_SESSION['role'] = $user_info['role'];

        // xác định trang chuyển hướng dựa trên vai trò
        $redirect_page = ($_SESSION['role'] === 'admin') ? '../admin/index.php' : '../user/index.php';

        // chuyển hướng người dùng đến trang tương ứng
        header("Location: $redirect_page");
        exit();
    } else {
        echo '<script>
        alert("Tài Khoản Hoặc Mật Khẩu Không Chính Xác");
        </script>';
    }
}
?>
