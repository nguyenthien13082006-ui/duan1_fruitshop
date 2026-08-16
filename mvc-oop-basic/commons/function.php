<?php

// Kết nối CSDL qua PDO
function connectDB()
{
    // Kết nối CSDL
    $host = DB_HOST;
    $port = DB_PORT;
    $dbname = DB_NAME;

    try {
        $conn = new PDO("mysql:host=$host;port=$port;dbname=$dbname", DB_USERNAME, DB_PASSWORD);

        // cài đặt chế độ báo lỗi là xử lý ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // cài đặt chế độ trả dữ liệu
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $conn;
    } catch (PDOException $e) {
        echo ("Connection failed: " . $e->getMessage());
    }
}

function productImageUrl($imagePath)
{
    if (empty($imagePath)) {
        return '';
    }

    if (preg_match('/^(https?:\/\/|\/\/|data:)/i', $imagePath)) {
        return $imagePath;
    }

    return BASE_URL . ltrim($imagePath, '/');
}


// Thêm file 
function uploadFile($file, $folderUpload)
{
    $pathStorage = $folderUpload . time() . $file['name'];

    $from = $file['tmp_name'];
    $to = PATH_ROOT . $pathStorage;

    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }
    return null;
}

// Xóa file 
function deleteFile($file)
{
    $pathDelete = PATH_ROOT . $file;
    if (file_exists($pathDelete)) {
        unlink($pathDelete);
    }
}

// Xóa session sau khi load trang 
function deleteSessionError()
{
    if (isset($_SESSION['flash'])) {
        // Hủy session sau khi đã tải trang 
        unset($_SESSION['flash']);
        unset($_SESSION['error']);
        // session_unset();
    }
}

// Upload - update album ảnh

function uploadFileAlbum($file, $folderUpload, $key)
{
    $pathStorage = $folderUpload . time() . $file['name'][$key];

    $from = $file['tmp_name'][$key];
    $to = PATH_ROOT . $pathStorage;

    if (move_uploaded_file($from, $to)) {
        return $pathStorage;
    }
    return null;
}


// format date 
function formatDate($date)
{
    if (empty($date) || $date === null) {
        return '';
    }
    $ts = strtotime($date);
    if ($ts === false) {
        return '';
    }
    return date("d-m-Y", $ts);
}

function checkLoginAdmin()
{
    if (!isset($_SESSION['user_admin'])) {
        header("Location: " . BASE_URL_ADMIN . '?act=login-admin');
        exit();
    }
}

function formatPrice($price)
{
    return number_format($price, 0, ',', '.');
}

function renderStarRating($rating, $max = 5)
{
    $rating = max(0, min((float)$rating, (float)$max));
    $fullStars = (int)floor($rating);
    $hasHalfStar = ($rating - $fullStars) >= 0.5;
    $emptyStars = $max - $fullStars - ($hasHalfStar ? 1 : 0);

    $html = '';
    for ($i = 0; $i < $fullStars; $i++) {
        $html .= '<i class="fa fa-star text-warning"></i>';
    }
    if ($hasHalfStar) {
        $html .= '<i class="fa fa-star-half-o text-warning"></i>';
    }
    for ($i = 0; $i < $emptyStars; $i++) {
        $html .= '<i class="fa fa-star-o text-muted"></i>';
    }

    return $html;
}
