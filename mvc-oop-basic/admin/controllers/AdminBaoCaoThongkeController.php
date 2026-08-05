<?php
class AdminBaoCaoThongKeController
{
    public $modelSanPham;
    public $modelDonHang;
    public $modelTaiKhoan;
    public $modelDanhMuc;

    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDonHang = new AdminDonHang();
        $this->modelTaiKhoan = new AdminTaiKhoan();
        $this->modelDanhMuc = new AdminDanhMuc();
    }

    public function home()
    {
        $sanPhams = $this->modelSanPham->getAllSanPham();
        $donHangs = $this->modelDonHang->getAllDonhang();
        $khachHangs = $this->modelTaiKhoan->getAllTaiKhoan(2);
        $danhMucs = $this->modelDanhMuc->getAllDanhMuc();

        $sanPhams = is_array($sanPhams) ? $sanPhams : [];
        $donHangs = is_array($donHangs) ? $donHangs : [];
        $khachHangs = is_array($khachHangs) ? $khachHangs : [];
        $danhMucs = is_array($danhMucs) ? $danhMucs : [];

        $tongSanPham = count($sanPhams);
        $tongDanhMuc = count($danhMucs);

        // Tính tổng doanh thu chỉ tính những đơn đã hoàn thành (trang_thai_id = 4)
        $tongDoanhThu = 0;
        $donHoanThanh = 0;
        foreach ($donHangs as $donHang) {
            $trangThai = (int)($donHang['trang_thai_id'] ?? 0);
            if ($trangThai === 4) {
                $tongDoanhThu += (float)($donHang['tong_tien'] ?? 0);
                $donHoanThanh++;
            }
        }

        $tongDonHang = count($donHangs);
        $tiLeChotDon = $tongDonHang > 0 ? round(($donHoanThanh / $tongDonHang) * 100, 1) : 0;
        $tiLeKhachHang = $tongDonHang > 0 ? round((count($khachHangs) / $tongDonHang) * 100, 1) : 0;

        // Sản phẩm sắp hết hàng: sắp xếp theo số lượng tồn kho tăng dần, lấy các sản phẩm còn ít nhất
        $sanPhamSapHetHang = $sanPhams;
        usort($sanPhamSapHetHang, function ($a, $b) {
            return (int)($a['so_luong'] ?? 0) <=> (int)($b['so_luong'] ?? 0);
        });
        $topSanPham = array_slice($sanPhamSapHetHang, 0, 5);

        // Sản phẩm bán chạy nhất (dựa trên chi_tiet_don_hangs của đơn đã hoàn thành)
        $topSanPhamBanChay = $this->modelDonHang->getTopSellingProducts(5);

        // Doanh thu theo ngày/tháng/năm (dữ liệu cho biểu đồ)
        $doanhThuNgay = $this->modelDonHang->getRevenuePerDay(7); // 7 ngày gần nhất
        $doanhThuThang = $this->modelDonHang->getRevenuePerMonth(12); // 12 tháng
        $doanhThuNam = $this->modelDonHang->getRevenuePerYear(3); // 3 năm gần nhất

        require_once './views/home.php';
    }
}
