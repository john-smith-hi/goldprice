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