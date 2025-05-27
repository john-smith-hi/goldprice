</div>
<footer class="mt-5">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-3">
          <h5 class="text-white">Sitemap</h5>
          <a href="">Trang chủ</a>
          <a href="">Giá vàng hôm nay</a>
          <a href="">Biểu đồ</a>
          <a href="">Liên hệ</a>
        </div>
        <div class="col-md-4 mb-3">
          <h5 class="text-white">Chính sách</h5>
          <a href="#">Điều khoản sử dụng</a>
          <a href="#">Chính sách bảo mật</a>
          <a href="#">Giới hạn trách nhiệm</a>
        </div>
        <div class="col-md-4 mb-3">
          <h5 class="text-white">Thông tin</h5>
          <a href="#">Về chúng tôi</a>
          <a href="#">Hỗ trợ</a>
          <a href="#">Góp ý</a>
        </div>
      </div>
      <div class="copy">© 2025 GiaVangMoi.com. Bản quyền đã được bảo hộ.</div>
    </div>
</footer>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "Giá vàng SJC hôm nay",
  "description": "Cập nhật giá vàng SJC mới nhất hôm nay tại Việt Nam. Bảng giá vàng SJC, biểu đồ giá vàng, so sánh giá mua vào - bán ra, cập nhật liên tục.",
  "image": "{{ asset('images/gold-price-og.jpg') }}",
  "sku": "SJC-GOLD-1L",
  "category": "Vàng miếng SJC",
  "brand": {
    "@type": "Brand",
    "name": "SJC"
  },
  "offers": {
    "@type": "Offer",
    "priceCurrency": "VND",
    "price": "78000000",
    "availability": "https://schema.org/InStock",
    "url": "{{ url()->current() }}"
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.9",
    "reviewCount": "152"
  }
}
</script>
<script>
  const MAIN_SJC_TYPE_GOLD_VN_ID = '{{$MAIN_SJC_TYPE_GOLD_VN_ID}}';
  const MAIN_9999_TYPE_GOLD_VN_ID = '{{$MAIN_9999_TYPE_GOLD_VN_ID}}';
</script>
<script src="{{ asset('js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>