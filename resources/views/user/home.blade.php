@extends('user.main')

@section('content')
    <!-- Bảng giá -->
    <div class="table-responsive mb-4">
      <table class="table table-bordered table-hover bg-white shadow-sm align-middle">
        <thead class="table-warning">
          <tr>
            <th>Loại Vàng</th>
            <th>Mua Vào</th>
            <th>Bán Ra</th>
            <th>Thay Đổi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>SJC</td>
            <td class="up">74.500.000</td>
            <td class="up">75.200.000</td>
            <td class="up">+100.000</td>
          </tr>
          <tr>
            <td>9999</td>
            <td class="down">74.100.000</td>
            <td class="down">74.900.000</td>
            <td class="down">-50.000</td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- Biểu đồ -->
    <div class="row g-3">
      <div class="col-md-6">
        <div class="chart-box">
          <h5 class="text-center mb-3">Giá Vàng Trong Nước (SJC)</h5>
          <canvas id="chartSJC"></canvas>
        </div>
      </div>
      <div class="col-md-6">
        <div class="chart-box">
          <h5 class="text-center mb-3">Giá Vàng Thế Giới (USD/oz)</h5>
          <canvas id="chartWorld"></canvas>
        </div>
      </div>
    </div>

    <div class="timestamp" id="timestamp">Cập nhật lúc: ...</div>
    <script>
      // Cập nhật thời gian hiện tại
      const now = new Date();
      const formatted = now.toLocaleString('vi-VN', {
        hour: '2-digit', minute: '2-digit',
        day: '2-digit', month: '2-digit', year: 'numeric'
      });
      document.getElementById("timestamp").innerText = "Cập nhật lúc: " + formatted;

      // Biểu đồ dữ liệu mẫu
      const labels = ["Thứ 2", "Thứ 3", "Thứ 4", "Thứ 5", "Thứ 6", "Hôm nay"];
      const sjcData = [74000000, 74300000, 74500000, 74400000, 74550000, 75200000];
      const worldData = [2320, 2335, 2340, 2315, 2305, 2330];

      new Chart(document.getElementById('chartSJC'), {
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

      new Chart(document.getElementById('chartWorld'), {
        type: 'line',
        data: {
          labels,
          datasets: [{
            label: 'Giá vàng quốc tế (USD/oz)',
            data: worldData,
            borderColor: '#007bff',
            backgroundColor: 'rgba(0, 123, 255, 0.2)',
            tension: 0.4,
            fill: true
          }]
        },
        options: {
          plugins: { legend: { display: false } },
          scales: {
            y: {
              ticks: {
                callback: value => '$' + value
              }
            }
          }
        }
      });

    </script>
@endsection('content')