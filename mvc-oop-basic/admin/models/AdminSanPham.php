<?php

class AdminSanPham
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
        $this->ensureBinhLuanSchema();
    }

    public function ensureBinhLuanSchema()
    {
        try {
            $stmt = $this->conn->query("SHOW COLUMNS FROM binh_luans");
            $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

            if (!in_array('trang_thai', $columns, true)) {
                $this->conn->exec('ALTER TABLE binh_luans ADD COLUMN trang_thai TINYINT(1) NOT NULL DEFAULT 1 AFTER ngay_dang');
            }
        } catch (Exception $e) {
            echo 'Lỗi schema bình luận: ' . $e->getMessage();
        }
    }

    public function getAllSanPham()
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc, nha_cung_caps.ten_nha_cung_cap
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            LEFT JOIN nha_cung_caps ON san_phams.nha_cung_cap_id = nha_cung_caps.id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function insertSanPham(
        $ten_san_pham,
        $gia_san_pham,
        $gia_khuyen_mai,
        $so_luong,
        $ngay_nhap,
        $danh_muc_id,
        $nha_cung_cap_id,
        $xuat_xu,
        $don_vi_tinh,
        $trang_thai,
        $mo_ta,
        $hinh_anh
    ) {
        try {
            $sql = 'INSERT INTO san_phams (ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, nha_cung_cap_id, xuat_xu, don_vi_tinh, trang_thai, mo_ta, hinh_anh) 
                    VALUES (:ten_san_pham, :gia_san_pham, :gia_khuyen_mai, :so_luong, :ngay_nhap, :danh_muc_id, :nha_cung_cap_id, :xuat_xu, :don_vi_tinh, :trang_thai, :mo_ta, :hinh_anh)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':nha_cung_cap_id' => $nha_cung_cap_id ?: null,
                ':xuat_xu' => $xuat_xu,
                ':don_vi_tinh' => $don_vi_tinh ?: 'kg',
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh
            ]);

            // Lấy id sản phẩm vừa thêm, tự sinh mã sản phẩm dạng SP0001, SP0002...
            $newId = $this->conn->lastInsertId();
            $ma_san_pham = 'SP' . str_pad($newId, 4, '0', STR_PAD_LEFT);
            $updateMa = $this->conn->prepare('UPDATE san_phams SET ma_san_pham = :ma WHERE id = :id');
            $updateMa->execute([':ma' => $ma_san_pham, ':id' => $newId]);

            return $newId;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    // Cập nhật nhanh số lượng tồn kho (không cần sửa toàn bộ sản phẩm)
    public function updateSoLuongTonKho($id, $so_luong)
    {
        try {
            $sql = 'UPDATE san_phams SET so_luong = :so_luong WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':so_luong' => $so_luong,
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function insertAlbumAnhSanPham($san_pham_id, $link_hinh_anh)
    {
        try {
            $sql = 'INSERT INTO hinh_anh_san_phams (san_pham_id, link_hinh_anh) 
                    VALUES (:san_pham_id, :link_hinh_anh)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':san_pham_id' => $san_pham_id,
                ':link_hinh_anh' => $link_hinh_anh
            ]);

            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }


    public function getDetailSanPham($id)
    {
        try {
            $sql = 'SELECT san_phams.*, danh_mucs.ten_danh_muc, nha_cung_caps.ten_nha_cung_cap
            FROM san_phams
            INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
            LEFT JOIN nha_cung_caps ON san_phams.nha_cung_cap_id = nha_cung_caps.id
            WHERE san_phams.id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
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
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Cập nhật nhanh số lượng tồn kho (không cần sửa toàn bộ sản phẩm)
    public function updateSoLuong($id, $so_luong)
    {
        try {
            $sql = 'UPDATE san_phams SET so_luong = :so_luong WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':so_luong' => $so_luong,
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateSanPham(
        $san_pham_id,
        $ten_san_pham,
        $gia_san_pham,
        $gia_khuyen_mai,
        $so_luong,
        $ngay_nhap,
        $danh_muc_id,
        $nha_cung_cap_id,
        $xuat_xu,
        $don_vi_tinh,
        $trang_thai,
        $mo_ta,
        $hinh_anh
    ) {
        try {
            $sql = 'UPDATE san_phams
                    SET
                        ten_san_pham = :ten_san_pham,
                        gia_san_pham = :gia_san_pham,
                        gia_khuyen_mai = :gia_khuyen_mai,
                        so_luong = :so_luong,
                        ngay_nhap = :ngay_nhap,
                        danh_muc_id = :danh_muc_id,
                        nha_cung_cap_id = :nha_cung_cap_id,
                        xuat_xu = :xuat_xu,
                        don_vi_tinh = :don_vi_tinh,
                        trang_thai = :trang_thai,
                        mo_ta = :mo_ta,
                        hinh_anh = :hinh_anh
                    WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_san_pham' => $ten_san_pham,
                ':gia_san_pham' => $gia_san_pham,
                ':gia_khuyen_mai' => $gia_khuyen_mai,
                ':so_luong' => $so_luong,
                ':ngay_nhap' => $ngay_nhap,
                ':danh_muc_id' => $danh_muc_id,
                ':nha_cung_cap_id' => $nha_cung_cap_id ?: null,
                ':xuat_xu' => $xuat_xu,
                ':don_vi_tinh' => $don_vi_tinh ?: 'kg',
                ':trang_thai' => $trang_thai,
                ':mo_ta' => $mo_ta,
                ':hinh_anh' => $hinh_anh,
                ':id' => $san_pham_id
            ]);

            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDetailAnhSanPham($id)
    {
        try {
            $sql = 'SELECT * FROM hinh_anh_san_phams WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateAnhSanPham($id, $new_file)
    {
        try {
            $sql = 'UPDATE hinh_anh_san_phams
                    SET
                        link_hinh_anh = :new_file
                        
                    WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':new_file' => $new_file,
                ':id' => $id
            ]);

            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function destroyAnhSanPham($id)
    {
        try {
            $sql = 'DELETE FROM hinh_anh_san_phams WHERE id=:id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id,
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function destroySanPham($id)
    {
        try {
            $sql = 'DELETE FROM san_phams WHERE id=:id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id,
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function destroyBinhLuan($id)
    {
        try {
            $sql = 'DELETE FROM binh_luans WHERE id=:id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id,
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getBinhLuanFromKhachHang($id)
    {
        try {
            $sql = 'SELECT binh_luans.*, san_phams.ten_san_pham
            FROM binh_luans
            LEFT JOIN san_phams ON binh_luans.san_pham_id = san_phams.id
            WHERE binh_luans.tai_khoan_id = :id
            ';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }

    public function getDetailBinhLuan($id)
    {
        try {
            $sql = 'SELECT * FROM binh_luans WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateTrangThaiBinhLuan($id, $trang_thai)
    {
        try {
            $sql = 'UPDATE binh_luans
                    SET
                        trang_thai = :trang_thai
                        
                    WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':trang_thai' => $trang_thai,
                ':id' => $id
            ]);

            // Lấy id sản phẩm vừa thêm
            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getBinhLuanFromSanPham($id)
    {
        try {
            $sql = 'SELECT binh_luans.*, tai_khoans.ho_ten
            FROM binh_luans
            LEFT JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id
            WHERE binh_luans.san_pham_id = :id
            ORDER BY binh_luans.id DESC';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
}
