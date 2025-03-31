<!DOCTYPE html>
<html>
<head>
    <title>Bảng cửu chương 1 đến 10</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .bang-cuu-chuong {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }
        .cot {
            width: 150px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        .cot h2 {
            text-align: center;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .cot p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <h1>Bảng cửu chương từ 1 đến 10</h1>

    <div class="bang-cuu-chuong">
        <?php
        for ($i = 1; $i <= 10; $i++) {
            echo '<div class="cot">';
            echo '<h2>Bảng cửu chương ' . $i . '</h2>';
            for ($j = 1; $j <= 10; $j++) {
                echo '<p>' . $i . ' x ' . $j . ' = ' . ($i * $j) . '</p>';
            }
            echo '</div>';
        }
        ?>
    </div>

</body>
</html>