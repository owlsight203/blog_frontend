<!DOCTYPE html>
<html lang="vi" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bộ Sưu Tập Ảnh AI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fw-bold mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('index') }}">My Blog</a>
            <div class="navbar-nav align-items-center flex-row">
                <a class="nav-link fw-bold me-3" href="{{ route('index') }}">Trang chủ</a>
                <a class="nav-link active fw-bold me-3" href="{{ route('picai') }}">Ảnh AI</a>
                
                <!-- Nút chuyển đổi Dark/Light mode -->
                <button class="btn btn-outline-light btn-sm" id="btnSwitch" type="button">
                    🌙 Dark Mode
                </button>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold">Danh sách ảnh tạo bởi AI</h1>
            <a href="{{ route('index') }}" class="btn btn-dark btn-sm">Xem Bài Viết Blog</a>
        </div>

        <div class="row">
            @if(count($pics) > 0)
                @foreach($pics as $pic)
                    <div class="col-md-3 col-sm-6 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <img src="{{ $pic['img_AI'] }}" class="card-img-top" alt="AI Image" style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <p class="card-text text-muted small text-truncate-2" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 40px;">
                                    {{ $pic['description'] ?? 'Không có mô tả cho ảnh này.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12 text-center py-5">
                    <p class="text-muted fs-5">Hiện tại chưa có dữ liệu hình ảnh AI nào.</p>
                </div>
            @endif
        </div>

        @if($lastPage > 1)
            <nav class="d-flex justify-content-center mt-4">
                <ul class="pagination shadow-sm">
                    <li class="page-item {{ $currentPage <= 1 ? 'disabled' : '' }}">
                        <a class="page-link" href="?page={{ $currentPage - 1 }}">Trang trước</a>
                    </li>
                    
                    <li class="page-item disabled">
                        <span class="page-link fw-bold">Trang {{ $currentPage }} / {{ $lastPage }}</span>
                    </li>

                    <li class="page-item {{ $currentPage >= $lastPage ? 'disabled' : '' }}">
                        <a class="page-link" href="?page={{ $currentPage + 1 }}">Trang sau</a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script xử lý Dark/Light Mode đồng bộ localStorage -->
    <script>
        const btnSwitch = document.getElementById('btnSwitch');
        const htmlElement = document.documentElement;

        // 1. Lấy trạng thái theme đã lưu từ trước
        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);

        // 2. Bắt sự kiện click vào nút
        btnSwitch.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            setTheme(newTheme);
            localStorage.setItem('theme', newTheme);
        });

        // 3. Hàm cập nhật giao diện
        function setTheme(theme) {
            htmlElement.setAttribute('data-bs-theme', theme);
            if (theme === 'dark') {
                btnSwitch.textContent = '☀️ Light Mode';
                btnSwitch.classList.replace('btn-outline-light', 'btn-outline-warning');
            } else {
                btnSwitch.textContent = '🌙 Dark Mode';
                btnSwitch.classList.replace('btn-outline-warning', 'btn-outline-light');
            }
        }
    </script>
</body>
</html>