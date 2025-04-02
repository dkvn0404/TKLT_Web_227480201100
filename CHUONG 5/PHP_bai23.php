<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
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
        .upload-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 400px;
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
        input[type="file"] {
            width: 100%;
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
        .error {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="upload-container">
        <h2>Upload File lên Server</h2>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="file_upload">Chọn file để upload:</label>
                <input type="file" id="file_upload" name="file_upload" required>
            </div>
            <div class="buttons">
                <button type="submit">Upload</button>
            </div>
        </form>

        <div class="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file_upload"])) {
                // Thư mục để lưu file upload
                $uploadDir = "Tailieu/";

                // Tạo thư mục nếu nó không tồn tại
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                // Lấy thông tin file upload
                $fileName = basename($_FILES["file_upload"]["name"]);
                $targetFilePath = $uploadDir . $fileName;
                $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
                $fileSize = $_FILES["file_upload"]["size"];
                $fileTmpName = $_FILES["file_upload"]["tmp_name"];
                $uploadOk = 1;
                $error = "";

                // Kiểm tra nếu file đã tồn tại
                if (file_exists($targetFilePath)) {
                    $uploadOk = 0;
                    $error = "File này đã tồn tại.";
                }

                // Giới hạn kích thước file (ví dụ: 5MB)
                if ($fileSize > 5 * 1024 * 1024) {
                    $uploadOk = 0;
                    $error = "Kích thước file quá lớn.";
                }

                // Chỉ cho phép một số định dạng file nhất định (tùy chọn)
                $allowedTypes = array("jpg", "jpeg", "png", "gif", "pdf", "doc", "docx");
                if (!in_array(strtolower($fileType), $allowedTypes) && !empty($_FILES["file_upload"]["name"])) {
                    $uploadOk = 0;
                    $error = "Chỉ cho phép các định dạng: " . implode(", ", $allowedTypes);
                }

                // Kiểm tra nếu $uploadOk là 0 có lỗi xảy ra
                if ($uploadOk == 0) {
                    echo '<p class="error">Lỗi upload file: ' . htmlspecialchars($error) . '</p>';
                } else {
                    // Nếu mọi thứ đều ổn, thử upload file
                    if (move_uploaded_file($fileTmpName, $targetFilePath)) {
                        echo '<p style="color: green;">File đã được upload thành công vào thư mục Tailieu.</p>';
                    } else {
                        echo '<p class="error">Có lỗi xảy ra khi upload file.</p>';
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>