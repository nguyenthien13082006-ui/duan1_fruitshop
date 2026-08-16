<?php

class LienHe
{
    public $conn;

    public function __construct($conn = null)
    {
        $this->conn = $conn ?: connectDB();
    }

    public function insertLienHe($ho_ten, $so_dien_thoai, $email, $tieu_de, $noi_dung)
    {
        try {
            $sql = 'INSERT INTO lien_he (ho_ten, so_dien_thoai, email, tieu_de, noi_dung, created_at)
                    VALUES (:ho_ten, :so_dien_thoai, :email, :tieu_de, :noi_dung, NOW())';
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':ho_ten' => $ho_ten,
                ':so_dien_thoai' => $so_dien_thoai,
                ':email' => $email,
                ':tieu_de' => $tieu_de,
                ':noi_dung' => $noi_dung,
            ]);
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }

    public function getAllLienHe()
    {
        try {
            $sql = 'SELECT * FROM lien_he ORDER BY created_at DESC';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];
        }
    }

    public function getLienHeById($id)
    {
        try {
            $sql = 'SELECT * FROM lien_he WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':id' => $id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return null;
        }
    }

    public function updatePhanHoi($id, $phan_hoi, $trang_thai)
    {
        try {
            $sql = 'UPDATE lien_he SET phan_hoi = :phan_hoi, trang_thai = :trang_thai WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([
                ':phan_hoi' => $phan_hoi,
                ':trang_thai' => $trang_thai,
                ':id' => $id,
            ]);
        } catch (Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
}
