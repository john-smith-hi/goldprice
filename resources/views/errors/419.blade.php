<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>419 - Phiên làm việc đã hết hạn</title>
    <style>
        body {
            background: #f8fafc;
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
            padding: 40px 30px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }
        .image {
            width: 160px;
            margin-bottom: 16px;
        }
        .emoji {
            font-size: 64px;
            margin-bottom: 16px;
        }
        h1 {
            font-size: 48px;
            margin: 0 0 12px 0;
            color: #e74c3c;
        }
        p {
            font-size: 20px;
            margin-bottom: 24px;
        }
        .reload-btn {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 12px 32px;
            border-radius: 6px;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .reload-btn:hover {
            background: #217dbb;
        }
    </style>
</head>
<body>
    <div class="container">
        <img class="image" src="https://undraw.co/api/illustrations/8b6e5b5e-2e8d-4e7e-8e8b-2e8d4e7e8e8b" alt="Session expired">
        <div class="emoji">😞</div>
        <h1>419</h1>
        <p>Phiên làm việc của bạn đã hết hạn.<br>
        Chúng tôi rất tiếc về sự bất tiện này.<br>
        Vui lòng tải lại trang để tiếp tục.</p>
        <button class="reload-btn" onclick="location.reload();">Tải lại trang</button>
    </div>
</body>
</html>