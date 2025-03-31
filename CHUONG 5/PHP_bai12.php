<!DOCTYPE html>
<html>
<head>
    <title>Bàn cờ vua</title>
    <style>
        .chessboard {
            width: 400px; /* Điều chỉnh kích thước bàn cờ */
            height: 400px;
            border: 1px solid black;
            margin: 20px auto;
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            grid-template-rows: repeat(8, 1fr);
        }

        .square {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px; /* Tùy chỉnh kích thước quân cờ (nếu có) */
        }

        .white {
            background-color:rgb(141, 60, 60);
        }

        .black {
            background-color:rgb(100, 200, 230);
        }
    </style>
</head>
<body>

    <div class="chessboard">
        <?php
        for ($row = 0; $row < 8; $row++) {
            for ($col = 0; $col < 8; $col++) {
                $isWhite = ($row + $col) % 2 == 0;
                $colorClass = $isWhite ? 'white' : 'black';
                echo '<div class="square ' . $colorClass . '"></div>';
            }
        }
        ?>
    </div>

</body>
</html>