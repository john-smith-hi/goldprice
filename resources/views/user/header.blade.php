<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Giá Vàng Hôm Nay Mới Nhất</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="description" content="Cập nhật giá vàng hôm nay mới nhất, giá vàng SJC, DOJI, PNJ, vàng 9999, vàng 24K, 18K, 14K, bảng giá vàng trực tuyến, biểu đồ giá vàng, phân tích xu hướng giá vàng tại Việt Nam.">
  <meta name="keywords" content="giá vàng, giá vàng hôm nay, giá vàng SJC, giá vàng DOJI, giá vàng PNJ, giá vàng 9999, giá vàng 24K, giá vàng 18K, giá vàng 14K, bảng giá vàng, biểu đồ giá vàng, vàng miếng, vàng nhẫn, vàng trang sức, giá vàng trực tuyến, giá vàng mới nhất, giá vàng Việt Nam">
  <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1">
  <meta name="author" content="Giá Vàng Hôm Nay">
  <meta name="copyright" content="Giá Vàng Hôm Nay Mới Nhất">
  <meta name="distribution" content="global">
  <meta name="rating" content="general">
  <meta property="og:title" content="Giá Vàng Hôm Nay - Cập Nhật Giá Vàng Mới Nhất">
  <meta property="og:description" content="Xem bảng giá vàng hôm nay, giá vàng SJC, DOJI, PNJ, vàng 9999, biểu đồ giá vàng trực tuyến, cập nhật liên tục tại Việt Nam.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:image" content="{{ asset('images/gold-price-og.jpg') }}">
  <meta property="og:locale" content="vi_VN">
  <meta property="og:site_name" content="Giá Vàng Hôm Nay">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Giá Vàng Hôm Nay - Cập Nhật Giá Vàng Mới Nhất">
  <meta name="twitter:description" content="Cập nhật giá vàng hôm nay, bảng giá vàng SJC, DOJI, PNJ, vàng 9999, biểu đồ giá vàng trực tuyến tại Việt Nam.">
  <meta name="twitter:image" content="{{ asset('images/gold-price-og.jpg') }}">
  <meta name="twitter:site" content="@giavanghomnay">
  <meta name="twitter:creator" content="@giavanghomnay">
  <meta name="theme-color" content="#ffd700">
  <meta name="apple-mobile-web-app-title" content="Giá Vàng Hôm Nay">
  <meta name="application-name" content="Giá Vàng Hôm Nay">
  <link rel="alternate" href="{{ url()->current() }}" hreflang="vi-vn" />
  <link rel="canonical" href="{{ url()->current() }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
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
  <script src="{{ asset('js/npm/chart.js') }}"></script>
</head>
<body>
  @include('user.modal_box.feedback')
  @include('user.navbar')
  <script>
    @if(!empty($MAIN_SJC_TYPE_GOLD_VN_ID))
      const MAIN_SJC_TYPE_GOLD_VN_ID = '{{$MAIN_SJC_TYPE_GOLD_VN_ID}}';
    @else
      const MAIN_SJC_TYPE_GOLD_VN_ID = 1;
    @endif
    @if(!empty($MAIN_9999_TYPE_GOLD_VN_ID))
      const MAIN_9999_TYPE_GOLD_VN_ID = '{{$MAIN_9999_TYPE_GOLD_VN_ID}}';
    @else
      const MAIN_9999_TYPE_GOLD_VN_ID = 4;
    @endif
  </script>
  <div class="container">