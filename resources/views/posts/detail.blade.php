<!DOCTYPE html>
<html lang="vi" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $post['title'] }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-body-tertiary">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('index') }}">My Blog</a>
            <div class="navbar-nav align-items-center flex-row">
                <a class="nav-link fw-bold me-3" href="{{ route('index') }}">Trang chủ</a>
                <a class="nav-link fw-bold me-3" href="{{ route('picai') }}">Ảnh AI</a>
                
                <!-- Nút chuyển đổi Dark/Light mode -->
                <button class="btn btn-outline-light btn-sm" id="btnSwitch" type="button">
                    🌙 Dark Mode
                </button>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <a href="{{ route('index') }}" class="btn btn-outline-secondary btn-sm mb-3">&larr; Quay lại danh sách</a>

                <div class="card shadow-sm p-4 rounded mb-4">
                    <h1 class="display-5 fw-bold mb-3">{{ $post['title'] }}</h1>
                    
                    <p class="text-muted small mb-4">
                        Đăng bởi: <strong>{{ $post['author'] }}</strong> 
                        @if(isset($post['created_at']))
                            | Ngày đăng: {{ date('d/m/Y', strtotime($post['created_at'])) }}
                        @endif
                    </p>

                    @if(!empty($post['img_thumbnail']))
                        <div class="text-center mb-4">
                            <img src="{{ $post['img_thumbnail'] }}" class="img-fluid rounded shadow-sm" alt="{{ $post['title'] }}" style="max-height: 450px; width: 100%; object-fit: cover;">
                        </div>
                    @endif

                    @if(!empty($post['tag']))
                        <div class="mb-4">
                            @foreach($post['tag'] as $t)
                                <span class="badge bg-secondary me-1">#{{ $t['name'] }}</span>
                            @endforeach
                        </div>
                    @endif

                    <hr>

                    <div class="blog-content mt-4" style="line-height: 1.8; font-size: 1.1rem;">
                        {!! $post['description'] !!}
                    </div>
                </div>

                <!-- 1. Thông báo trạng thái thành công hoặc lỗi từ Laravel -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                        {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- 2. Form gửi bình luận kèm lựa chọn API Bot AI -->
                <div class="card shadow-sm p-4 rounded mb-4">
                    <h3 class="h4 fw-bold mb-3">Viết bình luận</h3>
                    <form action="{{ route('comment.store', ['id' => $post['id']]) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <textarea class="form-control" name="content" rows="3" placeholder="Nhập nội dung thảo luận để kích hoạt bot AI phản hồi..." required></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label d-block fw-semibold text-muted small">HỆ THỐNG AI PHẢN HỒI:</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ai_type" id="ai_gemini" value="gemini" checked>
                                <label class="form-check-label" for="ai_gemini">Google Gemini (Trực tiếp)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="ai_type" id="ai_openrouter" value="openrouter">
                                <label class="form-check-label" for="ai_openrouter">OpenRouter (Gemini 2.5)</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Đăng bình luận</button>
                    </form>
                </div>

                <!-- 3. Khu vực render danh sách các bình luận cũ & mới -->
                <div class="card shadow-sm p-4 rounded">
                    <h3 class="h4 fw-bold mb-4">Thảo luận ({{ count($comments) }})</h3>
                    
                    @if(count($comments) > 0)
                        <div class="comment-list">
                            @foreach($comments as $comment)
                                @php
                                    $isBot = str_contains(strtolower($comment['author']['username']), 'bot');
                                @endphp
                                <div class="card mb-3 {{ $isBot ? 'border-info' : '' }}">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div>
                                                <strong class="{{ $isBot ? 'text-info fw-bold' : '' }}">
                                                    {{ $isBot ? '🤖 ' . $comment['author']['username'] : '@' . $comment['author']['username'] }}
                                                </strong>
                                            </div>
                                            <small class="text-muted text-end" style="font-size: 0.85rem;">
                                                {{ date('H:i - d/m/Y', strtotime($comment['created_at'])) }}
                                            </small>
                                        </div>
                                        <p class="card-text mb-0" style="white-space: pre-wrap; line-height: 1.6;">{{ $comment['content'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted my-2 text-center">Chưa có bình luận nào cho bài viết này.</p>
                    @endif
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