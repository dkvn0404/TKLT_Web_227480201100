<!DOCTYPE html>
<html>
<head>
    <title>Xử lý Ma Trận</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 600px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h2 {
            margin-top: 0;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            box-sizing: border-box;
            font-family: monospace;
            font-size: 14px;
            height: 150px;
        }
        button {
            padding: 10px 20px;
            margin-right: 10px;
            border: none;
            border-radius: 3px;
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 3px;
            background-color: #f9f9f9;
        }
        .result p {
            margin: 5px 0;
            font-family: monospace;
        }
        .matrix-output {
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chương trình Xử lý Ma Trận</h2>
        <form method="post">
            <label for="matrix_input">Nhập ma trận số thực (các số trên cùng hàng cách nhau bởi dấu cách, các hàng cách nhau bởi dấu xuống dòng):</label>
            <textarea id="matrix_input" name="matrix_input" placeholder="Ví dụ:
1.1 2.3 3.1 4.0 5.0
6.2 7.7 8.8 9.5 1.2
4.6 1.9 3.6 8.9 1.5
1.6 1.7 1.8 1.9 2.0"><?php echo isset($_POST['matrix_input']) ? htmlspecialchars($_POST['matrix_input']) : ''; ?></textarea>
            <button type="submit" name="find_max">Tìm số lớn nhất</button>
            <button type="submit" name="find_min">Tìm số nhỏ nhất</button>
            <button type="submit" name="sum_matrix">Tính tổng các số</button>
            <button type="submit" name="print_matrix">In ma trận</button>
        </form>

        <div class="result">
            <?php
            function parseMatrix($matrixString) {
                $rows = explode("\n", trim($matrixString));
                $matrix = [];
                foreach ($rows as $row) {
                    $numbers = explode(" ", trim($row));
                    $matrix[] = array_map('floatval', $numbers);
                }
                return $matrix;
            }

            function findMax($matrix) {
                $max = null;
                foreach ($matrix as $row) {
                    foreach ($row as $value) {
                        if ($max === null || $value > $max) {
                            $max = $value;
                        }
                    }
                }
                return $max;
            }

            function findMin($matrix) {
                $min = null;
                foreach ($matrix as $row) {
                    foreach ($row as $value) {
                        if ($min === null || $value < $min) {
                            $min = $value;
                        }
                    }
                }
                return $min;
            }

            function sumMatrix($matrix) {
                $sum = 0;
                foreach ($matrix as $row) {
                    foreach ($row as $value) {
                        $sum += $value;
                    }
                }
                return $sum;
            }

            function printMatrix($matrix) {
                $output = "";
                foreach ($matrix as $row) {
                    $output .= implode(" ", $row) . "\n";
                }
                return "<pre class='matrix-output'>" . htmlspecialchars($output) . "</pre>";
            }

            if (isset($_POST['matrix_input'])) {
                $matrixString = $_POST['matrix_input'];
                $matrix = parseMatrix($matrixString);

                if (!empty($matrix)) {
                    if (isset($_POST['find_max'])) {
                        $max = findMax($matrix);
                        echo "<p>Số lớn nhất trong ma trận là: <strong>" . htmlspecialchars($max) . "</strong></p>";
                    } elseif (isset($_POST['find_min'])) {
                        $min = findMin($matrix);
                        echo "<p>Số nhỏ nhất trong ma trận là: <strong>" . htmlspecialchars($min) . "</strong></p>";
                    } elseif (isset($_POST['sum_matrix'])) {
                        $sum = sumMatrix($matrix);
                        echo "<p>Tổng các số trong ma trận là: <strong>" . htmlspecialchars($sum) . "</strong></p>";
                    } elseif (isset($_POST['print_matrix'])) {
                        echo "<p>Ma trận đã nhập:</p>";
                        echo printMatrix($matrix);
                    }
                } else {
                    echo "<p>Vui lòng nhập ma trận hợp lệ.</p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>