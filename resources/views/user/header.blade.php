<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Giá Vàng Hôm Nay</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body { background-color: #f9f9f9; }
    .bg-gold { background-color: #ffd700 !important; }
    .up { color: green; }
    .down { color: red; }
    .timestamp { text-align: right; font-size: 0.9em; color: #777; margin-top: 10px; }
    .chart-box { background: #fff; padding: 15px; box-shadow: 0 0 8px rgba(0,0,0,0.1); border-radius: 8px; margin-bottom: 20px; }
    footer { background: #333; color: #ccc; padding: 30px 0 0 0; margin-top: 40px; }
    footer a { color: #ccc; text-decoration: none; display: block; margin-bottom: 6px; }
    footer a:hover { text-decoration: underline; }
    footer .copy { text-align: center; margin-top: 30px; font-size: 0.85em; padding-bottom: 20px; }
  </style>
</head>
<body>
  @include('user.modal_box.feedback')
  <div class="container">