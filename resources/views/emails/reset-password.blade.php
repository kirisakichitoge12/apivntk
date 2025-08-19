<!DOCTYPE html>
<html lang="vi-VN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận tài khoản</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            max-width: 150px;
            margin-bottom: 10px;
        }
        h1 {
            text-align: center;
            color: #333333;
        }
        p {
            font-size: 16px;
            line-height: 1.5;
            color: #555555;
        }
        .button {
            display: inline-block;
            background-color: rgb(239, 143, 143);
            color: white;
            padding: 14px 20px;
            text-align: center;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            margin: 20px 0;
            width: 100%;
            box-sizing: border-box;
        }
        .button:hover {
            background-color: rgb(220, 120, 120);
        }
        .footer {
            text-align: center;
            font-size: 14px;
            color: #777777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Header có logo -->
    <div class="header">
        <img src="https://yourdomain.com/logo.png" alt="Huy Thanh Jewelry">
        <h1>Xác nhận tài khoản</h1>
    </div>

    <p>Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu xác nhận email cho tài khoản của bạn.</p>
    <p>Liên kết xác nhận email này sẽ hết hạn trong 60 phút.</p>
    <p>Nếu bạn không yêu cầu xác nhận email, bạn vui lòng bỏ qua email này.</p>
    <p>Trân trọng,</p>
    <p><b>Huy Thanh Jewelry</b></p>

    <a href="{{ $url }}" class="button">Xác nhận tài khoản</a>

    <div class="footer">
        © 2025 Huy Thanh Jewelry. Mọi quyền được bảo lưu.
    </div>
</div>
</body>
</html>
