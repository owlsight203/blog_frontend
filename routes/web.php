<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

// Trang chủ danh sách bài viết
Route::get('/', [BlogController::class, 'index'])->name('index');

// Chi tiết bài viết (chỉ nhận số nguyên id)
Route::get('/post/{id}', [BlogController::class, 'detail'])->name('detail')->where('id', '[0-9]+');

// Trang liên hệ
Route::get('/contact', [BlogController::class, 'contact'])->name('contact');

// Trang thông tin cá nhân
Route::get('/about/profile', [BlogController::class, 'profile'])->name('profile');

// Trang danh sách ảnh AI
Route::get('/picai', [BlogController::class, 'picai'])->name('picai');

// Route xử lý gửi bình luận lên bài viết (nhận cả lựa chọn AI)
Route::post('/post/{id}/comment', [BlogController::class, 'storeComment'])->name('comment.store')->where('id', '[0-9]+');
?>