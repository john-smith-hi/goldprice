@extends('user.main')
@section('content')
<div class="container my-5">
    <h1 class="mb-4">Câu hỏi thường gặp về vàng</h1>
    <div class="accordion" id="faqAccordion">
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                    1. Vàng 9999 là gì?
                </button>
            </h2>
            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="faq1" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <p>
                        <strong>Vàng 9999</strong> (hay còn gọi là vàng 24K) là loại vàng có độ tinh khiết rất cao, chứa tới 99,99% vàng nguyên chất và chỉ có 0,01% là tạp chất. Đây là loại vàng được ưa chuộng nhất để tích trữ, đầu tư hoặc làm vàng miếng, nhẫn tròn trơn.
                    </p>
                    <ul>
                        <li>Vàng 9999 có màu vàng ánh đậm, mềm và dễ bị trầy xước do không pha hợp kim.</li>
                        <li>Thường được các thương hiệu lớn như SJC, DOJI, PNJ sản xuất dưới dạng miếng, nhẫn tròn trơn.</li>
                        <li>Giá trị cao, dễ mua bán, thanh khoản tốt trên thị trường.</li>
                        <li>Không phù hợp để làm trang sức vì dễ biến dạng.</li>
                    </ul>
                    <div class="text-center my-3">
                        <img src="{{ asset('images/vang-9999.jpg') }}" alt="Vàng 9999" class="img-fluid rounded shadow" style="max-width: 350px;">
                        <div class="small text-muted mt-2">Hình minh họa: Vàng miếng 9999 (24K)</div>
                    </div>
                    <p>
                        <em>Vàng 9999 là lựa chọn hàng đầu cho những ai muốn tích lũy tài sản an toàn và lâu dài.</em>
                    </p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                    2. Vàng 24K khác gì với 18K, 14K?
                </button>
            </h2>
            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="faq2" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <p>
                        <strong>Vàng 24K</strong> (hay còn gọi là vàng 9999) là loại vàng gần như nguyên chất nhất, chứa tới 99,99% vàng. Trong khi đó, <strong>vàng 18K</strong> và <strong>vàng 14K</strong> là các loại vàng đã được pha thêm hợp kim để tăng độ cứng, phù hợp hơn cho việc chế tác trang sức.
                    </p>
                    <ul>
                        <li><strong>Vàng 24K:</strong> 99,99% vàng nguyên chất, màu vàng đậm, mềm, chủ yếu dùng để tích trữ, đầu tư hoặc làm vàng miếng, nhẫn tròn trơn.</li>
                        <li><strong>Vàng 18K:</strong> Chứa 75% vàng, 25% là hợp kim khác (bạc, đồng...), màu vàng nhạt hơn, cứng hơn, thường dùng làm trang sức cao cấp.</li>
                        <li><strong>Vàng 14K:</strong> Khoảng 58,5% vàng, còn lại là hợp kim, màu vàng nhạt hơn nữa, rất bền, phổ biến trong trang sức thời trang.</li>
                    </ul>
                    <div class="row text-center my-3">
                        <div class="col-md-4 mb-2">
                            <img src="{{ asset('images/vang-24k.jpg') }}" alt="Vàng 24K" class="img-fluid rounded shadow" style="max-width: 120px;">
                            <div class="small text-muted mt-1">Vàng 24K (9999)</div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <img src="{{ asset('images/vang-18k.jpg') }}" alt="Vàng 18K" class="img-fluid rounded shadow" style="max-width: 120px;">
                            <div class="small text-muted mt-1">Vàng 18K</div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <img src="{{ asset('images/vang-14k.jpg') }}" alt="Vàng 14K" class="img-fluid rounded shadow" style="max-width: 120px;">
                            <div class="small text-muted mt-1">Vàng 14K</div>
                        </div>
                    </div>
                    <p>
                        <em>
                            Tùy mục đích sử dụng mà bạn nên chọn loại vàng phù hợp: Vàng 24K để tích trữ, đầu tư; vàng 18K, 14K để làm trang sức vì bền, khó biến dạng và đa dạng mẫu mã hơn.
                        </em>
                    </p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                    3. Giá vàng trong nước và thế giới có giống nhau không?
                </button>
            </h2>
            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="faq3" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    <p>
                        <strong>Không giống nhau.</strong> Giá vàng trong nước và giá vàng thế giới thường có sự chênh lệch đáng kể, đặc biệt là tại Việt Nam. Nguyên nhân chủ yếu do:
                    </p>
                    <ul>
                        <li><strong>Thuế và phí:</strong> Vàng nhập khẩu phải chịu thuế, phí và các chi phí vận chuyển, bảo hiểm.</li>
                        <li><strong>Chính sách quản lý:</strong> Nhà nước kiểm soát chặt chẽ hoạt động nhập khẩu, kinh doanh vàng miếng.</li>
                        <li><strong>Cung cầu nội địa:</strong> Khi nhu cầu trong nước tăng cao hoặc nguồn cung hạn chế, giá vàng trong nước có thể cao hơn nhiều so với thế giới.</li>
                        <li><strong>Tỷ giá USD/VND:</strong> Giá vàng thế giới quy đổi sang VND còn phụ thuộc vào tỷ giá ngoại tệ.</li>
                    </ul>
                    <div class="text-center my-3">
                        <img src="{{ asset('images/so-sanh-gia-vang.jpg') }}" alt="So sánh giá vàng trong nước và thế giới" class="img-fluid rounded shadow" style="max-width: 350px;">
                        <div class="small text-muted mt-2">Biểu đồ minh họa: Giá vàng trong nước thường cao hơn giá vàng thế giới</div>
                    </div>
                    <p>
                        <em>
                            Ví dụ: Có thời điểm giá vàng thế giới quy đổi chỉ khoảng 60 triệu đồng/lượng, nhưng giá vàng SJC trong nước lại lên tới 70 triệu đồng/lượng. Vì vậy, khi đầu tư vàng, bạn nên theo dõi cả hai thị trường để có quyết định phù hợp.
                        </em>
                    </p>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq4">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                4. Mua vàng miếng hay vàng trang sức tốt hơn?
            </button>
            </h2>
            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="faq4" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                <p>
                <strong>Việc lựa chọn mua vàng miếng hay vàng trang sức</strong> phụ thuộc vào mục đích sử dụng của bạn:
                </p>
                <ul>
                <li>
                    <strong>Vàng miếng</strong> (như SJC, DOJI, PNJ...) thường được ưu tiên để <span class="text-primary">tích trữ và đầu tư</span> vì có độ tinh khiết cao, dễ mua bán, thanh khoản tốt và ít bị mất giá do không tính phí chế tác.
                </li>
                <li>
                    <strong>Vàng trang sức</strong> thường có mẫu mã đa dạng, đẹp mắt, phù hợp để làm quà tặng hoặc sử dụng cá nhân. Tuy nhiên, khi bán lại sẽ bị trừ phí chế tác (có thể từ 5-15% giá trị), giá trị không cao bằng vàng miếng.
                </li>
                <li>
                    Nếu bạn muốn <span class="text-success">giữ tài sản an toàn, dễ bán lại</span> thì nên chọn vàng miếng. Nếu muốn <span class="text-warning">làm đẹp, làm quà tặng</span> thì vàng trang sức là lựa chọn phù hợp.
                </li>
                </ul>
                <div class="row text-center my-3">
                <div class="col-md-6 mb-2">
                    <img src="{{ asset('images/vang-mieng.jpg') }}" alt="Vàng miếng" class="img-fluid rounded shadow" style="max-width: 180px;">
                    <div class="small text-muted mt-1">Vàng miếng SJC</div>
                </div>
                <div class="col-md-6 mb-2">
                    <img src="{{ asset('images/vang-trang-suc.jpg') }}" alt="Vàng trang sức" class="img-fluid rounded shadow" style="max-width: 180px;">
                    <div class="small text-muted mt-1">Vàng trang sức</div>
                </div>
                </div>
                <p>
                <em>
                    <strong>Lưu ý:</strong> Khi mua vàng để đầu tư, nên chọn vàng miếng của các thương hiệu lớn, có hóa đơn, chứng từ rõ ràng để đảm bảo an toàn và dễ dàng giao dịch sau này.
                </em>
                </p>
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq5">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                5. Vàng SJC, DOJI, PNJ… khác nhau ở điểm nào?
            </button>
            </h2>
            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="faq5" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                <p>
                <strong>Các thương hiệu vàng lớn như SJC, DOJI, PNJ</strong> đều sản xuất vàng miếng, vàng nhẫn và trang sức, nhưng có một số điểm khác biệt:
                </p>
                <ul>
                <li>
                    <strong>Thương hiệu & Uy tín:</strong> SJC là thương hiệu vàng miếng quốc gia, được Nhà nước công nhận, có thanh khoản cao nhất tại Việt Nam. DOJI, PNJ cũng rất uy tín, nổi bật về trang sức và vàng nhẫn.
                </li>
                <li>
                    <strong>Mẫu mã & Đóng gói:</strong> Mỗi thương hiệu có thiết kế, đóng gói, tem chống giả riêng biệt.
                </li>
                <li>
                    <strong>Chênh lệch mua – bán:</strong> Vàng SJC thường có mức chênh lệch thấp hơn, dễ bán lại hơn. Vàng của các thương hiệu khác có thể bị trừ thêm phí khi bán lại tại nơi không phải đại lý chính hãng.
                </li>
                </ul>
                <div class="row text-center my-3">
                <div class="col-md-4 mb-2">
                    <img src="{{ asset('images/sjc.jpg') }}" alt="Vàng SJC" class="img-fluid rounded shadow" style="max-width: 100px;">
                    <div class="small text-muted mt-1">Vàng miếng SJC</div>
                </div>
                <div class="col-md-4 mb-2">
                    <img src="{{ asset('images/doji.jpg') }}" alt="Vàng DOJI" class="img-fluid rounded shadow" style="max-width: 100px;">
                    <div class="small text-muted mt-1">Vàng DOJI</div>
                </div>
                <div class="col-md-4 mb-2">
                    <img src="{{ asset('images/pnj.jpg') }}" alt="Vàng PNJ" class="img-fluid rounded shadow" style="max-width: 100px;">
                    <div class="small text-muted mt-1">Vàng PNJ</div>
                </div>
                </div>
                <p>
                <em>
                    <strong>Kinh nghiệm:</strong> Nếu mua vàng miếng để đầu tư, nên ưu tiên SJC. Nếu mua vàng nhẫn, trang sức có thể chọn DOJI, PNJ, Bảo Tín Minh Châu... tùy nhu cầu và sở thích.
                </em>
                </p>
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq6">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                6. Vàng có bị đánh thuế không?
            </button>
            </h2>
            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="faq6" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                <p>
                <strong>Đối với cá nhân:</strong> Khi mua bán vàng miếng, vàng trang sức nhỏ lẻ tại Việt Nam, bạn <span class="text-success">không phải đóng thuế thu nhập cá nhân</span>. Tuy nhiên, nếu giao dịch với số lượng lớn, hoặc là doanh nghiệp kinh doanh vàng thì phải tuân thủ các quy định về thuế, hóa đơn của Nhà nước.
                </p>
                <ul>
                <li>
                    <strong>Doanh nghiệp:</strong> Phải kê khai, nộp thuế giá trị gia tăng (VAT), thuế thu nhập doanh nghiệp, xuất hóa đơn theo quy định.
                </li>
                <li>
                    <strong>Nhập khẩu vàng:</strong> Chịu thuế nhập khẩu, thuế giá trị gia tăng và các loại phí liên quan.
                </li>
                </ul>
                <div class="text-center my-3">
                <img src="{{ asset('images/thue-vang.jpg') }}" alt="Thuế vàng" class="img-fluid rounded shadow" style="max-width: 220px;">
                <div class="small text-muted mt-2">Hình minh họa: Giao dịch vàng tại cửa hàng</div>
                </div>
                <p>
                <em>
                    <strong>Lưu ý:</strong> Khi bán vàng với số lượng lớn, ngân hàng hoặc tiệm vàng có thể yêu cầu bạn xuất trình giấy tờ cá nhân để đảm bảo minh bạch nguồn gốc.
                </em>
                </p>
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq7">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                7. Giá vàng thay đổi bao lâu một lần?
            </button>
            </h2>
            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="faq7" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                <p>
                <strong>Giá vàng có thể thay đổi liên tục trong ngày</strong>, đặc biệt là tại các thành phố lớn hoặc các thương hiệu lớn như SJC, DOJI, PNJ. Giá vàng trong nước thường được cập nhật theo giá vàng thế giới (London, New York) và biến động theo tỷ giá USD/VND, cung cầu thị trường.
                </p>
                <ul>
                <li>
                    <strong>Giá vàng thế giới:</strong> Biến động theo từng phút, từng giờ.
                </li>
                <li>
                    <strong>Giá vàng trong nước:</strong> Các doanh nghiệp lớn cập nhật giá nhiều lần/ngày, thường vào đầu giờ sáng, trưa, chiều hoặc khi có biến động mạnh.
                </li>
                </ul>
                <div class="text-center my-3">
                <img src="{{ asset('images/bang-gia-vang.jpg') }}" alt="Bảng giá vàng" class="img-fluid rounded shadow" style="max-width: 320px;">
                <div class="small text-muted mt-2">Bảng giá vàng cập nhật liên tục tại cửa hàng</div>
                </div>
                <p>
                <em>
                    <strong>Kinh nghiệm:</strong> Nếu muốn mua/bán vàng với giá tốt, nên theo dõi giá vàng thường xuyên trên các website uy tín hoặc ứng dụng của các thương hiệu lớn.
                </em>
                </p>
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq8">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                8. Vàng trắng là gì?
            </button>
            </h2>
            <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="faq8" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                <p>
                <strong>Vàng trắng</strong> là hợp kim giữa vàng nguyên chất (vàng 24K hoặc 18K) với các kim loại trắng như niken, palladium, bạc... tạo nên màu trắng sáng, hiện đại. Vàng trắng thường được dùng để chế tác trang sức cao cấp, đặc biệt là nhẫn cưới, nhẫn đính hôn.
                </p>
                <ul>
                <li>
                    <strong>Không phải bạch kim (platinum):</strong> Vàng trắng và bạch kim là hai loại kim loại khác nhau, bạch kim đắt hơn và nặng hơn vàng trắng.
                </li>
                <li>
                    <strong>Ưu điểm:</strong> Đẹp, sáng, sang trọng, phù hợp với nhiều kiểu dáng trang sức hiện đại.
                </li>
                <li>
                    <strong>Nhược điểm:</strong> Sau thời gian sử dụng có thể bị ngả màu vàng nhạt, cần xi mạ lại lớp rhodium để giữ màu trắng sáng.
                </li>
                </ul>
                <div class="text-center my-3">
                <img src="{{ asset('images/vang-trang.jpg') }}" alt="Vàng trắng" class="img-fluid rounded shadow" style="max-width: 180px;">
                <div class="small text-muted mt-2">Trang sức vàng trắng hiện đại</div>
                </div>
                <p>
                <em>
                    <strong>Lưu ý:</strong> Khi mua vàng trắng, nên hỏi rõ về tuổi vàng (18K, 14K...) và chế độ bảo hành xi mạ để giữ trang sức luôn sáng đẹp.
                </em>
                </p>
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq9">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                9. Có nên mua vàng online không?
            </button>
            </h2>
            <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="faq9" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                <p>
                <strong>Mua vàng online</strong> là xu hướng hiện đại, tiện lợi, giúp bạn tiết kiệm thời gian và dễ dàng so sánh giá. Tuy nhiên, để đảm bảo an toàn, bạn nên:
                </p>
                <ul>
                <li>
                    Chỉ mua tại các <span class="text-success">thương hiệu lớn, uy tín</span> như SJC, DOJI, PNJ, Bảo Tín Minh Châu... có website hoặc ứng dụng chính thức.
                </li>
                <li>
                    Kiểm tra kỹ thông tin đơn hàng, hóa đơn, chính sách giao nhận và bảo hiểm hàng hóa.
                </li>
                <li>
                    Một số nơi hỗ trợ <strong>mua vàng online và giữ hộ vàng</strong> tại ngân hàng hoặc kho an toàn, bạn có thể rút vàng vật chất bất cứ lúc nào.
                </li>
                </ul>
                <div class="text-center my-3">
                <img src="{{ asset('images/mua-vang-online.jpg') }}" alt="Mua vàng online" class="img-fluid rounded shadow" style="max-width: 220px;">
                <div class="small text-muted mt-2">Giao diện mua vàng online trên ứng dụng</div>
                </div>
                <p>
                <em>
                    <strong>Lưu ý:</strong> Tránh mua vàng qua các trang web, mạng xã hội không rõ nguồn gốc để phòng ngừa rủi ro lừa đảo.
                </em>
                </p>
            </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="faq10">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                10. Giá vàng có tăng theo thời gian không?
            </button>
            </h2>
            <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="faq10" data-bs-parent="#faqAccordion">
            <div class="accordion-body">
                <p>
                <strong>Giá vàng có xu hướng tăng về dài hạn</strong>, đặc biệt trong bối cảnh lạm phát, bất ổn kinh tế hoặc khủng hoảng tài chính. Tuy nhiên, trong ngắn hạn, giá vàng có thể biến động mạnh theo thị trường thế giới, tỷ giá, chính sách tiền tệ...
                </p>
                <ul>
                <li>
                    <strong>Thống kê lịch sử:</strong> Trong 10-20 năm qua, giá vàng đã tăng gấp nhiều lần so với trước đây.
                </li>
                <li>
                    <strong>Ngắn hạn:</strong> Giá vàng có thể giảm hoặc tăng mạnh trong thời gian ngắn, không ổn định như gửi tiết kiệm.
                </li>
                <li>
                    <strong>Đầu tư dài hạn:</strong> Vàng là kênh giữ giá trị tài sản an toàn, phòng ngừa rủi ro lạm phát.
                </li>
                </ul>
                <div class="text-center my-3">
                <img src="{{ asset('images/bieu-do-gia-vang.jpg') }}" alt="Biểu đồ giá vàng" class="img-fluid rounded shadow" style="max-width: 320px;">
                <div class="small text-muted mt-2">Biểu đồ: Giá vàng tăng trưởng qua các năm</div>
                </div>
                <p>
                <em>
                    <strong>Kết luận:</strong> Nếu bạn đầu tư dài hạn, vàng là lựa chọn an toàn. Tuy nhiên, hãy cân nhắc kỹ khi đầu tư ngắn hạn vì giá có thể biến động mạnh.
                </em>
                </p>
            </div>
            </div>
        </div>
    </div>
</div>

@endsection('content')