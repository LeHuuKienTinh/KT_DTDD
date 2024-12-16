<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác thực tài khoản KT Mobile</title>
</head>
<body>
    <h1>Xác thực tài khoản KT Mobile</h1>
    <p>Xin chào {{ $user->name }},</p>
    <p>Cảm ơn bạn đã đăng ký tài khoản trên KT Mobile. Để hoàn tất việc đăng ký, vui lòng nhấn vào nút dưới đây để xác thực tài khoản của bạn.</p>
    <a href="{{ $verificationUrl }}" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Xác thực tài khoản</a>
    <p>Chúc bạn một ngày tốt lành!</p>
</body>
</html>
