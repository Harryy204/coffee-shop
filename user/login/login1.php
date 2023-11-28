<?php
$email = $_POST['email'];
$password = $_POST['password'];
include 'config.php';
$result = mysqli_query($con, "SELECT * FROM `nguoidung` WHERE (email = '$email') AND matkhau = '$password'");
session_start();

if (mysqli_num_rows($result)) {
    $user_info = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $user_info['id'];
    $_SESSION['user'] = $user_info['tennd'];

    // kiểm tra vai trò của người dùng
    $role = $user_info['role'];

    if ($role === 'admin') {
        // đánh dấu người dùng là admin trong session
        $_SESSION['admin'] = $user_info['tennd'];

        // chuyển hướng đến trang quản trị
        header("Location: ../../admin/index.php");
        exit();
    } else {
        // nếu không phải admin, chuyển hướng đến trang người dùng thông thường
        header("Location: ../../index.php");
        exit();
    }
} else {
    echo '
        <script>
        alert("Tài Khoản Hoặc Mật Khẩu Không Chính Xác");
        window.location.href = "login.php";
        </script>
    ';
}
?>
