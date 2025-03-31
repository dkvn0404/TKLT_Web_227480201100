<!DOCTYPE html>
<html>
<head>
    <title>TÍNH USCLN VÀ BSCNN</title>
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
        .container {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 350px; /* Điều chỉnh độ rộng container */
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-size: 14px;
        }
        input[type="number"] {
            width: calc(100% - 12px);
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 14px;
        }
        .result-group {
            margin-bottom: 15px;
        }
        .result-input {
            width: calc(100% - 12px);
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
            font-size: 14px;
            background-color: #f9f9f9;
            color: #333;
        }
        .buttons {
            text-align: center;
        }
        button {
            padding: 10px 20px;
            margin: 0 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            cursor: pointer;
            font-size: 14px;
            background-color: #f9f9f9;
            color: #333;
        }
        button:hover {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>TÍNH USCLN VÀ BSCNN</h2>
        <hr>
        <form method="post">
            <div class="form-group">
                <label for="so_thu_1"><b>Số thứ 1 :</b></label>
                <input type="number" id="so_thu_1" name="so_thu_1" required>
            </div>
            <div class="form-group">
                <label for="so_thu_2"><b>Số thứ 2 :</b></label>
                <input type="number" id="so_thu_2" name="so_thu_2" required>
            </div>
            <div class="form-group">
                <label for="ket_qua"><b>Kết quả :</b></label>
                <input type="text" id="ket_qua" class="result-input" value="<?php
                    function gcd($a, $b) {
                        while ($b != 0) {
                            $temp = $b;
                            $b = $a % $b;
                            $a = $temp;
                        }
                        return $a;
                    }

                    function lcm($a, $b) {
                        return ($a * $b) / gcd($a, $b);
                    }

                    if (isset($_POST['uscln'])) {
                        $so_thu_1 = $_POST['so_thu_1'];
                        $so_thu_2 = $_POST['so_thu_2'];
                        echo "USCLN: " . gcd($so_thu_1, $so_thu_2);
                    } elseif (isset($_POST['bscnn'])) {
                        $so_thu_1 = $_POST['so_thu_1'];
                        $so_thu_2 = $_POST['so_thu_2'];
                        echo "BSCNN: " . lcm($so_thu_1, $so_thu_2);
                    }
                ?>" readonly>
            </div>
            <div class="buttons">
                <button type="submit" name="uscln">USCLN</button>
                <button type="submit" name="bscnn">BSCNN</button>
            </div>
        </form>

    </div>
</body>
</html>