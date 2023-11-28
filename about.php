<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Giới Thiệu</title>
    <link rel="stylesheet" href="./css/about.css">
</head>

<body>
    <!-- header -->
    <?php include './layout/header.php' ?>
    <!-- nội dung -->
<div class="background">
    <div class="overlay"></div>
    <section class="content-section container text-white">
        <div class="row">
            <div class="col-lg-6">
                <h2>1.Nguồn Gốc</h2>
                <p>
                    Được thành lập vào năm 2023.
                    Coffee Shop là nơi bạn có thể thư giãn và thưởng thức cà phê tuyệt vời. Chúng tôi tự hào cung cấp cà phê chất lượng cao và phục vụ bạn mỗi ngày.
                </p>
                <a href="./blog/history.php"><button type="button" class="btn btn-outline-danger">Xem chi tiết</button></a>
            </div>
            <div class="col-lg-6">
                <img src="./images/shop.jpg" class="img-fluid">
            </div>
        </div>
    </section>

    <section class="content-section container text-white">
        <div class="row">
            <div class="col-lg-6">
                <img src="./images/nguyenlieu.jpg" class="img-fluid">
            </div>
            <div class="col-lg-6">
                <h2>2.Nguồn Nguyên Liệu</h2>
                <p>
                    Được chế biến từ cà phê Robusta nguyên chất có mùi thơm socola đặc trưng mang đến cho người dùng trải nghiệm chuẩn mực của cà phê thứ thiệt bởi vị đắng đậm đà, thơm nhẹ, hàm lượng caffeine vừa đủ.
                </p>
                <a href="./blog/origin.php"><button type="button" class="btn btn-outline-danger">Xem chi tiết</button></a>
            </div>
        </div>
    </section>

    <section class="content-section container text-white">
        <div class="row">
            <div class="col-lg-6">
                <h2>3.Sứ Mệnh</h2>
                <p>
                    Sứ mệnh của chúng tôi là khơi nguồn cảm hứng và nuôi dưỡng tinh thần, một cốc cà phê vào buổi sáng sẽ giúp bạn có một ngày học tập và làm việc tràn đầy năng lượng.
                </p>
                <a href="./blog/mission.php"><button type="button" class="btn btn-outline-danger">Xem chi tiết</button></a>
            </div>
            <div class="col-lg-6">
                <img src="./images/sumenh.jpg" class="img-fluid">
            </div>
        </div>
    </section>

    <section class="image-gallery container text-white"> 
        <h2>Hình ảnh cửa hàng</h2>
        <div class="row">
            <div class="col-md-4">
                <img src="./images/shop1.jpg" class="img-fluid">
            </div>
            <div class="col-md-4">
                <img src="./images/shop2.jpg" class="img-fluid">
            </div>
            <div class="col-md-4">
                <img src="./images/shop3.jpg" class="img-fluid">
            </div>
        </div>
    </section>
</div>
    <!-- footer -->
    <?php include './layout/footer.php'?>
</body>

</html>
