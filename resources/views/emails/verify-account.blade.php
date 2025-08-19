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
        .container_text {
        background: #fff;
        margin: 30px auto;
        padding: 40px 50px;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 6px 18px rgba(0,0,0,0.05);
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
            background-color:rgb(9, 151, 213);
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
             background-color:rgb(9, 151, 213);;
        }
        .logo {
        text-align: center;
        margin-bottom: 30px;
        }
        .logo img {
            max-height: 90px;
        }
       .footer {
        font-size: 13.5px;
        color: #64748b;
        text-align: center;
        border-top: 1px solid #e2e8f0;
        padding-top: 20px;
        margin-top: 30px;
        line-height: 1.7;
    }
    </style>
</head>
<body>
    <div class="container_text">
          <!-- Logo -->
    <div class="logo" style="background-color: #ffffff;">
        <img src="https://apii.hungthinhsecurity.com/storage/app/public/uploads/logo-vietnam-tickets.png" alt="Vietnam Tickets Logo">
    </div>

    <p> Bạn nhận được email này vì chúng tôi đã nhận được yêu cầu xác nhận email cho tài khoản của bạn.</p>
    <p>Liên kết  yêu cầu xác nhận email này sẽ hết hạn trong 60 phút.</p>
    <p>Nếu bạn không yêu cầu  yêu cầu xác nhận email , bạn vui lòng bỏ qua email này.</p>
    <p>Trân trọng,</p>
    <p>VietNam Tickets</p>
    <a href="{{ $url }}" class="button" style="color:white">Xác nhận tài khoản</a>
    <div class="footer">
        <p><strong>Vietnam Tickets</strong> - Đại lý vé máy bay nội địa & quốc tế uy tín</p>
        <p>Trụ sở: 69 Võ Thị Sáu, P.6, Q.3, TP.HCM | Chi nhánh: 173 Nguyễn Thị Minh Khai, Q.1, TP.HCM</p>
        <p>Điện thoại: 1900 3173 | (028) 3936 2020 | Email: vietnamtickets16@gmail.com</p>
        <p>Website: <a href="https://vietnam-tickets.com">vietnam-tickets.com</a></p>
    </div>
    </div>
    
</body>
</html>
