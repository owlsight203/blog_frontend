<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http; 

class BlogController extends Controller
{
    private $apiUrl;

    public function __construct()
    {
        // Đọc từ biến môi trường, nếu không có thì fallback về localhost (để test khi chạy local)
        $this->apiUrl = env('DJANGO_API_URL', 'http://127.0.0.1:8000');
    }

    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $userId = auth()->id();

        $response = Http::get("{$this->apiUrl}/", [
            'page' => $page,
            'user_id' => $userId
        ]);

        if ($response->failed()) {
            return response()->json(['error' => 'Không thể kết nối đến Django API'], 500);
        }

        $data = $response->json();

        return view('posts.index', [
            'posts' => $data['data'],
            'currentPage' => $data['current_page'],
            'lastPage' => $data['last_page']
        ]);
    }

    public function detail($id)
    {
        $userId = auth()->id();
        
        $response = Http::get("{$this->apiUrl}/{$id}/", [
            'user_id' => $userId 
        ]);

        
        if ($response->status() === 403) {
            return redirect()->route('index')->with('error', 'Bài viết này ở chế độ riêng tư.');
        }

        if ($response->failed()) {
            abort(404, 'Bài viết không tồn tại hoặc lỗi API');
        }

        $data = $response->json();

        return view('posts.detail', [
            'post'     => $data['post'],
            'comments' => $data['comments']
        ]);
    }
    

    public function storeComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string',
            'ai_type' => 'required|string|in:gemini,openrouter',
        ]);

        try {
            
            $postResponse = Http::get("{$this->apiUrl}/{$id}/");

            if ($postResponse->failed()) {
                return redirect()->back()->withErrors(['error' => 'Không thể xác thực thông tin bài viết để kích hoạt AI.']);
            }

            $postData = $postResponse->json();
            $blogTitle = $postData['post']['title'] ?? '';
            
            $blogContent = $postData['post']['description'] ?? '';

            $response = Http::timeout(25)->post("{$this->apiUrl}/{$id}/comment/", [
                'content'      => $request->content,
                'ai_type'      => $request->ai_type,
                'user_id'      => 1,
                
                'post_title'   => $blogTitle,
                'post_content' => $blogContent,
            ]);

            if ($response->successful()) {
                return redirect()->back()->with('success', 'Đăng bình luận thành công và AI đã phản hồi!');
            }

            $errorMsg = $response->json('error') ?? 'Không thể gửi bình luận, hệ thống AI đang bận.';
            return redirect()->back()->withErrors(['error' => $errorMsg]);

        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Hệ thống AI đang phản hồi chậm, vui lòng thử lại sau.']);
        }
    }

    public function picai(Request $request)
    {
        $page = $request->query('page', 1);

        $response = Http::get("{$this->apiUrl}/picai/?page={$page}");

        if ($response->failed()) {
            return response()->json(['error' => 'Không thể kết nối đến API picAI'], 500);
        }

        $data = $response->json();

        return view('posts.picai', [
            'pics' => $data['data'],
            'currentPage' => $data['current_page'],
            'lastPage' => $data['last_page']
        ]);
    }

    public function profile()
    {
        $response = Http::get("{$this->apiUrl}/about/profile/");

        if ($response->failed()) {
            abort(500, 'Không thể tải thông tin profile');
        }

        $data = $response->json();
        
        return view('posts.profile', [
            'anonymous' => $data['anonymous'],
            'profile' => $data['profile']
        ]);
    }

    public function contact()
    {
        return view('posts.contact');
    }
}