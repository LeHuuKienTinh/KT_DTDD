<!-- resources/views/verification/success.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác Thực Thành Công</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Tài Khoản Của Bạn Đã Được Xác Thực Thành Công!</h4>
            <p>Chúc mừng {{ $user->name }}! Cảm ơn bạn đã xác thực email của mình. Bây giờ bạn có thể đăng nhập vào hệ thống.</p>
            <hr>
            <p class="mb-0">Chúc bạn một ngày tuyệt vời!</p>
        </div>
    </div>
</body>
</html>
