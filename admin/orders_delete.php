<?php
include '../config.php';

if (isset($_POST['delete_orders'])) {
    $orders_id = $_POST['orders_id'];

    // thực hiện xóa đơn hàng từ cơ sở dữ liệu dựa trên $orders_id
    $deleteQuery = "DELETE FROM hoadonchitiet WHERE id = '$orders_id'";

    if (mysqli_query($con, $deleteQuery)) {
        // đơn hàng đã được xóa thành công
        header("Location: orders.php"); 
        exit();
    } else {
        // xử lý lỗi nếu có
        echo "Lỗi: " . mysqli_error($con);
    }
}

// đóng kết nối
mysqli_close($con);
?>
