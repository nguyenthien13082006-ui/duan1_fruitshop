<?php

class TaiKhoan
{
    public $conn;

    public function __construct($conn = null)
    {
        $this->conn = $conn ?: connectDB();
    }
    public function checkLogin($email, $mat_khau)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            $passwordMatches = false;
            if ($user) {
                if (password_verify($mat_khau, $user['mat_khau'])) {
                    $passwordMatches = true;
                } elseif ($user['mat_khau'] === $mat_khau) {
                    $passwordMatches = true;
                    $newHash = password_hash($mat_khau, PASSWORD_DEFAULT);
                    try {
                        $updateSql = "UPDATE tai_khoans SET mat_khau = :hash WHERE id = :id";
                        $updateStmt = $this->conn->prepare($updateSql);
                        $updateStmt->execute([':hash' => $newHash, ':id' => $user['id']]);

                        $user['mat_khau'] = $newHash;
                    } catch (\Exception $e) {
                    }
                }
            }

            if ($user && $passwordMatches) {
                if ($user['chuc_vu_id'] == 2) {
                    if ($user['trang_thai'] == 1) {
                        return $user; // trả về toàn bộ thông tin người dùng để lưu vào session
                    } else {
                        return "Tài khoản bị cấm";
                    }
                } else {
                    return "Tài khoản không có quyền đăng nhập";
                }
            } else {
                return "Bạn nhập sai thông tin mật khẩu hoặc tài khoản";
            }
        } catch (\Exception $e) {
            echo "lỗi" . $e->getMessage();
            return false;
        }
    }
    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':email' => $email
            ]);

            return $stmt->fetch();
        } catch (Exception $e) {
            echo "lỗi" . $e->getMessage();
        }
    }
    public function insertTaiKhoan($ten, $email, $mat_khau, $ngay_sinh, $so_dien_thoai, $dia_chi)
    {
        try {

            $sql = "INSERT INTO tai_khoans
        (ho_ten, email, mat_khau, ngay_sinh, so_dien_thoai, dia_chi, chuc_vu_id, trang_thai)
        VALUES
        (:ten, :email, :mat_khau, :ngay_sinh, :so_dien_thoai, :dia_chi, 2, 1)";

            $stmt = $this->conn->prepare($sql);

            return $stmt->execute([
                ':ten' => $ten,
                ':email' => $email,
                ':mat_khau' => $mat_khau,
                ':ngay_sinh' => $ngay_sinh,
                ':so_dien_thoai' => $so_dien_thoai,
                ':dia_chi' => $dia_chi
            ]);
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }
    public function getUserByEmail($email)
    {
        $sql = "SELECT * FROM tai_khoans WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }
    public function updateUser($data)
    {
        $sql = "UPDATE tai_khoans 
            SET ho_ten = :ho_ten,
                so_dien_thoai = :so_dien_thoai,
                dia_chi = :dia_chi
            WHERE email = :email";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
}
