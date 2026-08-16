<?php

class SanPham
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    // Lấy danh sách sản phẩm kèm danh mục và thống kê đánh giá
    public function getAllSanPham()
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc,
                    COALESCE(AVG(dg.so_sao), 0) AS avg_rating,
                    COUNT(dg.id) AS so_luot_danh_gia
                    FROM san_phams
                    INNER JOIN danh_mucs 
                    ON san_phams.danh_muc_id = danh_mucs.id
                    LEFT JOIN danh_gias dg ON dg.san_pham_id = san_phams.id
                    GROUP BY san_phams.id';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function getDetailSanPham($id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc, nha_cung_caps.ten_nha_cung_cap,
            COALESCE(AVG(dg.so_sao), 0) AS avg_rating,
            COUNT(dg.id) AS so_luot_danh_gia
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            LEFT JOIN nha_cung_caps ON san_phams.nha_cung_cap_id = nha_cung_caps.id
            LEFT JOIN danh_gias dg ON dg.san_pham_id = san_phams.id
            WHERE san_phams.id = :id
            GROUP BY san_phams.id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function getListAnhSanPham($id)
    {
        try {
            $sql = 'SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :id';


            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function addDanhGia($san_pham_id, $tai_khoan_id, $so_sao, $noi_dung = '')
    {
        try {
            $sql = "INSERT INTO danh_gias (san_pham_id, tai_khoan_id, so_sao, noi_dung, created_at)
                    VALUES (:san_pham_id, :tai_khoan_id, :so_sao, :noi_dung, NOW())
                    ON DUPLICATE KEY UPDATE so_sao = VALUES(so_sao), noi_dung = VALUES(noi_dung), created_at = NOW()";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':tai_khoan_id' => $tai_khoan_id,
                ':so_sao' => $so_sao,
                ':noi_dung' => $noi_dung
            ]);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    public function addBinhLuan($san_pham_id, $tai_khoan_id, $noi_dung)
    {
        $sql = "INSERT INTO binh_luans
            (san_pham_id,tai_khoan_id,noi_dung,ngay_dang)
            VALUES (?,?,?,NOW())";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $san_pham_id,
            $tai_khoan_id,
            $noi_dung
        ]);
    }


    // lấy bình luận theo sản phẩm
    public function getBinhLuanFromSanPham($id)
    {
        $sql = "SELECT bl.*, tk.ho_ten, tk.anh_dai_dien
            FROM binh_luans bl
            JOIN tai_khoans tk
            ON bl.tai_khoan_id = tk.id
            WHERE bl.san_pham_id = ?
            ORDER BY bl.id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetchAll();
    }
    public function getListSanPhamDanhMuc($danh_muc_id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc,
            COALESCE(AVG(dg.so_sao), 0) AS avg_rating,
            COUNT(dg.id) AS so_luot_danh_gia
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            LEFT JOIN danh_gias dg ON dg.san_pham_id = san_phams.id
            WHERE san_phams.danh_muc_id = :danh_muc_id
            GROUP BY san_phams.id';
            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':danh_muc_id' => $danh_muc_id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi" . $e->getMessage();
        }
    }

    public function getAllDanhMuc()
    {
        try {
            $stmt = $this->conn->prepare('SELECT * FROM danh_mucs');
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getBinhLuanFromUser($tai_khoan_id)
    {
        try {
            $sql = 'SELECT binh_luans.*, san_phams.ten_san_pham
                    FROM binh_luans
                    INNER JOIN san_phams ON binh_luans.san_pham_id = san_phams.id
                    WHERE binh_luans.tai_khoan_id = :tai_khoan_id
                    ORDER BY binh_luans.ngay_dang DESC';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':tai_khoan_id' => $tai_khoan_id]);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function searchSanPham($keyword = '', $danh_muc_id = null)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc
                    FROM san_phams
                    INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                    WHERE 1=1';
            $params = [];

            if (!empty($keyword)) {
                $sql .= ' AND san_phams.ten_san_pham LIKE :keyword';
                $params[':keyword'] = '%' . $keyword . '%';
            }
            if (!empty($danh_muc_id)) {
                $sql .= ' AND san_phams.danh_muc_id = :danh_muc_id';
                $params[':danh_muc_id'] = $danh_muc_id;
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function giamSoLuong($san_pham_id, $so_luong)
    {
        $sql = "UPDATE san_phams 
            SET so_luong = so_luong - :so_luong 
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':so_luong' => $so_luong,
            ':id' => $san_pham_id
        ]);
    }

    public function tangSoLuong($san_pham_id, $so_luong)
    {
        $sql = "UPDATE san_phams 
            SET so_luong = so_luong + :so_luong 
            WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            ':so_luong' => $so_luong,
            ':id' => $san_pham_id
        ]);
    }
}
