<?php
session_start();
include 'config.php';

// lấy thông tin cá nhân của người dùng từ cơ sở dữ liệu
$user = $_SESSION['user'];
$query = "SELECT * FROM `nguoidung` WHERE Tennd = '$user'";
$result = mysqli_query($con, $query);
$userInfo = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    // lấy thông tin mới từ form
    $newEmail = $_POST['new_email'];
    $newNumber = $_POST['new_number'];
    $newAddress = $_POST['new_address'];
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    // cập nhật thông tin mới vào cơ sở dữ liệu
    $updateQuery = "UPDATE `nguoidung` SET Email = '$newEmail', Sdt = '$newNumber', Matkhau = '$newPassword', diachi = '$newAddress' WHERE Tennd = '$user'";
    mysqli_query($con, $updateQuery);

    // chuyển hướng người dùng sau khi cập nhật thông tin
    header('Location: edit_pro.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Thông Tin</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/footer.css">
    <style>
        h2 {
            background-color: #f5f5f5;
            color: #2c2828;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: center;
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
            <a class="navbar-brand text-white" href="../../index.php">COFFEE</a>
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
    <h2 class="mb-4">Chỉnh Sửa Thông Tin Cá Nhân</h2>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <form action="" method="POST" onsubmit="return validateForm();">
                    <div class="mb-3">
                        <label class="form-label">Tên đăng nhập:</label>
                        <input type="text" class="form-control" value="<?php echo $userInfo['tennd']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="new_email" class="form-label">Email mới:</label>
                        <input type="email" id="new_email" name="new_email" class="form-control" value="<?php echo $userInfo['email']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="new_number" class="form-label">Số điện thoại mới:</label>
                        <input type="number" id="new_number" name="new_number" class="form-control" value="<?php echo $userInfo['sdt']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="new_address" class="form-label">Địa chỉ mới:</label>
                        <input type="address" id="new_address" name="new_address" class="form-control" value="<?php echo $userInfo['diachi']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Mật khẩu mới:</label>
                        <input type="password" id="new_password" name="new_password" class="form-control" value="<?php echo $userInfo['matkhau']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Xác nhận mật khẩu:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                    </div>
                    <div id="errorMess" style="color: red;"></div>
                    <button type="submit" name="submit" class="btn btn-primary">Lưu Thay Đổi</button>
                    <a href="../../user/login/forgot_pass.php" style="text-decoration: none; float:right">Quên Mật Khẩu</a>
                </form>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var newEmail = document.getElementById('new_email').value;
            var newNumber = document.getElementById('new_number').value;
            var newPassword = document.getElementById('new_password').value;
            var newAddress = document.getElementById('new_address').value;
            var confirmPassword = document.getElementById('confirm_password').value;
            var errorMess = document.getElementById('errorMess');
            // xóa thông báo lỗi cũ
            errorMess.innerHTML = "";

            if (newEmail === "" || newNumber === "" || newPassword === "" || newAddress === "" || confirmPassword === "") {
                errorMess.innerHTML = "Vui lòng điền đầy đủ thông tin";
                return false;
            }
            if (newPassword.length < 3) {
                errorMess.innerHTML = "Mật khẩu phải có hơn 3 ký tự";
                return false;
            }
            if (newPassword != confirmPassword) {
                errorMess.innerHTML = "Mật khẩu không trùng khớp";
                return false;
            }
            if (confirmPassword === "") {
                errorMess.innerHTML = "Vui lòng xác nhận mật khẩu";
                return false;
            }

            var successMess = document.getElementById('successMess');
            alert("Cập nhật thành công");
        }
    </script>

    <?php include '../../layout/footer.php'; ?>
</body>

</html>

<?php
// đóng kết nối đến cơ sở dữ liệu
mysqli_close($con);
?>