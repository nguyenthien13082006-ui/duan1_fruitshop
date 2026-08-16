<?php


class AdminNhaCungCap
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function getAllNhaCungCap()
    {
        try {
            $sql = 'SELECT * FROM nha_cung_caps ORDER BY id DESC';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function insertNhaCungCap($ten_nha_cung_cap, $dia_chi, $so_dien_thoai, $mo_ta)
    {
        try {
            $sql = 'INSERT INTO nha_cung_caps (ten_nha_cung_cap, dia_chi, so_dien_thoai, mo_ta) VALUES (:ten_nha_cung_cap, :dia_chi, :so_dien_thoai, :mo_ta)';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_nha_cung_cap' => $ten_nha_cung_cap,
                ':dia_chi' => $dia_chi,
                ':so_dien_thoai' => $so_dien_thoai,
                ':mo_ta' => $mo_ta
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getDetailNhaCungCap($id)
    {
        try {
            $sql = 'SELECT * FROM nha_cung_caps WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function updateNhaCungCap($id, $ten_nha_cung_cap, $dia_chi, $so_dien_thoai, $mo_ta)
    {
        try {
            $sql = 'UPDATE nha_cung_caps SET ten_nha_cung_cap = :ten_nha_cung_cap, dia_chi = :dia_chi, so_dien_thoai = :so_dien_thoai, mo_ta = :mo_ta WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':ten_nha_cung_cap' => $ten_nha_cung_cap,
                ':dia_chi' => $dia_chi,
                ':so_dien_thoai' => $so_dien_thoai,
                ':mo_ta' => $mo_ta,
                ':id' => $id
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    // Đếm số sản phẩm đang thuộc nhà cung cấp này (dùng để chặn xóa theo business rule)
    public function countSanPhamTheoNhaCungCap($id)
    {
        try {
            $sql = 'SELECT COUNT(*) as tong FROM san_phams WHERE nha_cung_cap_id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id
            ]);

            $result = $stmt->fetch();
            return (int)($result['tong'] ?? 0);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function destroyNhaCungCap($id)
    {
        try {
            $sql = 'DELETE FROM nha_cung_caps WHERE id = :id';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':id' => $id,
            ]);

            return true;
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
}
