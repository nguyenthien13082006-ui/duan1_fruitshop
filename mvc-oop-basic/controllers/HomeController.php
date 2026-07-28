<?php

require_once 'models/SanPham.php';
class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;

    public $modelGioHang;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }

    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();
        require_once './views/home.php';
    }

    public function gioiThieu()
    {
        require_once './views/gioiThieu.php';
    }

    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);

        if ($sanPham) {
            require_once './views/detailSanPham.php';
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }
    function formLogin()
    {
        require_once './views/auth/formLogin.php';
        deleteSessionError();
        exit();
    }
    public function logout()
    {
        unset($_SESSION['user_client']);
        header("Location: " . BASE_URL . '?act=login');
        exit();
    }
    function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            if (is_array($user)) {
                $_SESSION['user_client'] = $user;

                header("Location: " . BASE_URL);
                exit();
            } else {
                $_SESSION['error'] = $user; // đảm bảo là string

                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL . '?act=login');
                exit();
            }
        }
    }

    function formSignup()
    {

        require_once './views/auth/formSingup.php';
        deleteSessionError();
        exit();
    }
    public function postSignup()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ten = $_POST['ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $ngay_sinh = $_POST['ngay_sinh'];
            $so_dien_thoai = $_POST['so_dien_thoai'];
            $dia_chi = $_POST['dia_chi'];

            // kiểm tra dữ liệu rỗng
            if (empty($ten) || empty($email) || empty($password) || empty($confirm_password)) {
                $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin";
                header("Location: " . BASE_URL . "?act=signup");
                exit();
            }

            // kiểm tra mật khẩu
            if ($password != $confirm_password) {
                $_SESSION['error'] = "Mật khẩu không trùng khớp";
                header("Location: " . BASE_URL . "?act=signup");
                exit();
            }

            // kiểm tra email tồn tại
            $checkEmail = $this->modelTaiKhoan->getTaiKhoanFromEmail($email);

            if ($checkEmail) {
                $_SESSION['error'] = "Email đã tồn tại";
                header("Location: " . BASE_URL . "?act=signup");
                exit();
            }

            // mã hóa mật khẩu
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);

            // thêm tài khoản
            $insert = $this->modelTaiKhoan->insertTaiKhoan(
                $ten,
                $email,
                $hashPassword,
                $ngay_sinh,
                $so_dien_thoai,
                $dia_chi
            );

            if ($insert) {
                $_SESSION['success'] = "Đăng ký thành công, hãy đăng nhập";
                header("Location: " . BASE_URL . "?act=login");
                exit();
            } else {
                $_SESSION['error'] = "Đăng ký thất bại";
                header("Location: " . BASE_URL . "?act=signup");
                exit();
            }
        }
    }
    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_SESSION['user_client']))
                $user = $_SESSION['user_client'];            //Lấy dữ liệu giỏ hàng của người dùng 
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            } else {
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            }
            $san_pham_id = $_POST['san_pham_id'];
            $so_luong = $_POST['so_luong'];

            $checkSanPham = false;
            foreach ($chiTietGioHang as $detail) {
                if ($detail['san_pham_id'] == $san_pham_id) {
                    $newSoluong = $detail['so_luong'] + $so_luong;
                    $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $newSoluong);
                    $checkSanPham = true;
                    break;
                }
            }
            if (!$checkSanPham) {
                $this->modelGioHang->addDetailGioHang($gioHang['id'], $san_pham_id, $so_luong);
            }
            header("Location: " . BASE_URL . '?act=gio-hang');
        } else {
        }
    }

    public function gioHang()
    {
        if (isset($_SESSION['user_client'])) {
            $user = $_SESSION['user_client'];

            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
            }

            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            require_once './views/gioHang.php';
        } else {
            header("Location: " . BASE_URL . '?act=login');
            exit();
        }
    }

    public function capNhatGioHang()
    {
        if (!isset($_SESSION['user_client'])) {
            header("Location: " . BASE_URL . '?act=login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_SESSION['user_client'];
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

            if ($gioHang && isset($_POST['so_luong']) && is_array($_POST['so_luong'])) {
                foreach ($_POST['so_luong'] as $san_pham_id => $so_luong) {
                    $so_luong = (int)$so_luong;
                    if ($so_luong > 0) {
                        $this->modelGioHang->updateSoLuong($gioHang['id'], $san_pham_id, $so_luong);
                    }
                }
            }
        }

        header("Location: " . BASE_URL . '?act=gio-hang');
        exit();
    }

    public function xoaGioHang()
    {
        if (!isset($_SESSION['user_client'])) {
            header("Location: " . BASE_URL . '?act=login');
            exit();
        }

        $user = $_SESSION['user_client'];
        $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

        if (!$gioHang) {
            header("Location: " . BASE_URL . '?act=gio-hang');
            exit();
        }

        $sanPhamId = $_GET['id_san_pham'] ?? null;
        if ($sanPhamId) {
            $this->modelGioHang->deleteDetailGioHangItem($gioHang['id'], $sanPhamId);
        }

        header("Location: " . BASE_URL . '?act=gio-hang');
        exit();
    }

    public function thanhToan()
    {
        if (isset($_SESSION['user_client'])) {
            $user = $_SESSION['user_client'];

            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);

            if (!$gioHang) {
                $gioHangId = $this->modelGioHang->addGioHang($user['id']);
                $gioHang = ['id' => $gioHangId];
            }

            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

            require_once './views/thanhToan.php';
        } else {
            header("Location: " . BASE_URL . '?act=login');
            exit();
        }
    }

    public function postThanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'] ?? null;

            $ngay_dat = date('Y-m-d');
            $trang_thai_id = 1;
            $ma_don_hang = 'DH-' . rand(1000, 9999);

            $user = $_SESSION['user_client'];
            $tai_khoan_id = $user['id'];

            // Thêm đơn hàng mới
            $donhang = $this->modelDonHang->addDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $tong_tien,
                $phuong_thuc_thanh_toan_id,
                $ngay_dat,
                $trang_thai_id,
                $ma_don_hang
            );

            if ($donhang) {
                // Lấy ra sản phẩm trong giỏ hàng hiện tại
                $gioHang = $this->modelGioHang->getGioHangFromUser($tai_khoan_id);
                $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);

                // Lưu từng sản phẩm vào chi tiết đơn hàng
                foreach ($chiTietGioHang as $item) {
                    $donGia = $item['gia_khuyen_mai'] ?? $item['gia_san_pham'];
                    $this->modelDonHang->addChiTietDonHang(
                        $donhang,
                        $item['san_pham_id'],
                        $donGia,
                        $item['so_luong'],
                        $donGia * $item['so_luong']
                    );
                    // 👉 TRỪ SỐ LƯỢNG KHO
                    $this->modelSanPham->giamSoLuong(
                        $item['san_pham_id'],
                        $item['so_luong']
                    );
                }



                // **Không xóa giỏ hàng** - giữ nguyên để tham khảo
                $this->modelGioHang->clearDetailGioHang($gioHang['id']);
                $this->modelGioHang->clearGioHang($tai_khoan_id);

                // Chuyển hướng về lịch sử mua hàng
                header("Location: " . BASE_URL . '?act=lich_su_mua_hang');
                exit();
            } else {
                echo "Đặt hàng thất bại. Vui lòng thử lại.";
            }
        }
    }




    public function lichSuMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            // Lấy ra thông tin tài khoản đăng nhập
            $user = $_SESSION['user_client'];
            $tai_khoan_id = $user['id'];

            // Lấy ra danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaIDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');


            // Lấy ra danh sách phương thức thanh toán
            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');


            // Lấy ra danh sách tất cả trạng thái của tài khoản
            $donHangs = $this->modelDonHang->getDonHangFromUser($tai_khoan_id);
            require_once "./views/lichSuMuaHang.php";
        } else {
            var_dump("Ban chua dang nhap");
            die;
        }
    }
    public function chiTietMuaHang()
    {
        if (isset($_SESSION['user_client'])) {
            // Lấy ra thông tin tài khoản đăng nhập
            $user = $_SESSION['user_client'];
            $tai_khoan_id = $user['id'];

            // Lấy id đơn hàng truyền từ URL
            $donHangId = $_GET['id'];


            // Lấy ra danh sách trạng thái đơn hàng
            $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaIDonHang();
            $trangThaiDonHang = array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id');


            // Lấy ra danh sách phương thức thanh toán
            $arrPhuongThucThanhToan = $this->modelDonHang->getPhuongThucThanhToan();
            $phuongThucThanhToan = array_column($arrPhuongThucThanhToan, 'ten_phuong_thuc', 'id');

            // Lấy ra thông tin đơn hàng theo ID
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            // Lấy thông tin sản phẩm của đơn hàng trong bảng chi tiết đơn hàng
            $chiTietDonHang = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);


            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền truy cập đơn hàng này.";
                exit;
            }

            require_once './views/chiTietMuaHang.php';
        } else {
            var_dump("Ban chua dang nhap");
            die;
        }
    }
    public function huyDonHang()
    {
        if (isset($_SESSION['user_client'])) {
            $user = $_SESSION['user_client'];
            $tai_khoan_id = $user['id'];
            $donHangId = $_GET['id'];
            $donHang = $this->modelDonHang->getDonHangById($donHangId);

            if ($donHang['tai_khoan_id'] != $tai_khoan_id) {
                echo "Bạn không có quyền hủy đơn hàng này";
                exit;
            }
            if ($donHang['trang_thai_id'] != 1) {
                echo "Chỉ đơn hàng ở trạng thái 'Chưa xác nhận' mới có thể hủy";
                exit;
            }
            // 🔥 LẤY CHI TIẾT ĐƠN HÀNG
            $chiTietDonHang = $this->modelDonHang->getChiTietDonHangByDonHangId($donHangId);

            // 🔥 CỘNG LẠI KHO
            foreach ($chiTietDonHang as $item) {
                $this->modelSanPham->tangSoLuong(
                    $item['san_pham_id'],
                    $item['so_luong']
                );
            }

            $this->modelDonHang->updateTrangThaiDonHang($donHangId, 11);
            header("Location: " . BASE_URL . '?act=lich_su_mua_hang');
            exit();
        } else {
            var_dump("Ban chua dang nhap");
            die;
        }
    }

    public function Products()
    {
        $keyword = trim($_GET['keyword'] ?? '');
        $danh_muc_id = $_GET['danh_muc_id'] ?? null;

        $listSanPham = $this->modelSanPham->searchSanPham($keyword, $danh_muc_id);
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();

        require_once './views/SanPham.php';
    }

    public function lienHe()
    {
        require_once './views/lienHe.php';
    }

    public function dashboard()
    {
        if (!isset($_SESSION['user_client'])) {
            header("Location: " . BASE_URL . '?act=login');
            exit;
        }

        $user = $_SESSION['user_client'];
        $taiKhoanId = $user['id'];

        $donHangs = $this->modelDonHang->getDonHangFromUser($taiKhoanId);
        $donHangs = is_array($donHangs) ? $donHangs : [];
        $arrTrangThaiDonHang = $this->modelDonHang->getTrangThaIDonHang();
        $trangThaiDonHang = is_array($arrTrangThaiDonHang)
            ? array_column($arrTrangThaiDonHang, 'ten_trang_thai', 'id')
            : [];

        $soDonHang = count($donHangs);
        $soDonChoXuLy = 0;
        $tongChiTieu = 0;
        $donGanDay = $donHangs;

        foreach ($donHangs as $donHang) {
            $trangThaiId = (int)($donHang['trang_thai_id'] ?? 0);
            $tongTienDon = (float)($donHang['tong_tien'] ?? 0);

            if (in_array($trangThaiId, [1, 2, 3], true)) {
                $soDonChoXuLy++;
            }

            if (!in_array($trangThaiId, [11], true)) {
                $tongChiTieu += $tongTienDon;
            }
        }

        usort($donGanDay, function ($a, $b) {
            return strtotime($b['ngay_dat'] ?? '') <=> strtotime($a['ngay_dat'] ?? '');
        });
        $donGanDay = array_slice($donGanDay, 0, 5);

        $gioHang = $this->modelGioHang->getGioHangFromUser($taiKhoanId);
        $chiTietGioHang = [];
        if ($gioHang && isset($gioHang['id'])) {
            $chiTietGioHang = $this->modelGioHang->getDetailGioHang($gioHang['id']);
            $chiTietGioHang = is_array($chiTietGioHang) ? $chiTietGioHang : [];
        }
        $soSanPhamTrongGio = 0;
        foreach ($chiTietGioHang as $item) {
            $soSanPhamTrongGio += (int)($item['so_luong'] ?? 0);
        }

        require_once './views/dashboard.php';
    }

    public function thongTinCaNhan()
    {
        if (!isset($_SESSION['user_client'])) {
            header("Location: " . BASE_URL . '?act=login');
            exit;
        }

        $email = $_SESSION['user_client']['email'];
        $user = $this->modelTaiKhoan->getUserByEmail($email);

        require_once './views/thongtin.php';
    }

    public function updateProfile()
    {
        if (!isset($_SESSION['user_client'])) {
            header("Location: " . BASE_URL . '?act=login');
            exit;
        }

        $email = $_SESSION['user_client']['email'];
        $ho_ten = $_POST['ho_ten'] ?? '';
        $so_dien_thoai = $_POST['so_dien_thoai'] ?? '';
        $dia_chi = $_POST['dia_chi'] ?? '';

        if (empty($ho_ten)) {
            $_SESSION['error'] = "Họ tên không được để trống";
            header("Location: " . BASE_URL . '?act=thong-tin-ca-nhan');
            exit;
        }

        $data = [
            'ho_ten' => $ho_ten,
            'so_dien_thoai' => $so_dien_thoai,
            'dia_chi' => $dia_chi,
            'email' => $email
        ];

        $this->modelTaiKhoan->updateUser($data);

        $_SESSION['success'] = "Cập nhật thành công";
        header("Location: " . BASE_URL . '?act=thong-tin-ca-nhan');
    }


    public function postBinhLuan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if (!isset($_SESSION['user_client'])) {


                header("Location: " . BASE_URL . '?act=login');
                exit();
            }

            $san_pham_id = $_POST['san_pham_id'];
            $noi_dung = trim($_POST['noi_dung']);

            if (empty($noi_dung)) {

                $_SESSION['error'] = ['Nội dung bình luận không được để trống'];

                header("Location: " . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
                exit();
            }

            $tai_khoan_id = $_SESSION['user_client']['id'];

            $this->modelSanPham->addBinhLuan(
                $san_pham_id,
                $tai_khoan_id,
                $noi_dung
            );

            header("Location: " . BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $san_pham_id);
            exit();
        }
    }
}
