<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    
</head>

<body>
<button class="bg-success fw-bold"><a href="orders.php" class=" text-decoration-none pe-2 text-white"><i class="fa-sharp fa-solid fa-circle-left" style="margin: 5px;"></i>Đơn Hàng</a></button>
    <div class="container">
        <h1 class="heading text-center text-success">Sửa đơn hàng</h1>
        <?php
        if (isset($_POST['idhd']) && isset($_POST['trangthai'])) {
            include '../config.php';

            $order_id = $_POST['idhd'];
            $status = $_POST['trangthai'];

            // cập nhật trạng thái đơn hàng trong cơ sở dữ liệu
            $sql_update = "UPDATE hoadonchitiet SET trangthai = '$status' WHERE idhd = $order_id";
            $result_update = $con->query($sql_update);
        }
        ?>
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
                </tr>
            </thead>
            <tbody>
                <?php
                include '../config.php';

                // lấy thông tin đơn hàng từ cơ sở dữ liệu
                if (isset($_GET['idhd'])) {
                    $order_id = $_GET['idhd'];
                    $sql = "SELECT * FROM hoadonchitiet WHERE idhd = $order_id";
                    $result = $con->query($sql);

                    if ($result->num_rows > 0) {
                        $order = $result->fetch_assoc();
                        echo '
                        <tr>
                            <td>' . $order['idhd'] . '</td>
                            <td>' . $order['idsp'] . '</td>
                            <td>' . $order['tenkhachhang'] . '</td>
                            <td>' . $order['sdt'] . '</td>
                            <td>' . $order['diachi'] . '</td>
                            <td>' . $order['cachthanhtoan'] . '</td>
                            <td>' . $order['soluongban'] . '</td>
                            <td>' . number_format($order['giatong'], 0, ',', '.') . ' VNĐ</td>
                            <td>' . $order['ghichu'] . '</td>
                            <td>
                                <form action="" method="post" style="display: flex; align-items: center;">
                                    <input type="hidden" name="idhd" value="' . $order['idhd'] . '">
                                    <select name="trangthai" class="form-select" style="flex: 1; margin-right: 10px;">
                                        <option value="Chưa thanh toán"' . ($order['trangthai'] == "Chưa thanh toán" ? " selected" : "") . '>Chưa thanh toán</option>
                                        <option value="Đã thanh toán"' . ($order['trangthai'] == "Đã thanh toán" ? " selected" : "") . '>Đã thanh toán</option>
                                    </select>
                                    <button type="submit" class="btn btn-outline-success" style="margin-right: 5px;">Lưu</button>
                                </form>
                            </td>

                        </tr>';
                    } else {
                        echo "<tr><td colspan='7'>Không tìm thấy đơn hàng</td></tr>";
                    }
                }

                $con->close();
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>
