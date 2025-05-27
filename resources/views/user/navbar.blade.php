<nav class="navbar navbar-expand-lg bg-gold mb-4">
    <div class="container">
      <a class="navbar-brand fw-bold text-dark" href="/">
        <h2 class="m-0" style="font-size:1.5rem;">
          {{ Str::ucfirst(env('WEBSITE_NAME')) }}
        </h2>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/">
              <h2 class="d-inline m-0" style="font-size:1rem;">Trang chủ</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/faq">
              <h2 class="d-inline m-0" style="font-size:1rem;">Câu hỏi thường gặp</h2>
            </a>
          </li>
        </ul>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#feedbackModal">Góp ý</button>
      </div>
    </div>
</nav>