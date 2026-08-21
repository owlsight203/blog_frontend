<!DOCTYPE html>
<html lang="vi" data-bs-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Thêm Font Awesome 6 CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-body-tertiary">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('index') }}">
                <i class="fa-solid fa-blog me-2"></i>My Blog
            </a>
            <div class="navbar-nav align-items-center flex-row">
                <a class="nav-link active fw-bold me-3" href="{{ route('index') }}">
                    <i class="fa-solid fa-house me-1"></i>Trang chủ
                </a>
                <a class="nav-link fw-bold me-3" href="{{ route('picai') }}">
                    <i class="fa-solid fa-wand-magic-sparkles me-1"></i>Ảnh AI
                </a>
                
                <!-- Nút chuyển đổi Dark/Light mode -->
                <button class="btn btn-outline-light btn-sm" id="btnSwitch" type="button">
                    <i class="fa-solid fa-moon me-1"></i> Dark Mode
                </button>
            </div>
        </div>
    </nav>

    <!-- Bắt đầu phần nội dung chính -->
    <div class="container py-4">
        <h1 class="mb-4">
            <i class="fa-solid fa-list-ul me-2"></i>Danh sách bài viết
        </h1>
        
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $post['img_thumbnail'] }}" class="card-img-top" alt="{{ $post['title'] }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $post['title'] }}</h5>
                                @isset($post['status'])
                                    @if($post['status'] == 'private')
                                        <span class="badge bg-secondary">
                                            <i class="fa-solid fa-lock me-1"></i>Private
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="fa-solid fa-globe me-1"></i>Public
                                        </span>
                                    @endif
                                @endisset
                            </div>
                            <p class="text-muted small">
                                <i class="fa-solid fa-user-pen me-1"></i>Tác giả: {{ $post['author'] }}
                            </p>
                            <div class="card-text text-truncate" style="max-height: 100px;">
                                {!! $post['description'] !!}
                            </div>
                            <a href="{{ route('detail', ['id' => $post['id']]) }}" class="btn btn-dark btn-sm mt-3" name="btn-detail-blog">
                                <i class="fa-solid fa-arrow-right me-1"></i>Xem chi tiết
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <nav class="mt-4">
            <ul class="pagination">
                @if($currentPage > 1)
                    <li class="page-item">
                        <a class="page-link" href="?page={{ $currentPage - 1 }}">
                            <i class="fa-solid fa-chevron-left me-1"></i>Trang trước
                        </a>
                    </li>
                @endif
                
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="fa-solid fa-file-lines me-1"></i>Trang {{ $currentPage }} / {{ $lastPage }}
                    </span>
                </li>

                @if($currentPage < $lastPage)
                    <li class="page-item">
                        <a class="page-link" href="?page={{ $currentPage + 1 }}">
                            Trang sau <i class="fa-solid fa-chevron-right ms-1"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const btnSwitch = document.getElementById('btnSwitch');
        const htmlElement = document.documentElement;

        const savedTheme = localStorage.getItem('theme') || 'light';
        setTheme(savedTheme);

        btnSwitch.addEventListener('click', () => {
            const currentTheme = htmlElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            setTheme(newTheme);
            localStorage.setItem('theme', newTheme);
        });

        function setTheme(theme) {
            htmlElement.setAttribute('data-bs-theme', theme);
            if (theme === 'dark') {
                btnSwitch.innerHTML = '<i class="fa-solid fa-sun me-1"></i> Light Mode';
                btnSwitch.classList.replace('btn-outline-light', 'btn-outline-warning');
            } else {
                btnSwitch.innerHTML = '<i class="fa-solid fa-moon me-1"></i> Dark Mode';
                btnSwitch.classList.replace('btn-outline-warning', 'btn-outline-light');
            }
        }
    </script>
</body>
</html>