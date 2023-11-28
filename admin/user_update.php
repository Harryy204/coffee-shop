<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['new_role'];

    // thực hiện truy vấn để cập nhật vai trò của người dùng
    $updateQuery = "UPDATE nguoidung SET Role = '$new_role' WHERE id = $user_id";

    if (mysqli_query($con, $updateQuery)) {
        echo "Cập nhật vai trò thành công";
    } else {
        echo "Lỗi khi cập nhật vai trò: " . mysqli_error($con);
    }
}
header('location: user.php');
?>
