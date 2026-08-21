<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Cá Nhân</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-body-tertiary">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index') }}">My Blog</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('index') }}">Trang chủ</a>
                <a class="nav-link" href="{{ route('picai') }}">Ảnh AI</a>
                <a class="nav-link active" href="{{ route('profile') }}">Profile</a>
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
                                <img src="http://127.0.0.1:8000{{ $profile['image'] }}" class="rounded-circle img-thumbnail shadow-sm" alt="Avatar" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff;">
                            @else
                                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" class="rounded-circle img-thumbnail shadow-sm" alt="Default Avatar" style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff;">
                            @endif
                        </div>

                        <h4 class="fw-bold mb-1 text-dark">
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

</body>
</html>