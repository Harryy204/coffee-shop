<?php
session_start();
include 'config.php';

if (isset($_POST['order_btn'])) {
    // kiểm tra sản phẩm có tồn tại trong giỏ hàng không
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
        $name = $_POST['name'];
        $phone = $_POST['number'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $payment_method = $_POST['method'];
        $note = $_POST['note'];

        mysqli_begin_transaction($con);

        // lấy thông tin người dùng thông qua email
        $sql_user = "SELECT id FROM nguoidung WHERE email = '$email'";
        $result_user = mysqli_query($con, $sql_user);

        if (mysqli_num_rows($result_user) > 0) {
            $user_data = mysqli_fetch_assoc($result_user);
            $user_id = $user_data['id'];

            // thêm thông tin vào hoadon
            $sql_order = "INSERT INTO hoadon (idnd, ngaymua) VALUES ('$user_id', NOW())";

            if (mysqli_query($con, $sql_order)) {
                $order_id = mysqli_insert_id($con);

                foreach ($_SESSION['cart'] as $product) {
                    $product_name = $product['tensp'];
                    $quantity = $product['soluong'];
                    $price = $product['gia'];
                    $total = $product['gia'] * $product['soluong'];

                    // lấy thông tin sản phẩm theo tên 
                    $sql_product = "SELECT id, soluong FROM sanpham WHERE tensp = '$product_name'";
                    $result_product = mysqli_query($con, $sql_product);

                    if (mysqli_num_rows($result_product) > 0) {
                        $row_product = mysqli_fetch_assoc($result_product);
                        $product_id = $row_product['id'];
                        $current_quantity = $row_product['soluong'];

                        if ($current_quantity >= $quantity) {
                            $new_quantity = $current_quantity - $quantity;

                            // cập nhật lại số lượng sản phẩm
                            $sql_update_quantity = "UPDATE sanpham SET soluong = $new_quantity WHERE id = $product_id";
                            mysqli_query($con, $sql_update_quantity);

                            // thêm thông tin sản phẩm vào hoadonchitiet
                            $sql_item = "INSERT INTO hoadonchitiet (idsp, idhd, tenkhachhang, sdt, email, diachi, cachthanhtoan, soluongban, giatong, trangthai, ghichu)
                                VALUES ('$product_id', '$order_id', '$name', '$phone', '$email', '$address', '$payment_method', '$quantity', '$total', 'Chưa thanh toán', '$note')";

                            if (!mysqli_query($con, $sql_item)) {
                                // nếu có lỗi sẽ trở lại giao dịch và hiển thị thông báo lỗi
                                mysqli_rollback($con);
                                echo '<script>
                                    alert("Lỗi khi thêm dữ liệu vào hoadonchitiet: ' . mysqli_error($con) . '");
                                    window.location.href = "cartView.php";
                                </script>';
                                exit;
                            }
                        } else {
                            // nếu mua quá số lượng thì sẽ trở lại và hiển thị thông báo lỗi
                            mysqli_rollback($con);
                            echo '<script>
                                alert("Sản phẩm ' . $product_name . ' không đủ số lượng trong kho");
                                window.location.href = "cartView.php";
                            </script>';
                            exit;
                        }
                    }
                }
                mysqli_commit($con);
                echo '
                <script>
                    alert("Đặt hàng thành công");
                    window.location.href = "index.php";
                </script>';
                unset($_SESSION['cart']);
            }
        }
    }
}
?>