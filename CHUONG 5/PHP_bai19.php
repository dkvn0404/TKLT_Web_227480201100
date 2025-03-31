<!DOCTYPE html>
<html>
<head>
    <title>Chào mừng!</title>
</head>
<body>

<?php

// Thời gian cookie tồn tại (10 phút = 600 giây)
$thoiGianTonTaiCookie = 600;

if (!isset($_COOKIE['thoiGianTruyCap'])) {
    // Lần truy cập đầu tiên hoặc cookie đã hết hạn
    echo "Chào bạn lần đầu tiên đến với trang web này!<br>";

    // Thiết lập cookie lưu thời gian truy cập hiện tại
    setcookie('thoiGianTruyCap', time(), time() + $thoiGianTonTaiCookie);
} else {
    // Đã có cookie tồn tại
    echo "Chào bạn,<br>";

    // Lấy thời gian truy cập gần đây nhất từ cookie
    $thoiGianTruyCapCu = $_COOKIE['thoiGianTruyCap'];

    // Định dạng thời gian để hiển thị
    $dinhDangThoiGian = 'd/m/Y H:i:s';
    $thoiGianDaDinhDang = date($dinhDangThoiGian, $thoiGianTruyCapCu);

    echo "Thời gian truy cập gần đây nhất của bạn là: " . $thoiGianDaDinhDang . "<br>";

    // Cập nhật cookie với thời gian truy cập hiện tại
    setcookie('thoiGianTruyCap', time(), time() + $thoiGianTonTaiCookie);
}

?>

</body>
</html>