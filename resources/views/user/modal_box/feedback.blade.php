<div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="feedbackModalLabel">
                    <i class="fas fa-comment-alt me-2"></i>Góp ý / Phản hồi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Đóng"></button>
            </div>
            <div class="modal-body">
                <form id="feedbackForm" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="feedbackName" class="form-label">Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" id="feedbackName" class="form-control" placeholder="Nhập họ và tên của bạn" required>
                        <div class="invalid-feedback">Vui lòng nhập họ và tên</div>
                    </div>
                    <div class="mb-3">
                        <label for="feedbackEmail" class="form-label">Email</label>
                        <input type="email" id="feedbackEmail" class="form-control" placeholder="Nhập email của bạn">
                        <div class="invalid-feedback">Email không hợp lệ</div>
                    </div>
                    <div class="mb-3">
                        <label for="feedbackText" class="form-label">Nội dung <span class="text-danger">*</span></label>
                        <textarea id="feedbackText" class="form-control" placeholder="Nhập nội dung góp ý của bạn..." rows="4" required></textarea>
                        <div class="invalid-feedback">Vui lòng nhập nội dung góp ý</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Mã xác nhận <span class="text-danger">*</span></label>
                        <div class="captcha-container">
                            <div class="captcha">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-outline-secondary btn-sm" onclick="refreshCaptcha()">
                                    <i class="fas fa-sync-alt"></i> Làm mới
                                </button>
                            </div>
                            <input type="text" id="captcha" class="form-control mt-2" placeholder="Nhập mã xác nhận" required>
                            <div class="invalid-feedback">Vui lòng nhập mã xác nhận</div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Gửi phản hồi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
.modal-content {
    border: none;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
}

.modal-header {
    border-radius: 10px 10px 0 0;
}

.captcha-container {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
}

.captcha {
    display: flex;
    align-items: center;
    gap: 10px;
}

.captcha img {
    height: 40px;
    border-radius: 4px;
    border: 1px solid #dee2e6;
}

.captcha button {
    height: 40px;
    display: flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
}

.form-label {
    font-weight: 500;
    color: #495057;
}

.btn-primary {
    padding: 10px 20px;
    font-weight: 500;
}

.invalid-feedback {
    font-size: 0.875rem;
}
</style>

<script>
async function refreshCaptcha() {
    try {
        const response = await fetch('/refresh-captcha');
        const data = await response.json();
        document.querySelector('.captcha span').innerHTML = data.captcha;
    } catch (error) {
        console.error('Error refreshing captcha:', error);
    }
}

document.getElementById('feedbackForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    if (!this.checkValidity()) {
        e.stopPropagation();
        this.classList.add('was-validated');
        return;
    }

    const formData = {
        name: document.getElementById('feedbackName').value,
        email: document.getElementById('feedbackEmail').value,
        message: document.getElementById('feedbackText').value,
        captcha: document.getElementById('captcha').value,
        _token: '{{ csrf_token() }}'
    };

    try {
        const response = await fetch('/feedback', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: data.message,
                confirmButtonText: 'Đóng',
                confirmButtonColor: '#3085d6'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('feedbackModal').querySelector('.btn-close').click();
                    this.reset();
                    this.classList.remove('was-validated');
                    refreshCaptcha();
                }
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: data.message,
                confirmButtonText: 'Thử lại',
                confirmButtonColor: '#d33'
            });
            refreshCaptcha();
        }
    } catch (error) {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Lỗi!',
            text: 'Có lỗi xảy ra, vui lòng thử lại sau!',
            confirmButtonText: 'Thử lại',
            confirmButtonColor: '#d33'
        });
        refreshCaptcha();
    }
});
</script>