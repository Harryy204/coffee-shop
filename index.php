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
    <title>Coffee</title>
</head>

<body>
    <!-- phần header -->
    <?php include './layout/header.php'; ?>

    <!-- banner -->
    <div class="banner">
        <h3>Coffee</h3>
        <p>Cà phê là thức uống đơn giản giúp thêm sự tỉnh táo và năng lượng cho ngày mới sảng khoái.</p>
        <a href="store.php" class="more-btn">Mua ngay</a>
    </div>

    <!-- giới thiệu -->
    <div class="about">
        <h1 class="heading">Về Chúng Tôi</h1>
        <div class="row">
            <div class="image">
                <img src="./images/aboutt.jpg">
            </div>
            <div class="content">
                <h3>Điều gì khiến cà phê của chúng tôi đặc biệt ?</h3>
                <p>Cà phê chất lượng cao được nhập khẩu từ những nơi uy tín</p>
                <p>Giá cả phải chăng, cà phê thơm ngon</p>
                <a href="about.php" class="more-btn">Xem thêm</a>
            </div>
        </div>
    </div>
    <!-- menu -->
    <h1 class="heading">Thực đơn</h1>
    <!-- danh mục sản phẩm -->
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <?php
                include 'config.php';
                $record = mysqli_query($con, "SELECT * FROM sanpham WHERE iddm IN (1, 2)");
                $categoryCheck = null;
                // lưu sản phẩm của các danh mục vào mảng
                $productsCategory = [];
                while ($row = mysqli_fetch_array($record)) {
                    // lấy tên danh mục từ bảng danhmuc
                    $categoryQuery = "SELECT tendm FROM danhmuc WHERE id = " . $row['iddm'];
                    $categoryResult = mysqli_query($con, $categoryQuery);
                    $categoryRow = mysqli_fetch_assoc($categoryResult);
                    $categoryName = $categoryRow['tendm'];
                    // tạo mảng sản phẩm theo từng danh mục
                    if (!isset($productsCategory[$categoryName])) {
                        $productsCategory[$categoryName] = [];
                    }
                    $productsCategory[$categoryName][] = $row;
                }

                // hiển thị sản phẩm theo từng danh mục
                foreach ($productsCategory as $categoryName => $products) {
                    echo '<div class="container">';
                    echo '<h2 class="bg-light text-dark text-center p-2 border-bottom">' . $categoryName . '</h2>';
                    echo '<div class="row">';

                    foreach ($products as $product) {
                        $formattedPrice = number_format($product['gia'], 0, '', ',');
                        echo '
                        <div class="col-md-6 col-lg-3 mb-3">
                        <form action="cart.php" method="post">
                            <div class="card m-auto" style="width: 18rem;">
                                <img src="./admin/product/' . $product['img'] . '" class="card-img-top img-fluid" style="height:250px">
                                <div class="card-body text-center">
                                    <h5 class="card-title text-dark fw-bold">' . $product['tensp'] . '</h5>
                                    <p class="card-text">Giá: ' . $formattedPrice . ' VNĐ</p>
                                    <input type="hidden" name="name" value="' . $product['tensp'] . '">
                                    <input type="hidden" name="price" value="' . $product['gia'] . '">
                                    <div class="d-flex justify-content-between">
                                        <input type="hidden" name="quantity" min="1" value="1">
                                        <input type="submit" name="addCart" class="btn btn-danger text-white mt-2" value="Thêm vào giỏ hàng">
                                        <a href="details.php?id=' . $product['id'] . '" class="btn btn-danger text-white mt-2">Chi tiết</a>
                                    </div>
                                </div>
                             </div>
                        </form>
                        </div>';
                    }
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-danger mx-auto d-block mb-3"><a href="store.php" class="text-decoration-none text-white">Cửa Hàng</a></button>
    <!-- phần footer -->
    <?php include './layout/footer.php'; ?>
</body>

</html>