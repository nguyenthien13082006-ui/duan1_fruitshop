-- Script tạo database cho website bán hoa quả
CREATE DATABASE IF NOT EXISTS fruit_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE fruit_shop;

CREATE TABLE IF NOT EXISTS chuc_vu (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ten_chuc_vu VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS tai_khoans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ho_ten VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  mat_khau VARCHAR(255) NOT NULL,
  so_dien_thoai VARCHAR(20) DEFAULT NULL,
  dia_chi TEXT DEFAULT NULL,
  ngay_sinh DATE DEFAULT NULL,
  gioi_tinh TINYINT(1) DEFAULT 1,
  chuc_vu_id INT DEFAULT 2,
  trang_thai TINYINT(1) DEFAULT 1,
  anh_dai_dien VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (chuc_vu_id) REFERENCES chuc_vu(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS danh_mucs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ten_danh_muc VARCHAR(100) NOT NULL,
  mo_ta TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS san_phams (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ten_san_pham VARCHAR(150) NOT NULL,
  gia_san_pham INT NOT NULL,
  gia_khuyen_mai INT DEFAULT NULL,
  so_luong INT DEFAULT 0,
  ngay_nhap DATE NOT NULL,
  danh_muc_id INT NOT NULL,
  trang_thai TINYINT(1) DEFAULT 1,
  mo_ta TEXT DEFAULT NULL,
  hinh_anh VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (danh_muc_id) REFERENCES danh_mucs(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS hinh_anh_san_phams (
  id INT AUTO_INCREMENT PRIMARY KEY,
  san_pham_id INT NOT NULL,
  link_hinh_anh VARCHAR(255) NOT NULL,
  FOREIGN KEY (san_pham_id) REFERENCES san_phams(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS gio_hangs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tai_khoan_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (tai_khoan_id) REFERENCES tai_khoans(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS chi_tiet_gio_hangs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  gio_hang_id INT NOT NULL,
  san_pham_id INT NOT NULL,
  so_luong INT NOT NULL DEFAULT 1,
  FOREIGN KEY (gio_hang_id) REFERENCES gio_hangs(id) ON DELETE CASCADE,
  FOREIGN KEY (san_pham_id) REFERENCES san_phams(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS phuong_thuc_thanh_toans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ten_phuong_thuc VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS trang_thai_don_hangs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ten_trang_thai VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS don_hangs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  tai_khoan_id INT NOT NULL,
  ten_nguoi_nhan VARCHAR(100) NOT NULL,
  email_nguoi_nhan VARCHAR(100) NOT NULL,
  sdt_nguoi_nhan VARCHAR(20) NOT NULL,
  dia_chi_nguoi_nhan TEXT NOT NULL,
  ghi_chu TEXT DEFAULT NULL,
  tong_tien INT NOT NULL,
  phuong_thuc_thanh_toan_id INT DEFAULT NULL,
  ngay_dat DATE NOT NULL,
  trang_thai_id INT DEFAULT 1,
  ma_don_hang VARCHAR(50) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (tai_khoan_id) REFERENCES tai_khoans(id),
  FOREIGN KEY (phuong_thuc_thanh_toan_id) REFERENCES phuong_thuc_thanh_toans(id),
  FOREIGN KEY (trang_thai_id) REFERENCES trang_thai_don_hangs(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS chi_tiet_don_hangs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  don_hang_id INT NOT NULL,
  san_pham_id INT NOT NULL,
  don_gia INT NOT NULL,
  so_luong INT NOT NULL,
  thanh_tien INT NOT NULL,
  FOREIGN KEY (don_hang_id) REFERENCES don_hangs(id) ON DELETE CASCADE,
  FOREIGN KEY (san_pham_id) REFERENCES san_phams(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS binh_luans (
  id INT AUTO_INCREMENT PRIMARY KEY,
  san_pham_id INT NOT NULL,
  tai_khoan_id INT NOT NULL,
  noi_dung TEXT NOT NULL,
  ngay_dang TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (san_pham_id) REFERENCES san_phams(id) ON DELETE CASCADE,
  FOREIGN KEY (tai_khoan_id) REFERENCES tai_khoans(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO chuc_vu (id, ten_chuc_vu) VALUES
(1, 'Quản trị'),
(2, 'Khách hàng')
ON DUPLICATE KEY UPDATE ten_chuc_vu = VALUES(ten_chuc_vu);

INSERT INTO danh_mucs (id, ten_danh_muc, mo_ta) VALUES
(1, 'Trái cây nhập khẩu', 'Các loại trái cây chất lượng cao từ các nước'),
(2, 'Trái cây theo mùa', 'Các loại trái cây tươi ngon theo mùa'),
(3, 'Rau củ quả', 'Rau củ và quả sạch, hữu cơ')
ON DUPLICATE KEY UPDATE ten_danh_muc = VALUES(ten_danh_muc), mo_ta = VALUES(mo_ta);

INSERT INTO phuong_thuc_thanh_toans (id, ten_phuong_thuc) VALUES
(1, 'Thanh toán khi nhận hàng'),
(2, 'Chuyển khoản ngân hàng')
ON DUPLICATE KEY UPDATE ten_phuong_thuc = VALUES(ten_phuong_thuc);

INSERT INTO trang_thai_don_hangs (id, ten_trang_thai) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đã xác nhận'),
(3, 'Đang giao'),
(4, 'Hoàn thành'),
(11, 'Đã hủy')
ON DUPLICATE KEY UPDATE ten_trang_thai = VALUES(ten_trang_thai);

INSERT INTO tai_khoans (id, ho_ten, email, mat_khau, so_dien_thoai, dia_chi, ngay_sinh, gioi_tinh, chuc_vu_id, trang_thai) VALUES
(1, 'Quản trị viên', 'admin@fruitshop.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0900000001', 'Hà Nội', '1990-01-01', 1, 1, 1),
(2, 'Nguyễn Minh An', 'khachhang1@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0900000002', 'Đà Nẵng', '1998-05-10', 2, 2, 1)
ON DUPLICATE KEY UPDATE ho_ten = VALUES(ho_ten), email = VALUES(email), mat_khau = VALUES(mat_khau), so_dien_thoai = VALUES(so_dien_thoai), dia_chi = VALUES(dia_chi), ngay_sinh = VALUES(ngay_sinh), gioi_tinh = VALUES(gioi_tinh), chuc_vu_id = VALUES(chuc_vu_id), trang_thai = VALUES(trang_thai);

INSERT INTO san_phams (id, ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, trang_thai, mo_ta, hinh_anh) VALUES
(1, 'Dưa hấu đỏ', 45000, 39000, 120, '2026-07-01', 2, 1, 'Dưa hấu đỏ ngọt, mọng nước, thích hợp cho mùa hè.', 'uploads/duahau.jpg'),
(2, 'Táo Fuji', 80000, 69000, 90, '2026-07-02', 1, 1, 'Táo Fuji nhập khẩu, giòn ngọt và thơm.', 'uploads/tao.jpg'),
(3, 'Nho đen', 120000, 109000, 60, '2026-07-03', 1, 1, 'Nho đen ngọt, mọng nước, giàu vitamin.', 'uploads/nho.jpg'),
(4, 'Cam sành', 50000, 45000, 110, '2026-07-04', 2, 1, 'Cam sành thơm, vị ngọt thanh, nhiều nước.', 'uploads/cam.jpg'),
(5, 'Xoài cát', 70000, 62000, 75, '2026-07-05', 2, 1, 'Xoài cát chín vàng, thơm ngon, mềm ngọt.', 'uploads/xoai.jpg'),
(6, 'Dâu tây', 140000, 129000, 40, '2026-07-06', 1, 1, 'Dâu tây tươi ngon, đỏ mọng, nhiều dưỡng chất.', 'uploads/dautay.jpg')
ON DUPLICATE KEY UPDATE ten_san_pham = VALUES(ten_san_pham), gia_san_pham = VALUES(gia_san_pham), gia_khuyen_mai = VALUES(gia_khuyen_mai), so_luong = VALUES(so_luong), ngay_nhap = VALUES(ngay_nhap), danh_muc_id = VALUES(danh_muc_id), trang_thai = VALUES(trang_thai), mo_ta = VALUES(mo_ta), hinh_anh = VALUES(hinh_anh);
