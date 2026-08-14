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

CREATE TABLE IF NOT EXISTS nha_cung_caps (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ten_nha_cung_cap VARCHAR(150) NOT NULL,
  dia_chi VARCHAR(255) DEFAULT NULL,
  so_dien_thoai VARCHAR(20) DEFAULT NULL,
  mo_ta TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO nha_cung_caps (id, ten_nha_cung_cap, dia_chi, mo_ta) VALUES
(1, 'VinEco', 'Hà Nội', 'Nông trại rau củ quả công nghệ cao'),
(2, 'Dalat GAP', 'Đà Lạt, Lâm Đồng', 'Trái cây đạt chuẩn VietGAP vùng Đà Lạt'),
(3, 'Klever Fruits', 'TP. Hồ Chí Minh', 'Trái cây nhập khẩu cao cấp'),
(4, 'Fruit Republic', 'Tiền Giang', 'Trái cây xuất khẩu đạt chuẩn quốc tế'),
(5, 'Nông trại Đồng Nai', 'Đồng Nai', 'Trái cây tươi sạch trồng tại Đồng Nai')
ON DUPLICATE KEY UPDATE ten_nha_cung_cap = VALUES(ten_nha_cung_cap), dia_chi = VALUES(dia_chi), mo_ta = VALUES(mo_ta);

CREATE TABLE IF NOT EXISTS danh_mucs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ten_danh_muc VARCHAR(100) NOT NULL,
  mo_ta TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS san_phams (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ma_san_pham VARCHAR(20) DEFAULT NULL,
  ten_san_pham VARCHAR(150) NOT NULL,
  gia_san_pham INT NOT NULL,
  gia_khuyen_mai INT DEFAULT NULL,
  so_luong INT DEFAULT 0,
  luot_xem INT DEFAULT 0,
  ngay_nhap DATE NOT NULL,
  danh_muc_id INT NOT NULL,
  nha_cung_cap_id INT DEFAULT NULL,
  xuat_xu VARCHAR(100) DEFAULT NULL,
  don_vi_tinh VARCHAR(50) DEFAULT 'kg',
  trang_thai TINYINT(1) DEFAULT 1,
  mo_ta TEXT DEFAULT NULL,
  hinh_anh VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (danh_muc_id) REFERENCES danh_mucs(id),
  FOREIGN KEY (nha_cung_cap_id) REFERENCES nha_cung_caps(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Migration an toàn cho database đã tồn tại từ trước (thêm cột nếu chưa có)
-- Dùng thủ tục tạm để kiểm tra cột đã tồn tại chưa trước khi thêm,
-- chạy được trên mọi phiên bản MySQL/MariaDB (không cần "ADD COLUMN IF NOT EXISTS")
DROP PROCEDURE IF EXISTS them_cot_san_phams_neu_chua_co;
DELIMITER //
CREATE PROCEDURE them_cot_san_phams_neu_chua_co()
BEGIN
    IF NOT EXISTS (SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'san_phams' AND COLUMN_NAME = 'ma_san_pham') THEN
        ALTER TABLE san_phams ADD COLUMN ma_san_pham VARCHAR(20) DEFAULT NULL AFTER id;
    END IF;
    IF NOT EXISTS (SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'san_phams' AND COLUMN_NAME = 'nha_cung_cap_id') THEN
        ALTER TABLE san_phams ADD COLUMN nha_cung_cap_id INT DEFAULT NULL AFTER danh_muc_id;
    END IF;
    IF NOT EXISTS (SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'san_phams' AND COLUMN_NAME = 'xuat_xu') THEN
        ALTER TABLE san_phams ADD COLUMN xuat_xu VARCHAR(100) DEFAULT NULL AFTER nha_cung_cap_id;
    END IF;
    IF NOT EXISTS (SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'san_phams' AND COLUMN_NAME = 'don_vi_tinh') THEN
        ALTER TABLE san_phams ADD COLUMN don_vi_tinh VARCHAR(50) DEFAULT 'kg' AFTER xuat_xu;
    END IF;
    IF NOT EXISTS (SELECT 1 FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'san_phams' AND COLUMN_NAME = 'luot_xem') THEN
        ALTER TABLE san_phams ADD COLUMN luot_xem INT DEFAULT 0 AFTER so_luong;
    END IF;
END //
DELIMITER ;
CALL them_cot_san_phams_neu_chua_co();
DROP PROCEDURE them_cot_san_phams_neu_chua_co;

CREATE TABLE IF NOT EXISTS hinh_anh_san_phams (
  id INT AUTO_INCREMENT PRIMARY KEY,
  san_pham_id INT NOT NULL,
  link_hinh_anh VARCHAR(255) NOT NULL,
  FOREIGN KEY (san_pham_id) REFERENCES san_phams(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO hinh_anh_san_phams (san_pham_id, link_hinh_anh)
SELECT id, 'uploads/dua-le-han-quoc.jpg' FROM san_phams WHERE ma_san_pham = 'SP0001'
UNION ALL SELECT id, 'uploads/le-han-quoc-evergood.jpg' FROM san_phams WHERE ma_san_pham = 'SP0002'
UNION ALL SELECT id, 'uploads/cherry-my.jpg' FROM san_phams WHERE ma_san_pham = 'SP0003'
UNION ALL SELECT id, 'uploads/cam-cara-cara.jpg' FROM san_phams WHERE ma_san_pham = 'SP0004'
UNION ALL SELECT id, 'uploads/hong-gion-new-zealand.jpg' FROM san_phams WHERE ma_san_pham = 'SP0005'
UNION ALL SELECT id, 'uploads/dau-tay.jpg' FROM san_phams WHERE ma_san_pham = 'SP0006'
UNION ALL SELECT id, 'uploads/kiwi-xanh.png' FROM san_phams WHERE ma_san_pham = 'SP0007'
UNION ALL SELECT id, 'uploads/cam-vang.jpg' FROM san_phams WHERE ma_san_pham = 'SP0008';

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

CREATE TABLE IF NOT EXISTS danh_gias (
  id INT AUTO_INCREMENT PRIMARY KEY,
  san_pham_id INT NOT NULL,
  tai_khoan_id INT NOT NULL,
  so_sao TINYINT NOT NULL DEFAULT 5,
  noi_dung TEXT DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY unique_user_rating_per_product (san_pham_id, tai_khoan_id),
  FOREIGN KEY (san_pham_id) REFERENCES san_phams(id) ON DELETE CASCADE,
  FOREIGN KEY (tai_khoan_id) REFERENCES tai_khoans(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS lien_he (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ho_ten VARCHAR(150) NOT NULL,
  so_dien_thoai VARCHAR(50) NOT NULL,
  email VARCHAR(150) NOT NULL,
  tieu_de VARCHAR(255) DEFAULT NULL,
  noi_dung TEXT NOT NULL,
  phan_hoi TEXT DEFAULT NULL,
  trang_thai VARCHAR(100) DEFAULT 'Chưa xử lý',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO chuc_vu (id, ten_chuc_vu) VALUES
(1, 'Quản trị'),
(2, 'Khách hàng')
ON DUPLICATE KEY UPDATE ten_chuc_vu = VALUES(ten_chuc_vu);

INSERT INTO danh_mucs (id, ten_danh_muc, mo_ta) VALUES
(1, 'Trái cây nhập khẩu', 'Các loại trái cây chất lượng cao từ các nước'),
(2, 'Trái cây theo mùa', 'Các loại trái cây tươi ngon theo mùa'),
(3, 'Rau củ quả', 'Rau củ và quả sạch, hữu cơ'),
(4, 'Set & Giỏ quà trái cây', 'Đĩa hoa quả bổ sẵn, giỏ quà và hộp quà trái cây cho tặng biếu')
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

INSERT INTO san_phams (id, ma_san_pham, ten_san_pham, gia_san_pham, gia_khuyen_mai, so_luong, ngay_nhap, danh_muc_id, nha_cung_cap_id, xuat_xu, don_vi_tinh, trang_thai, mo_ta, hinh_anh) VALUES
(1, 'SP0001', 'Dưa lê Hàn Quốc', 85000, 75000, 60, '2026-08-01', 1, 3, 'Hàn Quốc', 'kg', 1, 'Dưa lê vàng Hàn Quốc ruột giòn, vị ngọt thanh mát, thơm dịu, nhập khẩu chính ngạch.', 'uploads/dua-le-han-quoc.jpg'),
(2, 'SP0002', 'Lê Hàn Quốc Evergood', 180000, 159000, 50, '2026-08-01', 1, 3, 'Hàn Quốc', 'kg', 1, 'Lê Hàn Quốc thương hiệu Evergood, quả to tròn, vỏ vàng nâu, ruột trắng giòn mọng nước, vị ngọt thanh.', 'uploads/le-han-quoc-evergood.jpg'),
(3, 'SP0003', 'Cherry Mỹ', 550000, 490000, 30, '2026-08-01', 1, 3, 'Mỹ', 'kg', 1, 'Cherry Mỹ đỏ mọng, trái to đều, độ ngọt (Brix) trên 22 độ, nhập khẩu trực tiếp bằng đường bay.', 'uploads/cherry-my.jpg'),
(4, 'SP0004', 'Cam ruột đỏ Cara Cara', 110000, 95000, 80, '2026-08-01', 1, 3, 'Mỹ', 'kg', 1, 'Cam Cara Cara ruột đỏ hồng, mọng nước, vị ngọt dịu ít chua, giàu vitamin C và chất chống oxy hóa.', 'uploads/cam-cara-cara.jpg'),
(5, 'SP0005', 'Hồng giòn New Zealand', 145000, 129000, 45, '2026-08-01', 1, 3, 'New Zealand', 'kg', 1, 'Hồng giòn nhập khẩu New Zealand, quả tròn đều, vị ngọt giòn, không chát, ăn liền không cần ủ chín.', 'uploads/hong-gion-new-zealand.jpg'),
(6, 'SP0006', 'Dâu tây', 150000, 135000, 40, '2026-08-01', 2, 2, 'Đà Lạt, Việt Nam', 'hộp', 1, 'Dâu tây tươi ngon, quả đỏ mọng, vị chua ngọt hài hòa, giàu vitamin C.', 'uploads/dau-tay.jpg'),
(7, 'SP0007', 'Kiwi xanh New Zealand', 120000, 105000, 55, '2026-08-02', 1, 3, 'New Zealand', 'kg', 1, 'Kiwi xanh New Zealand ruột xanh mướt, hạt nhỏ đều, vị chua ngọt thanh mát, giàu vitamin C.', 'uploads/kiwi-xanh.png'),
(8, 'SP0008', 'Cam vàng nhập khẩu', 90000, 79000, 70, '2026-08-02', 1, 4, 'Úc', 'kg', 1, 'Cam vàng nhập khẩu ruột vàng ươm, mọng nước, vị ngọt thanh, thích hợp vắt nước hoặc ăn trực tiếp.', 'uploads/cam-vang.jpg'),
(9, 'SP0009', 'Chôm chôm', 45000, 39000, 90, '2026-08-05', 2, 5, 'Việt Nam', 'kg', 1, 'Chôm chôm tươi, vỏ đỏ gai mềm, cùi giòn ngọt, tách hạt dễ dàng.', 'uploads/chom-chom.jpg'),
(10, 'SP0010', 'Dưa lưới ruột xanh', 65000, 55000, 50, '2026-08-05', 2, 1, 'Việt Nam', 'kg', 1, 'Dưa lưới trồng trong nhà màng công nghệ cao, vỏ lưới đều, ruột xanh giòn, vị ngọt mát, an toàn.', 'uploads/dua-luoi.jpg'),
(11, 'SP0011', 'Hồng giòn Mộc Châu', 70000, 62000, 55, '2026-08-05', 2, 2, 'Mộc Châu, Việt Nam', 'kg', 1, 'Hồng giòn đặc sản Mộc Châu, quả vàng cam, ăn giòn ngọt ngay không cần ủ chín.', 'uploads/hong-gion-moc-chau.png'),
(12, 'SP0012', 'Bưởi da xanh', 55000, 48000, 65, '2026-08-05', 2, 2, 'Bến Tre, Việt Nam', 'quả', 1, 'Bưởi da xanh ruột hồng, múi mọng nước, vị ngọt thanh ít hạt, đặc sản miền Tây.', 'uploads/buoi-da-xanh.jpg'),
(13, 'SP0013', 'Quýt ngọt', 60000, 52000, 60, '2026-08-05', 2, 2, 'Việt Nam', 'kg', 1, 'Quýt ngọt vỏ xanh, tép cam vàng mọng nước, vị ngọt thanh dịu, dễ bóc vỏ.', 'uploads/quyt-ngot.jpg'),
(14, 'SP0014', 'Đĩa hoa quả bổ sẵn - Bưởi đỏ', 180000, 159000, 20, '2026-08-05', 4, NULL, 'Việt Nam', 'đĩa', 1, 'Đĩa hoa quả bổ sẵn với bưởi đỏ tách múi trình bày đẹp mắt, tiện lợi cho tiệc, họp mặt.', 'uploads/dia-hoa-qua-buoi-do.jpg'),
(15, 'SP0015', 'Đĩa hoa quả bổ sẵn - Mận & Nho', 220000, 195000, 20, '2026-08-05', 4, NULL, 'Việt Nam', 'đĩa', 1, 'Đĩa hoa quả bổ sẵn thập cẩm: mận, nho đen, nho đỏ, cherry, trình bày đẹp mắt sang trọng.', 'uploads/dia-hoa-qua-man-nho.jpg'),
(16, 'SP0016', 'Giỏ quà táo cao cấp', 850000, 790000, 15, '2026-08-05', 4, NULL, 'Việt Nam', 'giỏ', 1, 'Giỏ quà táo nhập khẩu cao cấp, gói nơ sang trọng, phù hợp biếu tặng dịp lễ, thăm hỏi.', 'uploads/gio-qua-tao.png'),
(17, 'SP0017', 'Đĩa hoa quả bổ sẵn - Bưởi & Nho', 190000, 169000, 20, '2026-08-05', 4, NULL, 'Việt Nam', 'đĩa', 1, 'Đĩa hoa quả bổ sẵn bưởi đỏ và nho xanh, tươi ngon, trình bày đẹp mắt sẵn sàng thưởng thức.', 'uploads/dia-hoa-qua-buoi-nho.png'),
(18, 'SP0018', 'Hộp quà táo', 320000, 289000, 25, '2026-08-05', 4, NULL, 'Việt Nam', 'hộp', 1, 'Hộp quà táo đỏ tuyển chọn, đóng hộp gỗ kèm nơ, sang trọng, thích hợp làm quà tặng.', 'uploads/hop-qua-tao.jpg'),
(19, 'SP0019', 'Hộp quà nho Kiwi', 450000, 399000, 20, '2026-08-05', 4, NULL, 'Việt Nam', 'hộp', 1, 'Hộp quà kết hợp nho xanh và kiwi tươi, trang trí lá xanh tinh tế, sang trọng để biếu tặng.', 'uploads/hop-qua-nho-kiwi.jpg')
ON DUPLICATE KEY UPDATE ma_san_pham = VALUES(ma_san_pham), ten_san_pham = VALUES(ten_san_pham), gia_san_pham = VALUES(gia_san_pham), gia_khuyen_mai = VALUES(gia_khuyen_mai), so_luong = VALUES(so_luong), ngay_nhap = VALUES(ngay_nhap), danh_muc_id = VALUES(danh_muc_id), nha_cung_cap_id = VALUES(nha_cung_cap_id), xuat_xu = VALUES(xuat_xu), don_vi_tinh = VALUES(don_vi_tinh), trang_thai = VALUES(trang_thai), mo_ta = VALUES(mo_ta), hinh_anh = VALUES(hinh_anh);

-- Với các sản phẩm cũ hơn (nếu có) chưa có mã, tự sinh mã theo id để không bị NULL
UPDATE san_phams SET ma_san_pham = CONCAT('SP', LPAD(id, 4, '0')) WHERE ma_san_pham IS NULL OR ma_san_pham = '';
