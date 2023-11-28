<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bình luận</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
</head>
<?php
session_start();
if (!$_SESSION['admin']) {
    header("location: login/login.php");
}
?>

<body>
    <!-- header -->
    <nav class="navbar bg-dark">
        <div class="container-fluid text-white">
            <a href="../index.php" class="text-decoration-none">
                <h4 class="navbar-brand fw-bold text-white" style="margin: 0;">COFFEE</h4>
            </a>
            <span>
                <i class="fa-solid fa-user-shield"></i>
                Xin chào, <?php echo $_SESSION['admin']; ?>|
                <i class="fas fa-sign-out-alt"></i>
                <a href="../user/login/logout.php" class="text-decoration-none text-white">Đăng xuất</a>|
                <a href="../index.php" class="text-decoration-none text-white">Khách truy cập</a>
            </span>
        </div>
    </nav>
    <button class="bg-success fw-bold"><a href="./index.php" class=" text-decoration-none pe-2 text-white"><i class="fa-sharp fa-solid fa-circle-left" style="margin: 5px;"></i>Trang Quản Lý</a></button>
    <h1 class=" text-center text-success">Quản lý bình luận</h1>
    <table class="text-center table table-bordered">
        <thead>
            <tr>
                <th>STT</th>
                <th>ID người dùng</th>
                <th>ID sản phẩm</th>
                <th>Nội dung</th>
                <th>Ngày đăng</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include '../config.php';

            // truy vấn cơ sở dữ liệu để lấy danh sách bình luận
            $commentQuery = "SELECT * FROM binhluan";
            $commentResult = mysqli_query($con, $commentQuery);

            if (mysqli_num_rows($commentResult) > 0) {
                $id_count =1;
                while ($comment = mysqli_fetch_assoc($commentResult)) {
                    echo "<tr>";
                    echo "<td>$id_count</td>";
                    echo "<td>{$comment['idnd']}</td>";
                    echo "<td>{$comment['idsp']}</td>";
                    echo "<td>{$comment['noidung']}</td>";
                    echo "<td>{$comment['ngaybl']}</td>";
                    echo "<td>";
                    echo "<form action='comments_delete.php' method='POST' onsubmit='return confirmDelete();'>";
                    echo "<input type='hidden' name='comment_id' value='{$comment['id']}'>";
                    echo "<input type='submit' name='delete_comment' class='btn btn-danger' value='Xóa'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                    $id_count++;
                }
            } else {
                echo "<tr><td colspan='5'>Không có bình luận nào</td></tr>";
            }

            // đóng kết nối
            mysqli_close($con);
            ?>
        </tbody>
    </table>
    <script>
        function confirmDelete(){
            return confirm ("Bạn có chắc muốn xóa bình luận này");
        }
    </script>
</body>

</html>
