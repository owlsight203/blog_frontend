<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bộ Sưu Tập Ảnh AI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fw-bold mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('index') }}">My Blog</a>
            <div class="navbar-nav">
                <a class="nav-link fw-bold" href="{{ route('index') }}">Trang chủ</a>
                <a class="nav-link active fw-bold" href="{{ route('picai') }}">Ảnh AI</a>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="fw-bold text-dark">Danh sách ảnh tạo bởi AI</h1>
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
                        <span class="page-link text-dark fw-bold">Trang {{ $currentPage }} / {{ $lastPage }}</span>
                    </li>

                    <li class="page-item {{ $currentPage >= $lastPage ? 'disabled' : '' }}">
                        <a class="page-link" href="?page={{ $currentPage + 1 }}">Trang sau</a>
                    </li>
                </ul>
            </nav>
        @endif
    </div>

</body>
</html>