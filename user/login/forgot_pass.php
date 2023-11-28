<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/footer.css">
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


    <form method="POST">
        <h2 class="bg-light text-dark text-center p-2 border-bottom">Nhập Địa Chỉ Email Của Bạn Để Đặt Lại Mật Khẩu</h2>
        <div style="display: flex; justify-content: center; margin-bottom: 150px;">
            <div class="justify-content-center">
                <div class="mb-3">
                    <label class="form-label">Email</label><br>
                    <input type="email" name="email" class="form-control" placeholder="Nhập địa chỉ email">
                    <div class="form-text">Chúng tôi sẽ gửi cho bạn mật khẩu mới</div>
                </div>
                <button type="submit" name="reset" class="btn btn-primary">Gửi</button>
            </div>
        </div>
    </form>
    <?php
    // tạo mật khẩu random
    function randomPassword($length = 8) {
        $chars = "abcABC123@#*";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }
    if (isset($_POST['reset'])) {
        $email = $_POST['email'];
        include 'config.php';

        // kiểm tra xem email có tồn tại trong cơ sở dữ liệu không
        $checkEmail = "SELECT * FROM nguoidung WHERE email = '$email'";
        $result = mysqli_query($con, $checkEmail);

        if (mysqli_num_rows($result) > 0) {
            // nếu email tồn tại gửi mật khẩu mới
            $newPassword = randomPassword();

            // cập nhật mật khẩu mới trong cơ sở dữ liệu
            $updatePassword = "UPDATE nguoidung SET matkhau = '$newPassword' WHERE email = '$email'";
            if (mysqli_query($con, $updatePassword)) {
                echo "
                <script>
                alert ('Mật khẩu của bạn đã được đặt lại thành: $newPassword');
                window.location.href='login.php';
                </script>
                ";
            } else {
                echo "Lỗi khi cập nhật mật khẩu: " . mysqli_error($con);
            }
        } else {
            echo "<script>
            alert ('Email không tồn tại trong cơ sở dữ liệu');
            window.location.href='forgot_pass.php';
            </script>";
        }

        // đóng kết nối đến cơ sở dữ liệu
        mysqli_close($con);
    }
    ?>

    <?php include '../../layout/footer.php'; ?>
</body>

</html>