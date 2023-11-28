<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Người Dùng</title>

    <!-- bootstrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- fontawsome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" crossorigin="anonymous">
</head>

<body>
    <?php
    session_start();
    if (!$_SESSION['admin']) {
        header("location: login/login.php");
    }
    include '../config.php';
    $record = mysqli_query($con, "SELECT * FROM `nguoidung`");
    $id_count = 1;
    ?>
    <!-- header -->
    <nav class="navbar bg-dark">
        <div class="container-fluid text-white">
            <a href="index.php" class="text-decoration-none">
                <h4 class="navbar-brand fw-bold text-white" style="margin: 0;">COFFEE</h4>
            </a>
            <span>
                <i class="fa-solid fa-user-shield"></i>
                Xin chào, <?php echo $_SESSION['admin']; ?>|
                <i class="fas fa-sign-out-alt"></i>
                <a href="../user/login/logout.php" class="text-decoration-none text-white">Đăng xuất</a>|
                <a href="../index.php" class="text-decoration-none text-white">Khách truy cập</a>
            </span>
        </div>
    </nav>
    <button class="bg-success fw-bold"><a href="index.php" class=" text-decoration-none pe-2 text-white"><i class="fa-sharp fa-solid fa-circle-left" style="margin: 5px;"></i>Trang Quản Lý</a></button>
    <h1 class=" text-center text-success">Quản Lý Thành Viên</h1>
    <div class="container mt-5">
        <table class="table table-bordered">
            <thead class="text-center">
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số Điện Thoại</th>
                    <th>Vai Trò</th>
                    <th>Xóa</th>
                </tr>
            </thead>
            <tbody class="text-center">
                <?php
                while ($row = mysqli_fetch_array($record)) {
                    echo '
                <tr>
                    <td>' . $id_count . '</td>
                    <td>' . $row['tennd'] . '</td>
                    <td>' . $row['email'] . '</td>
                    <td>' . $row['sdt'] . '</td>
                    <td>
                        <form action="user_update.php" method="POST">
                            <input type="hidden" name="user_id" value="' . $row['id'] . '">
                            <select class="form-select" name="new_role" style="width: 100px; float: left; margin-left: 50px;">
                                <option value="user" ' . ($row['role'] === 'user' ? 'selected' : '') . '>User</option>
                                <option value="admin" ' . ($row['role'] === 'admin' ? 'selected' : '') . '>Admin</option>
                            </select>
                            <input type="submit" name="user_update" class="btn btn-outline-success" value="Cập Nhật">
                        </form>
                    </td>
                    <td>';
                    echo '<a onclick="return confirm(\'Bạn có chắc chắn muốn xóa ' . $row['tennd'] . ' không?\')"
                    href="userdelete.php?id=' . $row['id'] . '" class="btn btn-outline-danger">Xóa</a>';

                    echo '</td>
                </tr>';
                    $id_count++;
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>