<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/Student.php';
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/DonHang.php';
require_once './models/LienHe.php';

// Route
$act = $_GET['act'] ?? '/';
// var_dump($_GET['act'] ?? '/');

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    '/' => (new HomeController())->home(),
    // 'trangchu' => (new HomeController())->trangchu(),
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),

    // auth
    'login' => (new HomeController())->formLogin(),
    'check-login' => (new HomeController())->postLogin(),
    'logout' => (new HomeController())->logout(),
    'signup' => (new HomeController())->formSignup(),
    'post-signup' => (new HomeController())->postSignup(),

    'them-gio-hang' => (new HomeController())->addGioHang(),
    'gio-hang' => (new HomeController())->gioHang(),
    'xoa-gio-hang' => (new HomeController())->xoaGioHang(),
    'cap-nhat-gio-hang' => (new HomeController())->capNhatGioHang(),
    'thanh-toan' => (new HomeController())->thanhToan(),
    'xu-ly-thanh-toan' => (new HomeController())->postThanhToan(),
    'lich_su_mua_hang' => (new HomeController())->lichSuMuaHang(),
    'chi_tiet_mua_hang' => (new HomeController())->chiTietMuaHang(),
    'huy_don_hang' => (new HomeController())->huyDonHang(),


    'products' => (new HomeController())->Products(),
    'gioi-thieu' => (new HomeController())->gioiThieu(),
    'tin-tuc' => (new HomeController())->news(),
    'tin-tuc-chi-tiet' => (new HomeController())->newsDetail(),
    
    'thong-tin-ca-nhan' => (new HomeController())->thongTinCaNhan(),
    'update-profile' => (new HomeController())->updateProfile(),
    'lien_he' => (new HomeController())->lienHe(),
    'post-lien-he' => (new HomeController())->postLienHe(),
    'dashboard' => (new HomeController())->dashboard(),

    'post-danh-gia' => (new HomeController())->postDanhGia(),
    'post-binh-luan' => (new HomeController())->postBinhLuan(),
};