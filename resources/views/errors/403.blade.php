<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>403 - Không được phép truy cập</title>
    <style>
        body {
            background: #fff3cd;
            color: #856404;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            padding: 60px;
        }
        .emoji {
            font-size: 80px;
            margin-bottom: 20px;
        }
        .angry-img {
            width: 120px;
            margin-bottom: 20px;
        }
        .btn-home {
            display: inline-block;
            margin-top: 30px;
            padding: 12px 28px;
            background: #ffc107;
            color: #212529;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background 0.2s;
        }
        .btn-home:hover {
            background: #e0a800;
        }
    </style>
</head>
<body>
    <img src="https://cdn-icons-png.flaticon.com/512/742/742752.png" alt="Angry Face" class="angry-img">
    <div class="emoji">😡</div>
    <h1>403 - Bạn đang làm gì vậy?</h1>
    <p>Bạn không có quyền truy cập vào trang này.<br>
    Quay về <a href="{{ url('/') }}" class="btn-home">Trang chủ</a> đi!</p>
</body>
</html>