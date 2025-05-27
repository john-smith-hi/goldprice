@extends('user.main')
@section('content')
  <!-- Tiêu đề H1 -->
  <h1 class="mb-4 text-center">Giá Vàng Hôm Nay Mới Nhất</h1>
  <!-- Bảng giá -->
  <div class="table-responsive mb-4">
    <table class="table table-bordered table-hover bg-white shadow-sm align-middle">
    <thead class="table-warning">
      <tr>
      <th>Loại Vàng</th>
      <th>Mua Vào</th>
      <th>Bán Ra</th>
      <th>Chênh lệch</th>
      </tr>
    </thead>
    <tbody>
      <tr>
      <td>SJC</td>
      <td class="up" id="sjc_price_in">0</td>
      <td class="up" id="sjc_price_out">0</td>
      <td class="up" id="sjc_price_change">0</td>
      </tr>
      <tr>
      <td>9999</td>
      <td class="down" id="9999_price_in">0</td>
      <td class="down" id="9999_price_out">0</td>
      <td class="down" id="9999_price_change">0</td>
      </tr>
    </tbody>
    </table>
  </div>
  <!-- Bộ lọc biểu đồ -->
  <div class="chart-box mb-3">
    <form id="filterForm" class="row g-2 align-items-end">
    <div class="col-md-3">
      <label for="timeFilter" class="form-label mb-1">Lọc theo</label>
      <select id="timeFilter" name="time_filter" class="form-select" onchange="UpdateChartVn();">
      <!-- <option value="day">Ngày</option> -->
      <option value="week">Tuần</option>
      <option value="month">Tháng</option>
      <option value="quarter">Quý</option>
      <option value="year">Năm</option>
      <option value="custom">Tùy chọn</option>
      </select>
    </div>
    <div class="col-md-3">
      <label for="fromDate" class="form-label mb-1">Từ ngày</label>
      <input type="text" id="fromDate" name="from_date" class="form-control" placeholder="dd/mm/yyyy" maxlength="10" disabled>
    </div>
    <div class="col-md-3">
      <label for="toDate" class="form-label mb-1">Đến ngày</label>
      <input type="text" id="toDate" name="to_date" class="form-control" placeholder="dd/mm/yyyy" maxlength="10" disabled>
    </div>
    <div class="col-md-3">
      <button type="submit" class="btn btn-primary w-100">Tìm kiếm</button>
    </div>
    </form>
  </div>
  <!-- Biểu đồ -->
  <div class="row g-3">
    <div class="col-md-6">
      <div class="chart-box">
      <div class="mb-3 position-relative text-center">
      <h5 class="mb-1 position-static w-100 text-center">Giá Vàng Trong Nước (SJC)</h5>
      <div class="text-muted small">VNĐ / chỉ</div>
      </div>
      <canvas id="chartVN"></canvas>
    </div>
    </div>
    <div class="col-md-6">
    <div class="chart-box">
      <div class="mb-3 position-relative text-center">
      <h5 class="mb-1 position-static w-100 text-center">Giá Vàng Thế Giới</h5>
      <div class="text-muted small">VNĐ / chỉ</div>
      </div>
      <canvas id="chartEn"></canvas>
    </div>
    </div>
  </div>

  <div class="timestamp" id="timestamp">Cập nhật lúc: <span id="published_at"></span></div>
  <div class="seo-content mt-5">
    <h2>Giới thiệu về {{ Str::ucfirst(env('WEBSITE_NAME')) }} - Trang web cập nhật giá vàng uy tín, nhanh chóng và chính xác</h2>
    <p>
    {{ Str::ucfirst(env('WEBSITE_NAME')) }} là trang web chuyên cung cấp giá vàng hôm nay mới nhất, cập nhật liên tục từng phút từ các nguồn uy tín trên thị trường Việt Nam. Chúng tôi mang đến cho người dùng thông tin giá vàng SJC, giá vàng 9999, giá vàng thế giới và nhiều loại vàng khác một cách nhanh chóng, chính xác và hoàn toàn miễn phí.
    </p>
    <h3>Tại sao nên chọn {{ Str::ucfirst(env('WEBSITE_NAME')) }} để tra cứu giá vàng?</h3>
    <ul>
    <li><strong>Cập nhật giá vàng liên tục:</strong> Giá vàng được cập nhật tự động, đảm bảo người dùng luôn nắm bắt được giá vàng mới nhất từng thời điểm trong ngày.</li>
    <li>Đa dạng loại vàng: Trang web cung cấp thông tin về giá vàng SJC, giá vàng 24K, giá vàng 18K, giá vàng PNJ, giá vàng DOJI và nhiều thương hiệu uy tín khác.</li>
    <li>Biểu đồ giá vàng trực quan: Người dùng có thể xem biểu đồ giá vàng theo ngày, tuần, tháng, quý hoặc năm để phân tích xu hướng biến động giá vàng.</li>
    <li>So sánh giá vàng mua vào - bán ra: Bảng giá vàng hiển thị rõ ràng mức giá mua vào, bán ra và chênh lệch, giúp người dùng dễ dàng đưa ra quyết định đầu tư hoặc mua bán vàng.</li>
    <li>Giao diện thân thiện, dễ sử dụng: {{ Str::ucfirst(env('WEBSITE_NAME')) }} thiết kế tối ưu cho cả máy tính và điện thoại, giúp bạn tra cứu giá vàng mọi lúc, mọi nơi.</li>
    </ul>
    <h3>{{ Str::ucfirst(env('WEBSITE_NAME')) }} phù hợp với ai?</h3>
    <p>
    Trang web {{ Str::ucfirst(env('WEBSITE_NAME')) }} là công cụ hữu ích cho mọi đối tượng quan tâm đến thị trường vàng như nhà đầu tư, người kinh doanh vàng bạc đá quý, người dân có nhu cầu mua bán vàng tích trữ, hoặc bất kỳ ai muốn cập nhật giá vàng hôm nay một cách nhanh chóng và chính xác.
    </p>
    <h3>Lợi ích khi sử dụng {{ Str::ucfirst(env('WEBSITE_NAME')) }}</h3>
    <ul>
    <li>Tiết kiệm thời gian tra cứu giá vàng tại các cửa hàng hoặc trang web khác.</li>
    <li>Thông tin giá vàng SJC, giá vàng 9999 và các loại vàng khác luôn được cập nhật mới nhất.</li>
    <li>Phân tích xu hướng giá vàng dễ dàng nhờ biểu đồ giá vàng trực quan.</li>
    <li>Hỗ trợ quyết định đầu tư, mua bán vàng hiệu quả hơn nhờ dữ liệu chính xác.</li>
    </ul>
    <h3>Cam kết của {{ Str::ucfirst(env('WEBSITE_NAME')) }}</h3>
    <p>
    Chúng tôi cam kết mang đến cho người dùng thông tin giá vàng hôm nay chính xác, minh bạch và khách quan nhất. Mọi dữ liệu trên {{ Str::ucfirst(env('WEBSITE_NAME')) }} đều được tổng hợp từ các nguồn uy tín như SJC, DOJI, PNJ, Bảo Tín Minh Châu và các ngân hàng lớn. Đội ngũ kỹ thuật của chúng tôi luôn nỗ lực cải tiến hệ thống để đảm bảo tốc độ cập nhật nhanh nhất và trải nghiệm người dùng tốt nhất.
    </p>
    <h3>Liên hệ với {{ Str::ucfirst(env('WEBSITE_NAME')) }}</h3>
    <p>
    Nếu bạn có bất kỳ thắc mắc, góp ý hoặc cần hỗ trợ về giá vàng hoặc các tính năng của trang web, vui lòng liên hệ với chúng tôi qua email: <a href="mailto:lmn147852369@gmail.com">lmn147852369@gmail.com</a>. {{ Str::ucfirst(env('WEBSITE_NAME')) }} luôn lắng nghe và sẵn sàng hỗ trợ bạn!
    </p>
    <p>
    <strong>{{ Str::ucfirst(env('WEBSITE_NAME')) }}</strong> - Nơi cập nhật giá vàng hôm nay nhanh nhất, chính xác nhất tại Việt Nam!
    </p>
  </div>
@endsection('content')