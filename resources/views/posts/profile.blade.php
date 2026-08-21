<!DOCTYPE html>
<html lang="vi" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-body-tertiary">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('index') }}"><i class="fa-solid fa-blog me-2"></i>My Blog</a>
            <div class="navbar-nav align-items-center flex-row">
                <a class="nav-link fw-bold me-3" href="{{ route('index') }}"><i class="fa-solid fa-house me-1"></i>Trang chủ</a>
                <a class="nav-link fw-bold me-3" href="{{ route('picai') }}"><i class="fa-solid fa-wand-magic-sparkles me-1"></i>Ảnh AI</a>
                <a class="nav-link active fw-bold me-3" href="{{ route('profile') }}">Profile</a>
                
                <!-- Nút chuyển đổi Dark/Light mode -->
                <button class="btn btn-outline-light btn-sm" id="btnSwitch" type="button">
                    🌙 Dark Mode
                </button>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                
                <div class="card shadow border-0 rounded-4 overflow-hidden">
                    <div class="bg-primary py-5 text-center text-white">
                        <h3 class="fw-bold m-0">Hồ Sơ Nhà Phát Triển</h3>
                    </div>
                    
                    <div class="card-body text-center p-4" style="margin-top: -50px;">
                        
                        <div class="mb-3">
                            @if(!empty($profile['image']))
                                <img src="http://127.0.0.1:8000{{ $profile['image'] }}" class="rounded-circle img-thumbnail shadow-sm bg-body" alt="Avatar" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid var(--bs-body-bg);">
                            @else
                                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="rounded-circle img-thumbnail shadow-sm bg-body" alt="Default Avatar" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid var(--bs-body-bg);">
                            @endif
                        </div>

                        <!-- Gỡ bỏ text-dark cố định để Bootstrap tự đổi màu chữ khi bật Dark Mode -->
                        <h4 class="fw-bold mb-1">
                            {{ $profile['user']['username'] ?? 'Guest User' }}
                        </h4>
                        
                        <div class="mb-4">
                            @if($anonymous)
                                <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Chế độ: Khách (Anonymous)</span>
                            @else
                                <span class="badge bg-success px-3 py-2 rounded-pill">Đã xác thực tài khoản</span>
                            @endif
                        </div>

                        <hr class="my-4">

                        <div class="text-start px-3">
                            <h6 class="text-uppercase fw-bold text-muted small mb-2">Giới thiệu bản thân</h6>
                            <div class="card-text text-secondary" style="line-height: 1.6;">
                                @if(!empty($profile['description']))
                                    {!! $profile['description'] !!}
                                @else
                                    <p class="text-muted italic">Chưa có thông tin tiểu sử nào được cập nhật.</p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-4 pt-2">
                            <a href="{{ route('index') }}" class="btn btn-outline-primary btn-sm rounded-pill px-4 me-2">Về trang chủ</a>
                            <a href="mailto:contact@example.com" class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm">Liên hệ ngay</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
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