<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sứ Mệnh Của Chúng Tôi</title>
    <link rel="stylesheet" href="../css/footer.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iS6sxE8j9VGmOjsnW9ISlF5SNYUl0aSTbteS" crossorigin="anonymous">
    <style>
    .card-img {
        height: 288px;
        object-fit: cover;
    }
</style>
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
                        <a class="nav-link text-white" href="../index.php"><i class="fa-solid fa-house" style="margin: 3px;"></i>Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../about.php"><i class="fa-solid fa-users" style="margin: 3px;"></i>Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../store.php"><i class="fa-solid fa-store" style="margin: 3px;"></i>Thực đơn</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../cartView.php"><i class="fa-solid fa-cart-shopping" style="margin: 3px;"></i>Giỏ hàng(<?php echo $count ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="../contact.php"><i class="fa-solid fa-envelope" style="margin: 3px;"></i>Liên hệ</a>
                    </li>
                </ul>
                <!-- tìm kiếm sản phẩm -->
                <form method="GET" action="../search.php" class="d-flex">
                    <input type="text" name="searchPro" class="form-control form-control-sm me-2" placeholder="Tìm kiếm sản phẩm...">
                    <button type="submit" class="btn btn-outline-light btn-sm"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                <!-- đăng nhập và quản lý -->
                <span class="text-white desktop-menu mobile-only">
                    <i class="fa-solid fa-user-shield" style="margin: 3px;"></i>Xin chào,
                    <?php
                    if (isset($_SESSION['user'])) {
                        echo '<a href="../../coffeeshop/user/login/edit_pro.php" class="text-dark text-decoration-none pe-2 text-white">' . $_SESSION['user'] . '</a>';
                        echo ' | <a href="../../coffeeshop/user/login/logout.php" class="text-dark text-decoration-none pe-2 text-white"><i class="fas fa-sign-out-alt" style="margin: 3px;"></i>Đăng xuất |</a>';
                    } else {
                        echo ' | <a href="../../coffeeshop/user/login/login.php" class="text-dark text-decoration-none pe-2 text-white"><i class="fas fa-sign-out-alt" style="margin: 3px;"></i>Đăng nhập |</a>';
                    }
                    // kiểm tra vai trò nếu là admin sẽ hiển thị liên kết đến trang admin
                    if (isset($_SESSION['admin'])) {
                        echo '<a href="../admin/index.php" class="text-dark text-decoration-none pe-2 text-white">Admin</a>';
                    }
                    ?>
                </span>
            </div>
        </div>
    </nav>
    <img src="../images/mission.jpg" alt="Lịch sử" style="width:100%">

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title">SỨ MỆNH CỦA CHÚNG TÔI</h1>
                        <p class="card-text">
                            <span style="font-size: 18px;">CÂU CHUYỆN NÀY LÀ CỦA CHÚNG MÌNH</span>
                        </p>
                        <p class="card-text">
                            Được thành lập vào năm 2023, bắt nguồn từ tình yêu dành cho đất Việt cùng với cà phê và cộng đồng nơi đây.
                            Tinh thần cộng đồng luôn chảy trong ADN của mỗi người Việt mình. Ngay từ những ngày đầu tiên, mục tiêu của chúng mình là có thể phục vụ và góp phần phát triển cộng đồng bằng cách siết chặt thêm sự kết nối và sự gắn bó giữa người với người.
                        </p>
                        <p class="card-text">
                            Ngày hôm nay, với hàng trăm cửa hàng trên khắp Việt Nam và trên Thế Giới, thứ chúng mình đem lại không chỉ dừng lại ở cà phê. Chúng mình còn là nơi để thuộc về, là nơi để kết nối tất cả mọi người với nhau. Từ đó, Coffee Shop trở thành nơi dành riêng cho cộng đồng.
                        </p>
                        <p class="card-text">
                            Trong tương lai, chúng mình sẽ luôn thấy một Việt Nam đang phát triển và chúng tôi không ngừng cải tiến. Coffee Shop - điểm tụ họp của cộng đồng, nơi mọi người có thể kết nối và gắn kết với nhau bằng tình yêu dành cho cà phê, trà và các món ăn ngon. Tại Coffee Shop, chúng mình luôn sát cánh cùng bạn, chúng mình luôn ủng hộ bạn và chúng mình luôn đồng hành với nhau như một cộng đồng.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <img src="../images/mission.jpg" class="card-img-top card-img" style="height: 500px;">
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-3 text-center mt-4 mb-4">
        <h3>Bài Viết Khác</h3><br>
        <div class="row">
            <div class="col-sm-4">
                <a href="history.php" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    <div class="card">
                        <img src="../images/history.jpg" class="card-img-top card-img">
                        <div class="card-body">
                            <h5 class="card-title">Lịch Sử Hình Thành</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="origin.php" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    <div class="card">
                        <img src="../images/origin.jpg" class="card-img-top card-img">
                        <div class="card-body">
                            <h5 class="card-title">Nguồn Nguyên Liệu</h5>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="mission.php" class="link-secondary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                    <div class="card">
                        <img src="../images/mission.jpg" class="card-img-top card-img">
                        <div class="card-body">
                            <h5 class="card-title">Sứ Mệnh Của Chúng Tôi</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <?php include '../layout/footer.php'; ?>
</body>

</html>
