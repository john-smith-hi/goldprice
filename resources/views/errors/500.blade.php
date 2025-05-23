<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Lỗi 500 - Lỗi Máy Chủ</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #18181b;
            color: #f4f4f5;
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            padding: 40px 20px;
            background: rgba(30, 30, 36, 0.95);
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.4);
        }
        img {
            width: 120px;
            margin-bottom: 24px;
            filter: grayscale(1) brightness(0.8);
        }
        h1 {
            font-size: 3rem;
            margin-bottom: 12px;
            color: #fbbf24;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        a {
            color: #38bdf8;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://cdn-icons-png.flaticon.com/512/564/564619.png" alt="Server Error">
        <h1>500</h1>
        <p>Xin lỗi, đã xảy ra lỗi máy chủ.<br>Vui lòng thử lại sau.</p>
        <a href="{{ url('/') }}">Quay về trang chủ</a>
    </div>
</body>
</html>