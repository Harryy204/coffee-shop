<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/header.css">
    <title>COFFEE</title>
</head>

<body>
<?php
    // bắt đầu phiên làm viêch
    session_start();
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
                        <a class="nav-link text-white" href="./index.php"><i class="fa-solid fa-house" style="margin: 3px;"></i>Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./about.php"><i class="fa-solid fa-users" style="margin: 3px;"></i>Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./store.php"><i class="fa-solid fa-store" style="margin: 3px;"></i>Thực đơn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./cartView.php"><i class="fa-solid fa-cart-shopping" style="margin: 3px;"></i>Giỏ hàng(<?php echo $count ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="./contact.php"><i class="fa-solid fa-envelope" style="margin: 3px;"></i>Liên hệ</a>
                    </li>
                </ul>
                <!-- tìm kiếm sản phẩm -->
                <form method="GET" action="./search.php" class="d-flex">
                    <input type="text" name="searchPro" class="form-control form-control-sm me-2" placeholder="Tìm kiếm sản phẩm...">
                    <button type="submit" class="btn btn-outline-light btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <!-- đăng nhập và quản lý -->
                <span class="text-white desktop-menu mobile-only">
                    <i class="fa-solid fa-user-shield" style="margin: 3px;"></i>Xin chào,
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo '<a href="../coffeeshop/user/login/edit_pro.php" class="text-dark text-decoration-none pe-2 text-white">' . $_SESSION['user'] . '</a>';
                        echo ' | <a href="../coffeeshop/user/login/logout.php" class="text-dark text-decoration-none pe-2 text-white"><i class="fas fa-sign-out-alt" style="margin: 3px;"></i>Đăng xuất |</a>';
                    } else {
                        echo ' | <a href="../coffeeshop/user/login/login.php" class="text-dark text-decoration-none pe-2 text-white"><i class="fas fa-sign-out-alt" style="margin: 3px;"></i>Đăng nhập |</a>';
                    }
                    // kiểm tra vai trò nếu là admin sẽ hiển thị liên kết đến trang admin
                    if (isset($_SESSION['admin'])) {
                        echo '<a href="./admin/index.php" class="text-dark text-decoration-none pe-2 text-white">Admin</a>';
                    }
                    ?>
                </span>
            </div>
        </div>
    </nav>
</body>

</html>