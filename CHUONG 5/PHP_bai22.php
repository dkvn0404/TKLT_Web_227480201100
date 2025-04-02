<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập khách hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .buttons {
            text-align: center;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #eee;
            border-radius: 4px;
            color: #777;
            font-size: 14px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập khách hàng</h2>
        <form method="post">
            <div class="form-group">
                <label for="ten_khach_hang">Tên khách hàng</label>
                <input type="text" id="ten_khach_hang" name="ten_khach_hang" required>
            </div>
            <div class="form-group">
                <label for="so_dien_thoai">Số điện thoại</label>
                <input type="text" id="so_dien_thoai" name="so_dien_thoai" required>
            </div>
            <div class="buttons">
                <button type="submit">Đăng nhập</button>
            </div>
        </form>
        <?php
        $thoiGianTonTaiCookie = 600; // 10 phút

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tenKhachHang = $_POST['ten_khach_hang'];
            $soDienThoai = $_POST['so_dien_thoai'];

            setcookie('ten_khach_hang', $tenKhachHang, time() + $thoiGianTonTaiCookie, '/');
            setcookie('so_dien_thoai', $soDienThoai, time() + $thoiGianTonTaiCookie, '/');

            echo '<div class="result">';
            echo '<p style="color: green;">Đăng nhập thành công! Thông tin đã được lưu trong cookie.</p>';
            echo '</div>';
        }

        if (isset($_COOKIE['ten_khach_hang']) && isset($_COOKIE['so_dien_thoai'])) {
            echo '<div class="result">';
            echo '<p><strong>Thông tin đã lưu (Cookie):</strong></p>';
            echo '<p>Tên khách hàng: ' . htmlspecialchars($_COOKIE['ten_khach_hang']) . '</p>';
            echo '<p>Số điện thoại: ' . htmlspecialchars($_COOKIE['so_dien_thoai']) . '</p>';
            echo '</div>';
        }
        ?>
        <div style="text-align: center; margin-top: 15px;">
            <a href="?logout=true" style="color: red; text-decoration: none;">Đăng xuất và xóa cookie</a>
        </div>
        <?php
        if (isset($_GET['logout'])) {
            setcookie('ten_khach_hang', '', time() - 3600, '/');
            setcookie('so_dien_thoai', '', time() - 3600, '/');
            echo '<div class="result">';
            echo '<p style="color: red;">Đã đăng xuất và xóa cookie thành công.</p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>