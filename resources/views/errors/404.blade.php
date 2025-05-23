<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>404 - Không tìm thấy trang</title>
    <style>
        body {
            background: #f8fafc;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            padding: 60px 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
        }
        .funny-img {
            width: 220px;
            margin-bottom: 30px;
        }
        h1 {
            font-size: 5em;
            margin: 0;
            color: #ff9800;
        }
        h2 {
            margin: 10px 0 20px 0;
            font-size: 2em;
        }
        p {
            font-size: 1.2em;
            color: #666;
        }
        a {
            display: inline-block;
            margin-top: 25px;
            padding: 10px 25px;
            background: #ff9800;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.2s;
        }
        a:hover {
            background: #e65100;
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="funny-img" src="https://cdn.pixabay.com/photo/2017/01/31/13/14/emoji-2027366_1280.png" alt="404 Funny Emoji">
        <h1>404</h1>
        <h2>Ôi không! Trang không tồn tại 😅</h2>
        <p>Có vẻ như bạn đã lạc vào vùng đất không có vàng.<br>Hãy quay lại trang chủ nhé!</p>
        <a href="{{ url('/') }}">Về trang chủ</a>
    </div>
</body>
</html>