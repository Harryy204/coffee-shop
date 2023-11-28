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
    <title>Chi Tiết Sản Phẩm</title>
</head>

<body>
    <!-- phần header -->
    <?php include './layout/header.php' ?>
    <!-- hiển thị danh sách bình luận -->
    <?php
    include 'config.php';

    // session_start();

    // kiểm tra xem có id sản phẩm được truyền qua url không
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // kiểm tra khi người dùng gửi biểu mẫu bình luận
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // kiểm tra xem người dùng đã đăng nhập hay chưa
            if (isset($_SESSION['user_id'])) {
                $comment_text = mysqli_real_escape_string($con, $_POST['comment']);
                $postdate = date("Y-m-d");
                $user_id = $_SESSION['user_id'];

                $insertQuery = "INSERT INTO binhluan (idnd, idsp, noidung, ngaybl) VALUES ('$user_id', '$id', '$comment_text', '$postdate')";

                if (mysqli_query($con, $insertQuery)) {
                    header("Location: details.php?id=$id");
                    exit();
                } else {
                    echo "Lỗi: " . mysqli_error($con);
                }
            }
        }
    }
    mysqli_close($con);
    ?>

    <?php
    include 'config.php';

    // kiểm tra xem có ID sản phẩm được truyền qua URL không
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // truy vấn cơ sở dữ liệu để lấy thông tin sản phẩm
        $query = "SELECT * FROM sanpham WHERE id = '$id'";
        $result = mysqli_query($con, $query);

        // kiểm tra xem có kết quả trả về hay không
        if (mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
    ?>

            <!-- hiển thị thông tin chi tiết sản phẩm -->
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <img src="./admin/product/<?php echo $product['img']; ?>" alt="Product Image" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <h2 class="bg-light text-dark text-center p-2 border-bottom"><?php echo $product['tensp']; ?></h2>
                        <h3>Giá:<br> <?php echo number_format($product['gia'], 0, ',', '.'); ?> VNĐ</h3>
                        <h3>Số lượng:<br> <?php echo $product['soluong']; ?></h3>
                        <h3>Mô tả sản phẩm: <br></h3>
                        <?php echo $product['mota']; ?>
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="name" value="<?php echo $product['tensp']; ?>">
                            <input type="hidden" name="price" value="<?php echo $product['gia']; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <div class="d-flex justify-content-center">
                                <input type="submit" name="addCart" class="btn btn-outline-danger mt-2 mx-1" value="Thêm vào giỏ hàng">
                                <!-- <a href="checkout.php" class="btn btn-outline-success mt-2 mx-1">Mua Ngay</a> -->
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <!-- ảnh thumbnail -->
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-12 text-left">
                        <a href="./admin/product/<?php echo $product['img']; ?>">
                            <img src="./admin/product/<?php echo $product['img']; ?>" alt="Thumbnail Image" class="img-thumbnail mt-2" width="70px">
                        </a>
                    </div>
                </div>
            </div>



            <div class="container mt-5">
                <h4>BÌNH LUẬN</h4>
                <hr>
                </hr>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        // truy vấn cơ sở dữ liệu để lấy bình luận cho sản phẩm cụ thể
                        $commentQuery = "SELECT * FROM binhluan WHERE idsp = '$id' ORDER BY ngaybl DESC";
                        $commentResult = mysqli_query($con, $commentQuery);
                        if (mysqli_num_rows($commentResult) > 0) {
                            while ($comment = mysqli_fetch_assoc($commentResult)) {
                                $user_id = $comment['idnd'];
                                $userQuery = "SELECT tennd FROM nguoidung WHERE id = $user_id";
                                $userResult = mysqli_query($con, $userQuery);
                                $commentDate = date_create($comment['ngaybl']);
                                echo "<div class='comment'>";
                                if ($userRow = mysqli_fetch_assoc($userResult)) {
                                    $username = $userRow['tennd'];
                                    echo "<p><strong>{$username}</strong> - {$commentDate->format('d/m/Y')}</p>";
                                    echo "<p>{$comment['noidung']}</p>";
                                    echo "</div>";
                                }
                            }
                        } else {
                            echo "<p>Chưa có bình luận nào cho sản phẩm này.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- thêm bình luận -->
            <div class="container mt-5">
                <h4>Thêm bình luận:</h4>
                <?php
                // kiểm tra xem người dùng đã đăng nhập hay chưa
                if (isset($_SESSION['user'])) {
                ?>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="name">Tên:</label>
                            <input type="text" class="form-control" name="name" value="<?php echo isset($_SESSION['user']) ? $_SESSION['user'] : ''; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="comment">Nội dung bình luận:</label>
                            <textarea class="form-control" name="comment" rows="4" placeholder="Viết bình luận..." required></textarea>
                        </div>
                        <button type="submit" class="mt-3 btn btn-primary">Gửi</button>
                    </form>
                <?php
                } else {
                    echo "<p>Vui lòng <a href='./user/login/login.php'>đăng nhập</a> để thêm bình luận</p>";
                }
                ?>
            </div>


            <!-- hiển thị danh sách sản phẩm liên quan -->
            <div class="container mt-5">
                <h3>Sản phẩm liên quan</h3>
                <div class="row">
                    <?php
                    // truy vấn cơ sở dữ liệu để lấy các sản phẩm liên quan
                    $relatedQuery = "SELECT * FROM sanpham WHERE iddm = '$product[iddm]' AND id != '$id' LIMIT 4";
                    $relatedResult = mysqli_query($con, $relatedQuery);

                    // kiểm tra xem có kết quả trả về hay không
                    if (mysqli_num_rows($relatedResult) > 0) {
                        while ($relatedProduct = mysqli_fetch_assoc($relatedResult)) {
                    ?>
                            <div class="col-md-3">
                                <a href="details.php?id=<?php echo $relatedProduct['id']; ?>" class="text-decoration-none">
                                    <div class="card">
                                        <img src="./admin/product/<?php echo $relatedProduct['img']; ?>" class="card-img-top" alt="Product Image">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $relatedProduct['tensp']; ?></h5>
                                            <p class="card-text"><?php echo number_format($relatedProduct['gia'], 0, ',', '.'); ?> VNĐ</p>

                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php
                        }
                    } else {
                        echo "Không có sản phẩm liên quan.";
                    }

                    mysqli_free_result($relatedResult);
                    ?>
                </div>
            </div>
    <?php
        } else {
            echo "Không tìm thấy sản phẩm.";
        }

        mysqli_free_result($result);
        mysqli_close($con);
    } else {
        echo "Không tìm thấy sản phẩm.";
    }
    ?>
    <!-- phần footer -->
    <?php include './layout/footer.php'; ?>
</body>

</html>