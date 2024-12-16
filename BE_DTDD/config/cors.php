<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*'], // Chỉ áp dụng cho các route bắt đầu bằng /api/
    'allowed_methods' => ['*'], // Cho phép tất cả phương thức HTTP
    'allowed_origins' => ['http://localhost:5173'], // Chỉ cho phép request từ localhost:5173
    'allowed_headers' => ['*'], // Cho phép tất cả headers
    'supports_credentials' => false, // Không cần hỗ trợ cookies, nếu không cần có thể để false

];
