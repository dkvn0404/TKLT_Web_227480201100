<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập thành viên</title>
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
        input[type="text"],
        input[type="password"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        .password-group {
            position: relative;
        }
        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #777;
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
        .signup-link {
            text-align: center;
            margin-top: 15px;
            color: #555;
        }
        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }
        .signup-link a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập thành viên</h2>
        <form method="post">
            <div class="form-group">
                <label for="email">Email name</label>
                <input type="text" id="email" name="email" placeholder="@blu.edu.vn" required>
            </div>
            <div class="form-group password-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <span class="password-toggle" onclick="togglePasswordVisibility()">Hiện</span>
            </div>
            <div class="form-group">
                <label for="maso">Mã số</label>
                <input type="text" id="maso" name="maso" required>
            </div>
            <div class="buttons">
                <button type="submit">Đăng nhập</button>
            </div>
        </form>
        <div class="signup-link">
            <a href="#">Đăng ký</a>
        </div>
        <div class="result">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $maso = $_POST['maso'];
                $loginSuccess = false;
                $errorMessage = "";
                $cookieExpiry = time() + (3 * 60); // 3 phút

                // Đọc dữ liệu từ users.ini (giả định file này tồn tại và có định dạng đúng)
                $users = parse_ini_file('users.ini', true);

                if ($users && isset($users[$email])) {
                    if ($users[$email]['password'] === $password && $users[$email]['maso'] === $maso) {
                        $loginSuccess = true;
                        setcookie('user_email', $email, $cookieExpiry, '/');
                        setcookie('login_expiry', $cookieExpiry, $cookieExpiry, '/');
                        echo '<p style="color: green;">Đăng nhập thành công!</p>';
                        header("Refresh: 3; url=member_area.php"); // Chuyển hướng sau 3 giây
                        exit();
                    } else {
                        $errorMessage = "Sai mật khẩu hoặc mã số.";
                    }
                } else {
                    $errorMessage = "Email không tồn tại.";
                }

                if (!$loginSuccess && !empty($errorMessage)) {
                    echo '<p class="error-message">' . htmlspecialchars($errorMessage) . '</p>';
                }
            }

            // Kiểm tra cookie để tự động đăng xuất sau 3 phút (nếu trang được tải lại)
            if (isset($_COOKIE['login_expiry']) && time() > $_COOKIE['login_expiry']) {
                setcookie('user_email', '', time() - 3600, '/');
                setcookie('login_expiry', '', time() - 3600, '/');
                echo '<p class="error-message">Phiên đăng nhập đã hết hạn. Vui lòng đăng nhập lại.</p>';
            } elseif (isset($_COOKIE['user_email'])) {
                echo '<p style="color: green;">Bạn đang đăng nhập với email: ' . htmlspecialchars($_COOKIE['user_email']) . '</p>';
                echo '<p><a href="logout.php" style="color: red; text-decoration: none;">Đăng xuất</a></p>';
            }
            ?>
        </div>
    </div>

    <script>
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.querySelector('.password-toggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.textContent = 'Ẩn';
            } else {
                passwordInput.type = 'password';
                toggleButton.textContent = 'Hiện';
            }
        }
    </script>
</body>
</html>