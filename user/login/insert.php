<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $address = $_POST['address'];

    // kiểm tra thông tin không được để trống
    if (empty($name) || empty($email) || empty($number) || empty($password)) {
        echo '<script>
            alert("Vui lòng điền đầy đủ thông tin");
            window.location.href = "register.php";
            </script>';
    } else {
        $ch_email = mysqli_query($con, "SELECT * FROM `nguoidung` WHERE email = '$email'");
        
        if (mysqli_num_rows($ch_email)) {
            echo '<script>
                alert("Email đã được sử dụng");
                window.location.href = "register.php";
                </script>';
        } else {
            // kiểm tra mật khẩu phải lớn hơn 3 ký tự
            if (strlen($password) < 3) {
                echo '<script>
                    alert("Mật khẩu phải có ít nhất 3 ký tự");
                    window.location.href = "register.php";
                    </script>';
            } else {
                mysqli_query($con, "INSERT INTO `nguoidung`(`tennd`, `sdt`, `email`, `matkhau`, `diachi`) 
                VALUES ('$name', '$number', '$email', '$password', '$address')");                
                echo '<script>
                    alert("Đăng Ký Thành Công.");
                    window.location.href = "login.php";
                    </script>';
            }
        }
    }
}
?>