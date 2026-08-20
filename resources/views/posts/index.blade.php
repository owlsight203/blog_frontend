<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Laravel Frontend Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <nav class="navbar navbar-default navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">My Blog</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('index') }}">Trang chủ</a>
                <a class="nav-link" href="{{ route('picai') }}">Ảnh AI</a>
            </div>
        </div>
    </nav>
    <h1 class="mb-4">Danh sách bài viết từ Django API</h1>
    
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
                                    <span class="badge bg-secondary">🔒 Private</span>
                                @else
                                    <span class="badge bg-success">🌐 Public</span>
                                @endif
                            @endisset
                        </div>
                        <p class="text-muted small">Tác giả: {{ $post['author'] }}</p>
                        <div class="card-text text-truncate" style="max-height: 100px;">
                            {!! $post['description'] !!}
                        </div>
                        <a href="{{ route('detail', ['id' => $post['id']]) }}" class="btn btn-primary btn-sm mt-3" name="btn-detail-blog">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <nav class="mt-4">
        <ul class="pagination">
            @if($currentPage > 1)
                <li class="page-item"><a class="page-link" href="?page={{ $currentPage - 1 }}">Trang trước</a></li>
            @endif
            
            <li class="page-item disabled"><span class="page-link">Trang {{ $currentPage }} / {{ $lastPage }}</span></li>

            @if($currentPage < $lastPage)
                <li class="page-item"><a class="page-link" href="?page={{ $currentPage + 1 }}">Trang sau</a></li>
            @endif
        </ul>
    </nav>
</div>
</body>
</html>