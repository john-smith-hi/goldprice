<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Dashboard - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <style>
        html, body { height: 100%; margin: 0; overflow-x: hidden; }
        body { display: flex; flex-direction: column; min-height: 100vh; }
        #sidebar-wrapper { min-height: 100vh; width: 250px; position: fixed; top: 0; left: 0; z-index: 1000; background: #343a40; color: white; transition: transform 0.3s; }
        #sidebar-wrapper .sidebar-heading { padding: 0.875rem 1.25rem; font-size: 1.2rem; border-bottom: 1px solid rgba(255,255,255,0.1); }
        #sidebar-wrapper .list-group { width: 250px; }
        #page-content-wrapper { min-width: 100vw; margin-left: 250px; transition: all 0.3s; flex: 1; display: flex; flex-direction: column; min-height: 100vh; padding: 20px; overflow-x: hidden; }
        #wrapper.toggled #sidebar-wrapper { transform: translateX(-250px); }
        #wrapper.toggled #page-content-wrapper { margin-left: 0; }
        .list-group-item { border: none; padding: 0.75rem 1.25rem; color: white; background: #343a40; }
        .list-group-item:hover { background: rgba(255,255,255,0.1); }
        .list-group-item.active { background: rgba(255,255,255,0.2); }
        #menu-toggle { position: fixed; top: 10px; left: 10px; z-index: 1001; background: #343a40; border: none; color: white; padding: 10px; border-radius: 4px; cursor: pointer; display: block !important; }
        #menu-toggle:hover { background: #23272b; }
        #menu-toggle i { font-size: 1.2rem; }
        #menu-toggle-desktop { margin-left: auto; background: none; border: none; color: white; cursor: pointer; padding: 0; font-size: 1.2rem; }
        main { flex: 1 0 auto; width: 85%; margin: 0 0; padding: 0; transition: width 0.3s; }
        #wrapper.toggled main { width: 100%; }
        .container-fluid { max-width: 1600px; width: 100%; padding: 0 15px; }
        .card { margin-bottom: 20px; width: 100%; }
        .table-responsive { margin: 0; padding: 0; width: 100%; overflow-x: auto; }
        .table { margin-bottom: 0; width: 100%; }
        .table td, .table th { white-space: nowrap; padding: 0.75rem 0.5rem; }
        .table th:first-child, .table td:first-child { min-width: 50px; }
        .table th:last-child, .table td:last-child { min-width: 120px; }
        .card-body { padding: 1rem; width: 100%; }
        .table-container { width: 100%; overflow-x: auto; }
        footer { flex-shrink: 0; width: 100%; padding: 1.5rem 0; }
        .dataTables_wrapper .dataTables_length select { width: 60px; display: inline-block; }
        .dataTables_wrapper .dataTables_filter input { width: 200px; margin-left: 10px; }
        .dataTables_wrapper .dataTables_info { padding-top: 0.85em; }
        .dataTables_wrapper .dataTables_paginate { padding-top: 0.25em; }
        .table.dataTable { margin-bottom: 1em !important; }
        .container-fluid { margin: 0 !important; }
        @media (max-width: 768px) {
            #sidebar-wrapper { transform: translateX(-250px); }
            #page-content-wrapper { margin-left: 0; padding: 10px; }
            #wrapper.toggled #sidebar-wrapper { transform: translateX(0); }
            #wrapper.toggled #page-content-wrapper { margin-left: 250px; }
            #menu-toggle { display: block !important; }
            #menu-toggle-desktop { display: none !important; }
            #wrapper.toggled #menu-toggle { left: 260px; transition: left 0.3s; }
            .container-fluid { padding: 0 10px; }
            .table td, .table th { padding: 0.5rem 0.25rem; }
            .card-body { padding: 0.75rem; }
            main { width: 100%; }
            #wrapper.toggled main { width: 85%; }
        }
        @media (min-width: 769px) {
            #menu-toggle { display: none !important; }
            #menu-toggle-desktop { display: block !important; }
            #wrapper.toggled #menu-toggle-desktop i::before { content: "\f0c9"; }
            #sidebar-wrapper .sidebar-heading { justify-content: space-between; }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="d-flex" id="wrapper">
        <!-- Menu Toggle Button -->
        <button id="menu-toggle" class="d-md-none">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar -->
        <div class="bg-dark text-white" id="sidebar-wrapper">
            <div class="sidebar-heading d-flex justify-content-between align-items-center px-3 py-4">
                <span>Admin Panel</span>
            </div>
            <div class="list-group list-group-flush">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                </a>
                <a href="{{ route('admin.companies.index') }}" class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin.companies.*') ? 'active' : '' }}">
                    <i class="fas fa-building me-2"></i> Công ty
                </a>
                <a href="{{ route('admin.type-gold.index') }}" class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin.type-gold.*') ? 'active' : '' }}">
                    <i class="fas fa-coins me-2"></i> Loại vàng
                </a>
                <a href="{{ route('admin.prices.index') }}" class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin.prices.*') ? 'active' : '' }}">
                    <i class="fas fa-dollar-sign me-2"></i> Giá vàng
                </a>
                <a href="{{ route('admin.currencies.index') }}" class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin.currencies.*') ? 'active' : '' }}">
                    <i class="fas fa-exchange-alt me-2"></i> Tỷ giá
                </a>
                <a href="{{ route('admin.settings.index') }}" class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog me-2"></i> Cài đặt
                </a>
                <a href="{{ route('admin.notifications.index') }}" class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin.notifications.*') ? 'active' : '' }}">
                    <i class="fas fa-bell me-2"></i> Thông báo
                </a>
                <a href="{{ route('admin.access-logs.index') }}" class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin.access-logs.*') ? 'active' : '' }}">
                    <i class="fas fa-history me-2"></i> Lịch sử truy cập
                </a>
                <a href="{{ route('admin.auto-bots.index') }}" class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin.auto-bots.*') ? 'active' : '' }}">
                    <i class="fas fa-robot me-2"></i> Auto Bot
                </a>
                <a href="{{ route('admin.feedback') }}" class="list-group-item list-group-item-action bg-dark text-white {{ request()->routeIs('admin.feedback') ? 'active' : '' }}">
                    <i class="fas fa-comments me-2"></i> Phản hồi
                </a>
            </div>
        </div>

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <!-- Main Content -->
            <main>
                @yield('content')
            </main>

            <!-- Footer -->
            <footer class="bg-dark text-light py-4 mt-auto">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Admin Dashboard</h5>
                            <p>Quản lý nội dung website và phản hồi người dùng</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p>&copy; {{ date('Y') }} Gold Price. All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('menu-toggle');
            const wrapper = document.getElementById('wrapper');
            
            // Xử lý sự kiện click cho nút toggle (luôn hiển thị)
            if (menuToggle) {
                menuToggle.addEventListener('click', function(e) {
                    e.preventDefault();
                    wrapper.classList.toggle('toggled');
                });
            }

            // Khởi tạo DataTables cho tất cả các bảng có class .datatable
            $('.datatable').DataTable({
                responsive: true,
                language: {
                    "sProcessing": "Đang xử lý...",
                    "sLengthMenu": "Xem _MENU_ mục",
                    "sZeroRecords": "Không tìm thấy dòng nào phù hợp",
                    "sInfo": "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                    "sInfoEmpty": "Đang xem 0 đến 0 trong tổng số 0 mục",
                    "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                    "sInfoPostFix": "",
                    "sSearch": "Tìm:",
                    "sUrl": "",
                    "oPaginate": {
                        "sFirst": "Đầu",
                        "sPrevious": "Trước",
                        "sNext": "Tiếp",
                        "sLast": "Cuối"
                    }
                },
                pageLength: 25,
                lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tất cả"]],
                order: [[0, 'desc']]
            });
        });
    </script>
    @yield('scripts')
</body>
</html> 