<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/header.css">
    <title>Giỏ hàng</title>
</head>

<body>
    <!-- phần header -->

    <?php include './layout/header.php' ?>
    <?php
    include 'config.php';

    // kiểm tra xem người dùng đã đăng nhập hay chưa
    if (!isset($_SESSION['user_id'])) {
        header("Location: ./login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    // truy vấn csdl để lấy thông tin đơn hàng của người dùng
    $sql = "SELECT hoadon.*, hoadonchitiet.tenkhachhang, hoadonchitiet.sdt, hoadonchitiet.diachi, hoadonchitiet.giatong, hoadonchitiet.cachthanhtoan, hoadonchitiet.trangthai
            FROM hoadon
            JOIN hoadonchitiet ON hoadon.id = hoadonchitiet.idhd
            WHERE hoadon.idnd = '$user_id'
            ORDER BY hoadon.ngaymua DESC";

    $result = mysqli_query($con, $sql);

    ?>
    <h2 class="bg-light text-dark text-center p-2 border-bottom">Đơn hàng của bạn</h2>
    <div class="container-fluid text-white">
        <table class="table table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">Họ và tên</th>
                    <th scope="col">Số điện thoại</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Tổng tiền</th>
                    <th scope="col">Phương thức thanh toán</th>
                    <th scope="col">Ngày đặt hàng</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr class="text-center">';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['tenkhachhang'] . '</td>';
                    echo '<td>' . $row['sdt'] . '</td>';
                    echo '<td>' . $row['diachi'] . '</td>';
                    echo '<td>' . number_format($row['giatong'], 0, ',', '.') . ' VNĐ</td>';
                    echo '<td>' . $row['cachthanhtoan'] . '</td>';
                    echo '<td>' . $row['ngaymua'] . '</td>';
                    echo '<td>' . $row['trangthai'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>