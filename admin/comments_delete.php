<?php
include '../config.php';

if (isset($_POST['delete_comment'])) {
    $comment_id = $_POST['comment_id'];

    // thực hiện xóa bình luận từ cơ sở dữ liệu dựa trên $comment_id
    $deleteQuery = "DELETE FROM binhluan WHERE id = '$comment_id'";

    if (mysqli_query($con, $deleteQuery)) {
        // bình luận đã được xóa thành công
        header("Location: comments.php"); 
        exit();
    } else {
        // xử lý lỗi nếu có
        echo "Lỗi: " . mysqli_error($con);
    }
}

// đóng kết nối
mysqli_close($con);
?>
