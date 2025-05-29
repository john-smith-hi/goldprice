@extends('user.main')
@section('content')
  <!-- Tiêu đề H1 -->
  <h1 class="mb-4 text-center">Giá Vàng Mới Nhất Hôm Nay</h1>
  <!-- Bảng giá -->
  <div class="row justify-content-center mb-4">
    <div class="col-md-5 mb-3">
      <div class="card text-center border-warning shadow-lg">
        <div class="card-header bg-warning text-dark fw-bold fs-5">
          Giá Vàng SJC
          <span class="small text-muted" style="font-size: 0.85em;">&nbsp;nghìn/chỉ</span>
        </div>
        <div class="card-body">
          <div class="row mb-2">
            <div class="col-6 text-muted">Mua vào</div>
            <div class="col-6 text-muted">Bán ra</div>
          </div>
          <div class="row align-items-center mb-2">
            <div class="col-6">
              <span id="sjc_price_in" class="display-5 fw-bold text-success">0</span>
            </div>
            <div class="col-6">
              <span id="sjc_price_out" class="display-5 fw-bold text-danger">0</span>
            </div>
          </div>
          <div class="mt-2">
            <span class="badge bg-secondary fs-6">Chênh lệch: <span id="sjc_price_change">0</span> nghìn</span>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-5 mb-3">
      <div class="card text-center border-info shadow-lg">
        <div class="card-header bg-warning text-dark fw-bold fs-5">
          Giá Vàng 999
          <span class="small text-muted" style="font-size: 0.85em;">&nbsp;nghìn/chỉ</span>
        </div>
        <div class="card-body">
          <div class="row mb-2">
            <div class="col-6 text-muted">Mua vào</div>
            <div class="col-6 text-muted">Bán ra</div>
          </div>
          <div class="row align-items-center mb-2">
            <div class="col-6">
              <span id="9999_price_in" class="display-5 fw-bold text-success">0</span>
            </div>
            <div class="col-6">
              <span id="9999_price_out" class="display-5 fw-bold text-danger">0</span>
            </div>
          </div>
          <div class="mt-2">
            <span class="badge bg-secondary fs-6">Chênh lệch: <span id="9999_price_change">0</span> nghìn</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Bộ lọc biểu đồ -->
  <div class="chart-box mb-3">
    <form id="filterForm" class="row g-2 align-items-end">
    <div class="col-md-3">
      <label for="timeFilter" class="form-label mb-1">Lọc theo</label>
      <select id="timeFilter" name="time_filter" class="form-select" onchange="UpdateChartVn();">
      <option value="day">Ngày</option>
      <option value="week">Tuần</option>
      <option value="month">Tháng</option>
      <option value="quarter">Quý</option>
      <option value="year">Năm</option>
      <option value="custom">Tùy chọn</option>
      </select>
    </div>
    <div class="col-md-3">
      <label for="fromDate" class="form-label mb-1">Từ ngày</label>
      <input type="text" id="fromDate" name="from_date" class="form-control" placeholder="dd/mm/yyyy" maxlength="10">
    </div>
    <div class="col-md-3">
      <label for="toDate" class="form-label mb-1">Đến ngày</label>
      <input type="text" id="toDate" name="to_date" class="form-control" placeholder="dd/mm/yyyy" maxlength="10">
    </div>
    <div class="col-md-3">
      <button type="submit" class="btn btn-primary w-100" onclick="UpdateChartVn();">Tìm kiếm</button>
    </div>
    </form>
  </div>
  <!-- Biểu đồ -->
  <div class="row g-3">
    <div class="col-md-12">
      <div class="chart-box" style="max-height: 500px;">
      <div class="mb-3 position-relative text-center">
      <h5 class="mb-1 position-static w-100 text-center fw-bold text-primary" style="font-size: 1.5rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.1);">Giá Vàng SJC</h5>
      </div>
      <canvas id="chartVN"></canvas>
    </div>
    </div>
  </div>

  <div class="timestamp" id="timestamp">Cập nhật lúc: <span id="published_at"></span></div>
  <div class="seo-content mt-5">
    <h2>Giới thiệu về {{ (config('services.website_name')) }} - Trang web cập nhật giá vàng uy tín, nhanh chóng và chính xác</h2>
    <p>
    {{ (config('services.website_name')) }} là trang web chuyên cung cấp giá vàng hôm nay mới nhất, cập nhật liên tục từng phút từ các nguồn uy tín trên thị trường Việt Nam. Chúng tôi mang đến cho người dùng thông tin giá vàng SJC, giá vàng 9999, giá vàng thế giới và nhiều loại vàng khác một cách nhanh chóng, chính xác và hoàn toàn miễn phí.
    </p>
    <h3>Tại sao nên chọn {{ (config('services.website_name')) }} để tra cứu giá vàng?</h3>
    <ul>
    <li><strong>Cập nhật giá vàng liên tục:</strong> Giá vàng được cập nhật tự động, đảm bảo người dùng luôn nắm bắt được giá vàng mới nhất từng thời điểm trong ngày.</li>
    <li>Đa dạng loại vàng: Trang web cung cấp thông tin về giá vàng SJC, giá vàng 24K, giá vàng 18K, giá vàng PNJ, giá vàng DOJI và nhiều thương hiệu uy tín khác.</li>
    <li>Biểu đồ giá vàng trực quan: Người dùng có thể xem biểu đồ giá vàng theo ngày, tuần, tháng, quý hoặc năm để phân tích xu hướng biến động giá vàng.</li>
    <li>So sánh giá vàng mua vào - bán ra: Bảng giá vàng hiển thị rõ ràng mức giá mua vào, bán ra và chênh lệch, giúp người dùng dễ dàng đưa ra quyết định đầu tư hoặc mua bán vàng.</li>
    <li>Giao diện thân thiện, dễ sử dụng: {{ (config('services.website_name')) }} thiết kế tối ưu cho cả máy tính và điện thoại, giúp bạn tra cứu giá vàng mọi lúc, mọi nơi.</li>
    </ul>
    <h3>{{ (config('services.website_name')) }} phù hợp với ai?</h3>
    <p>
    Trang web {{ (config('services.website_name')) }} là công cụ hữu ích cho mọi đối tượng quan tâm đến thị trường vàng như nhà đầu tư, người kinh doanh vàng bạc đá quý, người dân có nhu cầu mua bán vàng tích trữ, hoặc bất kỳ ai muốn cập nhật giá vàng hôm nay một cách nhanh chóng và chính xác.
    </p>
    <h3>Lợi ích khi sử dụng {{ (config('services.website_name')) }}</h3>
    <ul>
    <li>Tiết kiệm thời gian tra cứu giá vàng tại các cửa hàng hoặc trang web khác.</li>
    <li>Thông tin giá vàng SJC, giá vàng 9999 và các loại vàng khác luôn được cập nhật mới nhất.</li>
    <li>Phân tích xu hướng giá vàng dễ dàng nhờ biểu đồ giá vàng trực quan.</li>
    <li>Hỗ trợ quyết định đầu tư, mua bán vàng hiệu quả hơn nhờ dữ liệu chính xác.</li>
    </ul>
    <h3>Cam kết của {{ (config('services.website_name')) }}</h3>
    <p>
    Chúng tôi cam kết mang đến cho người dùng thông tin giá vàng hôm nay chính xác, minh bạch và khách quan nhất. Mọi dữ liệu trên {{ (config('services.website_name')) }} đều được tổng hợp từ các nguồn uy tín như SJC, DOJI, PNJ, Bảo Tín Minh Châu và các ngân hàng lớn. Đội ngũ kỹ thuật của chúng tôi luôn nỗ lực cải tiến hệ thống để đảm bảo tốc độ cập nhật nhanh nhất và trải nghiệm người dùng tốt nhất.
    </p>
    <h3>Liên hệ với {{ (config('services.website_name')) }}</h3>
    <p>
    Nếu bạn có bất kỳ thắc mắc, góp ý hoặc cần hỗ trợ về giá vàng hoặc các tính năng của trang web, vui lòng liên hệ với chúng tôi qua email: <a href="mailto:lmn147852369@gmail.com">lmn147852369@gmail.com</a>. {{ (config('services.website_name')) }} luôn lắng nghe và sẵn sàng hỗ trợ bạn!
    </p>
    <p>
    <strong>{{ (config('services.website_name')) }}</strong> - Nơi cập nhật giá vàng hôm nay nhanh nhất, chính xác nhất tại Việt Nam!
    </p>
  </div>
  <script>
    UpdateSJCLastest();
    UpdateGold9999Lastest();
    UpdateChartVn();   
    // Xử lý logic bộ lọc
    const timeFilter = document.getElementById('timeFilter');
    const fromDate = document.getElementById('fromDate');
    const toDate = document.getElementById('toDate');
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

        // Thêm sự kiện click
        input.addEventListener('click', function() {
            timeFilter.value = 'custom';
            setDateInputState();
            this.focus();
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
    // End Modal phản hồi   
    function UpdateSJCLastest(){
    fetch('/api/gold_price?time_filter=lastest&type='+MAIN_SJC_TYPE_GOLD_VN_ID)
        .then(res => res.json())
        .then(json => {
        if (json.success && json.data && json.data.length > 0) {
            const sjc = json.data.find(item => item.type == MAIN_SJC_TYPE_GOLD_VN_ID);
            if (sjc) {
            const priceIn = sjc.price_in;
            const priceOut = sjc.price_out;
            document.getElementById('sjc_price_in').innerText = Math.floor(priceIn / 1000).toLocaleString('vi-VN');
            document.getElementById('sjc_price_out').innerText = Math.floor(priceOut / 1000).toLocaleString('vi-VN');
            // Tính chênh lệch và cập nhật vào sjc_price_change
            const priceChange = Math.floor((priceOut - priceIn) / 1000).toLocaleString('vi-VN');
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
                document.getElementById('9999_price_in').innerText = Math.floor(priceIn / 1000).toLocaleString('vi-VN');
                document.getElementById('9999_price_out').innerText = Math.floor(priceOut / 1000).toLocaleString('vi-VN');
                // Tính chênh lệch và cập nhật vào gold_999_price_change
                const priceChange = Math.floor((priceOut - priceIn) / 1000).toLocaleString('vi-VN');
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
            const sjcDataOut = sorted.map(item => item.price_out);
            const sjcDataIn = sorted.map(item => item.price_in);
            
            const minY = Math.ceil((Math.min(...sjcDataIn) - 2000000) / 1000000) * 1000000;
            const maxY = Math.ceil((Math.max(...sjcDataOut) + 3000000) / 1000000) * 1000000;

            // Xóa chart cũ nếu có
            if(window.chartVNInstance) window.chartVNInstance.destroy();
            window.chartVNInstance = new Chart(document.getElementById('chartVN'), {
              type: 'line',
              data: {
                  labels,
                  datasets: [
                      {
                          label: 'Giá bán ra',
                          data: sjcDataOut,
                          borderColor: '#dc3545',
                          backgroundColor: 'rgba(220, 53, 69, 0.1)',
                          tension: 0.4,
                          fill: false
                      },
                      {
                          label: 'Giá mua vào',
                          data: sjcDataIn,
                          borderColor: '#198754',
                          backgroundColor: 'rgba(25, 135, 84, 0.1)',
                          tension: 0.4,
                          fill: false
                      }
                  ]
              },
              options: {
                  responsive: true,
                  maintainAspectRatio: false,
                  layout: {
                      padding: {
                          top: 0,
                          bottom: 50,
                          left: 0,
                          right: 0
                      }
                  },
                  plugins: {
                      legend: {
                          display: true,
                          position: 'top',
                          labels: {
                              usePointStyle: true,
                              padding: 20
                          }
                      },
                      tooltip: {
                          enabled: true,
                          callbacks: {
                              label: (context) => {
                                  const value = context.raw;
                                  return context.dataset.label + ': ' + value.toLocaleString('vi-VN') + ' VNĐ';
                              }
                          }
                      }
                  },
                  scales: {
                      y: {
                          display: true,
                          min: minY,
                          max: maxY,
                          ticks: {
                              callback: (value) => value.toLocaleString('vi-VN') + ' ₫'
                          }
                      },
                      x: {
                          grid: {
                              display: false
                          }
                      }
                  },
                  elements: {
                      point: {
                          radius: 2,
                          hoverRadius: 4
                      },
                      line: {
                          tension: 0.2,
                          borderWidth: 2
                      }
                  }
              }
            });
        }
        });
    }      

    function setDateInputState() {
        if (timeFilter.value !== 'custom') {
            fromDate.value = '';
            toDate.value = '';
        }
    }
</script>
@endsection('content')