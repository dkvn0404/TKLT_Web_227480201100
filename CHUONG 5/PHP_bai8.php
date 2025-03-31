<!DOCTYPE html>
<html>
<head>
    <title>Danh sách năm (1900 - Hiện tại)</title>
</head>
<body>

    <label for="nam">Chọn năm:</label>
    <select id="nam" name="nam">
        <?php
        // Lấy năm hiện tại
        $namHienTai = date("Y");

        // Vòng lặp từ năm 1900 đến năm hiện tại
        for ($nam = 1900; $nam <= $namHienTai; $nam++) {
            echo '<option value="' . $nam . '">' . $nam . '</option>';
        }
        ?>
    </select>

</body>
</html>