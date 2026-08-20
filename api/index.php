<?php
	try {
	    // Forward Vercel requests to Laravel public index.php
	    require __DIR__ . '/../public/index.php';
	} catch (\Throwable $e) {
	    // In ra lỗi chi tiết nếu Laravel gặp vấn đề khởi chạy
	    echo "<h1>Laravel Bootstrap Error:</h1>";
	    echo "<pre>" . htmlspecialchars($e->getMessage()) . "\n\n" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
	}

?>