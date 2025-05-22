<nav class="navbar navbar-expand-lg bg-gold mb-4">
    <div class="container">
      <a class="navbar-brand fw-bold text-dark" href="#">Giá Vàng Hôm Nay</a>
      <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#feedbackModal">Góp ý</button>
    </div>
</nav>
<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="feedbackModalLabel">Góp ý / Phản hồi</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body">
          <textarea id="feedbackText" class="form-control mb-3" placeholder="Nhập nội dung góp ý..." rows="6"></textarea>
          <button onclick="submitFeedback()" class="btn btn-primary w-100">Gửi</button>
        </div>
      </div>
    </div>
</div>
<script>
  // Modal phản hồi
  function submitFeedback() {
    const text = document.getElementById('feedbackText').value.trim();
    if (!text) {
      alert('Vui lòng nhập nội dung góp ý.');
      return;
    }
    alert('Cảm ơn bạn đã gửi phản hồi!');
    document.getElementById('feedbackText').value = '';
    const modal = bootstrap.Modal.getInstance(document.getElementById('feedbackModal'));
    modal.hide();
  }
</script>