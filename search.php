<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/header.css">
    <title>Thanh Toán</title>
</head>

<body>
    <!-- phần header -->
    <?php include './layout/header.php'; ?>
    <?php
    include 'config.php';
    if (isset($_GET['searchPro'])) {
    $searchTerm = $_GET['searchPro'];

    // truy vấn cơ sở dữ liệu để tìm kiếm sản phẩm
    $query = "SELECT * FROM sanpham WHERE tensp LIKE '%$searchTerm%'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        // hiển thị kết quả tìm kiếm
        echo "<h2 class='bg-light text-dark text-center p-2 border-bottom'>Sản phẩm tìm kiếm: '$searchTerm'</h2>";
        echo "<div class='row'>";
        while ($product = mysqli_fetch_assoc($result)) {
            echo "<div class='col-md-6 col-lg-3 mb-3'>";
            echo "<div class='card m-auto text-center' style='width: 18rem;''>";
            echo "<img src='./admin/product/{$product['img']}' alt='{$product['tensp']}' class='img-fluid' style='height:250px'>";
            echo "<h5 class='fw-bold mt-3'>{$product['tensp']}</h5>";
            echo "<p>Giá: " . number_format($product['gia'], 0, ',', '.') . " VNĐ</p>";
            echo "<a href='details.php?id={$product['id']}' class='btn btn-danger'>Xem chi tiết</a>";
            echo "</div>";
            echo "</div>";
        }
        echo "</div>";
    } else {
        echo "<h2 class='bg-light text-dark text-center p-2 border-bottom'>Sản phẩm tìm kiếm không tồn tại<br>
        Bạn có thể xem các sản phẩm khác<br> 
        <a href='store.php' style='text-decoration: none'>Tại đây</a></h2>";

        }
    }
    ?> 
    <!-- phần footer -->
    <?php include './layout/footer.php'; ?>
</body>

</html>