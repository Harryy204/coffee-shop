<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Liên Hệ</title>
    <link rel="stylesheet" href="./css/contact.css">
</head>

<body>
    <!-- header -->
    <?php include './layout/header.php' ?>

    <!-- liên hệ -->
    <div class="background">
        <h2 class="bg-light text-dark text-center p-2 border-bottom">Liên Hệ Với Chúng Tôi</h2>
        <section class="contact-section container">
            <div class="row">
                <div class="col-md-6">
                    <img src="images/contact-img.svg" class="img-fluid mb-3">
                </div>
                <div class="col-md-6">
                    <form action="" method="post" class="mt-5">
                        <div class="mb-3">
                            <input type="text" name="name" class="form-control p-2" placeholder="Nhập tên của bạn" required maxlength="50">
                        </div>
                        <div class="mb-3">
                            <input type="number" name="number" class="form-control p-2" placeholder="Nhập số điện thoại của bạn" required maxlength="10">
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control p-2" placeholder="Nhập địa chỉ email của bạn" required maxlength="50">
                        </div>
                        <div class="mb-3">
                            <textarea name="msg" class="form-control p-2" required placeholder="Nhập phản hồi của bạn..." maxlength="500" rows="5"></textarea>
                        </div>
                        <button type="submit" name="send" class="btn btn-primary">Gửi tin nhắn</button>
                    </form>
                </div>
            </div>
            <hr></hr>
            <div class="form">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box bg-white p-3">
                            <img src="images/email-icon.png" alt="">
                            <h3>Email của chúng tôi</h3>
                            <a href="#" class="text-decoration-none text-dark">coffee@gmail.com</a><br>
                            <a href="#" class="text-decoration-none text-dark">coffee@shop.com</a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box bg-white p-3">
                            <img src="images/clock-icon.png" alt="">
                            <h3>Giờ mở cửa</h3>
                            <p class="text-black">Từ 6h-23h30</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box bg-white p-3">
                            <img src="images/map-icon.png" alt="">
                            <h3>Địa chỉ quán</h3>
                            <a href="#" class="text-decoration-none text-dark">123, Đà Nẵng</a><br>
                            <a href="#" class="text-decoration-none text-dark">234, Đà Nẵng</a>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="box bg-white p-3">
                            <img src="images/phone-icon.png" alt="">
                            <h3>Điện thoại</h3>
                            <a href="#" class="text-decoration-none text-dark">0123.456.788</a><br>
                            <a href="#" class="text-decoration-none text-dark">0123.456.789</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </section>
    </div>
    <!-- footer -->
    <?php include './layout/footer.php' ?>
</body>

</html>