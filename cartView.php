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

    <a class="text-decoration-none text-success fs-5" style="margin-left: 88%;" href="cart_order.php">Đơn hàng của bạn</a>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="bg-light text-dark text-center p-2 border-bottom">Giỏ Hàng</h2>
            </div>
        </div> 
    </div>
    <div class="container-fluid">
        <div class="row justify-content-around">
            <div class="col-sm-12 col-md-6 col-lg-9">
                <table class="table table-bordered text-center">
                    <thead>
                        <th>STT</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Số Lượng</th>
                        <th>Tổng Tiền</th>
                        <th>Cập nhật</th>
                        <th>Xóa</th>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        $pay_total = 0;
                        $i = 0;
                        if (isset($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $key => $value) {
                                $total = $value['gia'] * $value['soluong'];
                                $pay_total += $value['gia'] * $value['soluong'];
                                $i = $key + 1;
                                // format giá
                                $formatted_price = number_format($value['gia'], 0, ',', '.') . ' VNĐ';
                                $formatted_total = number_format($total, 0, ',', '.') . ' VNĐ';
                                echo '
                                    <form action="cart.php" method="post">
                                    <tr>
                                        <td>' . $i . '</td>
                                        <td><input type="hidden" name="name" value="' . $value['tensp'] . '">' . $value['tensp'] . '</td>
                                        <td><input type="hidden" name="price" value="' . $value['gia'] . '">' . $formatted_price . ' </td>
                                        <td><input type="number" name="quantity" value="' . $value['soluong'] . '"></td> 
                                        <td>' . $formatted_total . ' </td>
                                        <td>
                                        <button name ="update" class="btn btn-outline-warning">Cập nhật</button>
                                        </td>
                                        <td>
                                            <input type="hidden" name="item" value="' . $value['tensp'] . '">
                                            <button onclick="return confirm(\'Bạn có chắc chắn muốn xóa không?\')"
                                            type="submit" name="remove" class="btn btn-outline-danger">Xóa</button>
                                        </td>
                                    </form>
                                    ';
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4 text-center" style="margin-bottom: 77px;">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tổng Tiền</h5>
                        <h1 class="card-text bg-success text-white"><?php echo number_format($pay_total, 0, ',', '.') ?> VNĐ</h1>
                        <a href="checkout.php" class="btn btn-success">Thanh toán</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

     <!-- phần footer -->
     <?php include './layout/footer.php'; ?>
</body>

</html>