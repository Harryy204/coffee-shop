<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
</head>

<body>
    <?php
    session_start();
    if (!$_SESSION['admin']) {
        header("location: login/login.php");
    }
    include '../config.php';
    $record = mysqli_query($con, "SELECT * FROM `nguoidung`");
    $id_count = 1;
    ?>
    <!-- header -->
    <nav class="navbar bg-dark">
        <div class="container-fluid text-white">
            <a href="index.php" class="text-decoration-none">
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
    <button class="bg-success fw-bold"><a href="index.php" class=" text-decoration-none pe-2 text-white"><i class="fa-sharp fa-solid fa-circle-left" style="margin: 5px;"></i>Trang Quản Lý</a></button>
    <?php
    include '../config.php';
    $record = mysqli_query($con, "SELECT * FROM `nguoidung`");
    $row_count = mysqli_num_rows($record);
    $id_count = 1;
    ?>

    <tbody>
        <!-- lặp qua danh sách các đơn hàng từ database và hiển thị trong bảng -->
        <div class="container">
            <h1 class="heading text-center text-success">Danh sách đơn hàng</h1>

            <table class="table table-bordered">
                <thead>
                    <tr class="text-center">
                        <th scope="col">MHD</th>
                        <th scope="col">MSP</th>
                        <th scope="col">Tên</th>
                        <th scope="col">SĐT</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Thanh toán</th>
                        <th scope="col">Số lượng bán</th>
                        <th scope="col">Tổng tiền</th>
                        <th scope="col">Ghi chú</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tuỳ chọn</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $sql = "SELECT * FROM hoadonchitiet";
                    $result = $con->query($sql);

                    // kiểm tra xem có dữ liệu trả về hay không
                    if ($result->num_rows > 0) {
                        while ($order = $result->fetch_assoc()) {
                            echo '<tr class="text-center">
                             <td>' . $order['idhd'] . '</td>
                             <td>' . $order['idsp'] . '</td>
                             <td>' . $order['tenkhachhang'] . '</td>
                             <td>' . $order['sdt'] . '</td>
                             <td>' . $order['diachi'] . '</td>
                             <td>' . $order['cachthanhtoan'] . '</td>
                             <td>' . $order['soluongban'] . '</td>
                             <td>' . number_format($order['giatong'], 0, ',', '.') . ' VNĐ</td>
                             <td>' . $order['ghichu'] . '</td>
                             <td>' . $order['trangthai'] . '</td>
                             <td style="text-align:center; display: flex; justify-content: space-around">';
                            if ($order['trangthai'] == 'Chưa thanh toán') {
                                echo '<a href="orders_edit.php?idhd=' . $order['idhd'] . '"  class="btn btn-success">Sửa</a>';
                            } else {
                                echo '<a href="#" class="btn btn-success disabled">Sửa</a>';
                                echo "<form action='orders_delete.php' method='POST' onsubmit='return confirmDelete();'>";
                                echo "<input type='hidden' name='orders_id' value='{$order['id']}'>";
                                echo "<input type='submit' name='delete_orders' class='btn btn-danger' value='Xóa'>";
                                echo "</form>";
                            }
                            echo '</td>
                         </tr>';
                        }
                    } else {
                        echo "<tr><td colspan='8'>Không có đơn hàng nào trong cơ sở dữ liệu</td></tr>";
                    }

                    $con->close();
                    ?>
                </tbody>
            </table>
        </div>
        <script>
        function confirmDelete(){
            return confirm ("Bạn có chắc muốn xóa hoá đơn này");
        }
        </script>
</body>

</html>