<?php
class AdminDonHang
{

    public $conn;
    public function __construct()
    {
        $this->conn =  connectDB();
    }
    public function getAllDonhang()
    {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai FROM don_hangs INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function getDetailDonHang($id)
    {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai, tai_khoans.ho_ten, tai_khoans.email, tai_khoans.so_dien_thoai, phuong_thuc_thanh_toans.ten_phuong_thuc
             FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id 
            LEFT JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id
            LEFT JOIN phuong_thuc_thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id
            WHERE don_hangs.id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
    public function getListSpDonHang($id)
    {
        try {
            $sql = 'SELECT chi_tiet_don_hangs.*, san_phams.ten_san_pham
            FROM chi_tiet_don_hangs
            INNER JOIN san_phams ON chi_tiet_don_hangs.san_pham_id = san_phams.id
            WHERE chi_tiet_don_hangs.don_hang_id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    public function getAllTrangThaiDonHang()
    {
        try {
            $sql = 'SELECT * FROM trang_thai_don_hangs';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function updateDonHang($id, $ten_nguoi_nhan, $sdt_nguoi_nhan, $email_nguoi_nhan, $dia_chi_nguoi_nhan, $ghi_chu, $trang_thai_id)
    {
        try {
            // var_dump($id);die;
            $sql = 'UPDATE don_hangs
                    SET 
                        ten_nguoi_nhan = :ten_nguoi_nhan,
                        sdt_nguoi_nhan = :sdt_nguoi_nhan,
                        email_nguoi_nhan = :email_nguoi_nhan,
                        dia_chi_nguoi_nhan = :dia_chi_nguoi_nhan,
                        ghi_chu = :ghi_chu,
                        trang_thai_id = :trang_thai_id
                    WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            // var_dump($stmt);die;
            $stmt->execute([
                ':ten_nguoi_nhan' => $ten_nguoi_nhan,
                ':sdt_nguoi_nhan' => $sdt_nguoi_nhan,
                ':email_nguoi_nhan' => $email_nguoi_nhan,
                ':dia_chi_nguoi_nhan' => $dia_chi_nguoi_nhan,
                ':ghi_chu' => $ghi_chu,
                ':trang_thai_id' => $trang_thai_id,
                ':id' => $id
            ]);


            return true;
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function getDonHangFromKhachHang($id)
    {
        try {
            $sql = 'SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai
            FROM don_hangs
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            WHERE don_hangs.tai_khoan_id = :id
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    // Top selling products (based on completed orders)
    public function getTopSellingProducts($limit = 5)
    {
        try {
            $sql = 'SELECT sp.id, sp.ten_san_pham, sp.hinh_anh,
                    SUM(ct.so_luong) AS sold_qty, SUM(ct.thanh_tien) AS revenue,
                    COALESCE(AVG(dg.so_sao), 0) AS avg_rating,
                    COUNT(DISTINCT dg.id) AS so_luot_danh_gia
                    FROM chi_tiet_don_hangs ct
                    JOIN don_hangs dh ON ct.don_hang_id = dh.id
                    JOIN san_phams sp ON ct.san_pham_id = sp.id
                    LEFT JOIN danh_gias dg ON dg.san_pham_id = sp.id
                    WHERE dh.trang_thai_id = 4
                    GROUP BY ct.san_pham_id
                    ORDER BY sold_qty DESC
                    LIMIT :limit';

            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    // Revenue grouped by day for last N days
    public function getRevenuePerDay($days = 7)
    {
        try {
            $sql = "SELECT DATE(created_at) AS day, SUM(tong_tien) AS revenue
                    FROM don_hangs
                    WHERE trang_thai_id = 4 AND created_at >= DATE_SUB(CURDATE(), INTERVAL :days DAY)
                    GROUP BY DATE(created_at)
                    ORDER BY DATE(created_at)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':days' => (int)$days]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    // Revenue grouped by month for last N months
    public function getRevenuePerMonth($months = 12)
    {
        try {
            $sql = "SELECT DATE_FORMAT(created_at, '%Y-%m') AS month, SUM(tong_tien) AS revenue
                    FROM don_hangs
                    WHERE trang_thai_id = 4 AND created_at >= DATE_SUB(CURDATE(), INTERVAL :months MONTH)
                    GROUP BY DATE_FORMAT(created_at, '%Y-%m')
                    ORDER BY DATE_FORMAT(created_at, '%Y-%m')";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':months' => (int)$months]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    // Revenue grouped by year for last N years
    public function getRevenuePerYear($years = 3)
    {
        try {
            $sql = "SELECT YEAR(created_at) AS year, SUM(tong_tien) AS revenue
                    FROM don_hangs
                    WHERE trang_thai_id = 4 AND created_at >= DATE_SUB(CURDATE(), INTERVAL :years YEAR)
                    GROUP BY YEAR(created_at)
                    ORDER BY YEAR(created_at)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':years' => (int)$years]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }
}
