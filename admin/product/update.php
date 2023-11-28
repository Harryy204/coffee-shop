<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">

</head>
<?php 
if (isset($_POST['update'])) {
    include '../../config.php';

    $id = $_POST['id'];
    $product_name = $_POST['tensp'];
    $product_price = $_POST['gia'];
    $product_details = $_POST['mota'];
    $category_id = $_POST['category_id'];
    $product_quantity = $_POST['soluong'];

    // upload hình ảnh
    $image_name = $_FILES['img']['name'];
    $image_tmp = $_FILES['img']['tmp_name'];
    $image_des = "uploadimage/" . $image_name;
    // di chuyển hình ảnh vào thư mục lưu trữ
    move_uploaded_file($image_tmp, $image_des);

    $updateQuery = "UPDATE `sanpham` SET `tensp`='$product_name', `gia`='$product_price', `img`='$image_des', `iddm`='$category_id', `mota`='$product_details', `soluong`='$product_quantity' WHERE id = '$id'";
    
    mysqli_query($con, $updateQuery);

    header("location: index.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    include '../../config.php';
    $record = mysqli_query($con, "SELECT * FROM `sanpham` WHERE id = '$id'");
    $data = mysqli_fetch_array($record);
} else {
    header("location: index.php");
    exit;
}

?>
<body>
    <button class="bg-success fw-bold"><a href="index.php" class=" text-decoration-none pe-2 text-white"><i class="fa-sharp fa-solid fa-circle-left" style="margin: 5px;"></i>Trang Chi Tiết</a></button>
    <div class="container">
        <div class="row">
            <div class="col-md-5 m-auto border mt-3">
                <!-- tạo form thêm sản phẩm -->
                <form action="update.php" method="POST" enctype="multipart/form-data">
                    <p class="text-center fw-bold fs-3 text-success">Cập nhật sản phẩm</p>

                    <div class="mb-3">
                        <label class="form-label">Nhập tên sản phẩm:</label>
                        <input type="text" value="<?php echo $data['tensp'] ?>" name="tensp" class="form-control ml-100" placeholder="Nhập tên sản phẩm">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nhập giá sản phẩm:</label>
                        <input type="text" value="<?php echo $data['gia'] ?>" name="gia" class="form-control" placeholder="Nhập giá">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Thêm ảnh sản phẩm:</label>
                        <input type="file" name="img" class="form-control"><br>
                        <img src="<?php echo $data['img'] ?>" alt="" style="height: 200px;">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nhập mô tả sản phẩm:</label>
                        <input type="text" value="<?php echo $data['mota'] ?>" name="mota" class="form-control ml-100" placeholder="Nhập mô tả sản phẩm">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nhập số lượng sản phẩm:</label>
                        <input type="text" value="<?php echo $data['soluong'] ?>" name="soluong" class="form-control ml-100" placeholder="Nhập mô tả sản phẩm">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Chọn danh mục:</label>
                        <select class="form-select" name="category_id">
                            <?php
                            include '../../config.php';
                            $categoryQuery = "SELECT * FROM danhmuc";
                            $categoryResult = mysqli_query($con, $categoryQuery);
                            while ($category = mysqli_fetch_array($categoryResult)) {
                                echo '<option value="' . $category['id'] . '">' . $category['tendm'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $data['id'] ?>">
                    <button name="update" class="bg-danger fs-5 fw-bold mb-3 form-control text-white">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>


</body>

</html>