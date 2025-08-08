<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | The settings below determine what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // Chỉ định đường dẫn được phép áp dụng CORS (có thể là ['*'] nhưng nên chỉ rõ)
    'paths' => ['api/*', '*'],
    'allowed_methods' => ['*'], // hoặc ['GET', 'POST', 'PUT', 'DELETE']

    // Các domain frontend được phép gọi API
    'allowed_origins' => ['*'], // hoặc ['*'] nếu muốn mở toàn bộ

    // Regex patterns để match origin (không cần thiết nếu dùng allowed_origins)
    'allowed_origins_patterns' => [],

    // Header nào được chấp nhận
    'allowed_headers' => ['*'],

    // Các headers cho phép phía client đọc (ví dụ: Authorization)
    'exposed_headers' => [],

    // Cache thời gian preflight response (0 là luôn gửi lại preflight)
    'max_age' => 0,

    // Nếu bạn muốn gửi cookie kèm request (phải cấu hình thêm ở frontend)
    'supports_credentials' => false,

];
