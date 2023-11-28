<?php
session_start();

// kểm tra xem $_SESSION['cart'] có tồn tại hay không
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

$product_name = $_POST['name'];
$product_price = $_POST['price'];
$product_quantity = $_POST['quantity'];


if (isset($_POST['addCart'])) {
    $check_product = array_column($_SESSION['cart'], 'tensp');
    if (in_array($product_name, $check_product)) {
        echo '
        <script>
        alert("Sản phẩm này đã có trong giỏ hàng");
        window.location.href = "cartView.php";
        </script>
        ';
    } else {
        $_SESSION['cart'][] = array(
            'tensp' => $product_name,
            'gia' => $product_price,
            'soluong' => $product_quantity
            
        );
        header('location: cartView.php');
    }
}

// xóa sản phẩm
if (isset($_POST['remove'])) {
    $product_name = $_POST['item'];
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['tensp'] === $product_name) {
            unset($_SESSION['cart'][$key]);
            break;
        }
    }
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    header('location: cartView.php');
}

// cập nhật sản phẩm
if (isset($_POST['update'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['tensp'] === $_POST['item']) {
            $_SESSION['cart'][$key] = array(
                'tensp' => $product_name,
                'gia' => $product_price,
                'soluong' => $product_quantity
            );
            header('location: cartView.php');
        }
    }
}
?>




