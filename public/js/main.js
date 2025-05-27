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
// End Modal phản hồi
UpdateSJCLastest();
UpdateGold9999Lastest();
UpdateChartVn();      
function UpdateSJCLastest(){
fetch('/api/gold_price?time_filter=lastest&type='+MAIN_SJC_TYPE_GOLD_VN_ID)
    .then(res => res.json())
    .then(json => {
    if (json.success && json.data && json.data.length > 0) {
        const sjc = json.data.find(item => item.type == MAIN_SJC_TYPE_GOLD_VN_ID);
        if (sjc) {
        const priceIn = sjc.price_in;
        const priceOut = sjc.price_out;
        document.getElementById('sjc_price_in').innerText = priceIn.toLocaleString('vi-VN');
        document.getElementById('sjc_price_out').innerText = priceOut.toLocaleString('vi-VN');
        // Tính chênh lệch và cập nhật vào sjc_price_change
        const priceChange = priceOut - priceIn;
        document.getElementById('sjc_price_change').innerText = priceChange.toLocaleString('vi-VN');
            // Cập nhật thời gian published_at
            if (sjc.published_at) {document.getElementById('published_at').innerText = sjc.published_at;}
        }
    }
    });
}

// Cập nhật giá vàng gold_999 lastest
function UpdateGold9999Lastest(){
fetch('/api/gold_price?time_filter=lastest&type='+MAIN_9999_TYPE_GOLD_VN_ID)
.then(res => res.json())
.then(json => {
    if (json.success && json.data && json.data.length > 0) {
    const gold_999 = json.data.find(item => item.type == MAIN_9999_TYPE_GOLD_VN_ID);
    if (gold_999) {
        const priceIn = gold_999.price_in;
        const priceOut = gold_999.price_out;
        document.getElementById('9999_price_in').innerText = priceIn.toLocaleString('vi-VN');
        document.getElementById('9999_price_out').innerText = priceOut.toLocaleString('vi-VN');
        // Tính chênh lệch và cập nhật vào gold_999_price_change
        const priceChange = priceOut - priceIn;
        document.getElementById('9999_price_change').innerText = priceChange.toLocaleString('vi-VN');
    }
    }
});
}

// Cập nhật biểu đồ
function UpdateChartVn(){
    let timeFilterValue = document.getElementById("timeFilter").value;
    let fromDateValue = document.getElementById("fromDate").value;
    let toDate = document.getElementById("toDate").value;
    fetch('/api/gold_price?time_filter='+timeFilterValue+'&type='+MAIN_SJC_TYPE_GOLD_VN_ID+'&from_date='+fromDateValue+'&to_date='+toDate)
    .then(res => res.json())
    .then(json => {
        let sorted = [];
        if (json.success && json.data && json.data.length > 0) {
        // Sắp xếp theo published_at tăng dần
        sorted = json.data.slice().sort((a, b) => new Date(a.published_at) - new Date(b.published_at));
        // Tạo mảng label và data
        let labels;
        if (timeFilterValue === 'day') {
        labels = sorted.map(item => {
            const d = new Date(item.published_at);
            return d.toLocaleTimeString('vi-VN', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        });
        } else {
        labels = sorted.map(item => {
            const d = new Date(item.published_at);
            return d.getDate().toString().padStart(2, '0') + '/' +
                (d.getMonth() + 1).toString().padStart(2, '0') + '/' +
                d.getFullYear();
        });
        }
        const sjcData = sorted.map(item => item.price_out);

        // Xóa chart cũ nếu có
        if(window.chartVNInstance) window.chartVNInstance.destroy();
        window.chartVNInstance = new Chart(document.getElementById('chartVN'), {
        type: 'line',
        data: {
            labels,
            datasets: [{
            label: 'Giá SJC (VNĐ)',
            data: sjcData,
            borderColor: 'gold',
            backgroundColor: 'rgba(255, 215, 0, 0.2)',
            tension: 0.4,
            fill: true
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
            y: {
                ticks: {
                callback: value => value.toLocaleString('vi-VN')
                }
            }
            }
        }
        });
    }
    });
}      

// Xử lý logic bộ lọc
const timeFilter = document.getElementById('timeFilter');
const fromDate = document.getElementById('fromDate');
const toDate = document.getElementById('toDate');

function setDateInputState() {
    if (timeFilter.value === 'custom') {
    fromDate.disabled = false;
    toDate.disabled = false;
    } else {
    fromDate.value = '';
    toDate.value = '';
    fromDate.disabled = true;
    toDate.disabled = true;
    }
}
timeFilter.addEventListener('change', setDateInputState);

[fromDate, toDate].forEach(input => {
    input.addEventListener('input', function() {
    let v = this.value.replace(/[^0-9]/g, '');
    if (v.length > 2 && v.length <= 4) v = v.slice(0,2) + '/' + v.slice(2);
    else if (v.length > 4) v = v.slice(0,2) + '/' + v.slice(2,4) + '/' + v.slice(4,8);
    this.value = v;
    if (fromDate.value.length === 10 && toDate.value.length === 10) {
        timeFilter.value = 'custom';
        setDateInputState();
    }
    });
});
fromDate.addEventListener('input', function() {
    if (fromDate.value.length === 10 && !toDate.value) {
    timeFilter.value = 'custom';
    setDateInputState();
    }
});
document.getElementById('filterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    // Lấy giá trị filter
    const filter = timeFilter.value;
    const from = fromDate.value;
    const to = toDate.value;
    // Gọi lại API và cập nhật biểu đồ (bạn cần bổ sung hàm fetch và cập nhật dữ liệu biểu đồ ở đây)
    // fetch(`/api/gold_price?time_filter=${filter}&from_date=${from}&to_date=${to}&type=...`)
    //   .then(...)
});