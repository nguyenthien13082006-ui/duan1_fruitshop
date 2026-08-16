-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 16, 2026 at 11:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruit_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `binh_luans`
--

CREATE TABLE `binh_luans` (
  `id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `tai_khoan_id` int NOT NULL,
  `noi_dung` text NOT NULL,
  `ngay_dang` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hangs`
--

CREATE TABLE `chi_tiet_don_hangs` (
  `id` int NOT NULL,
  `don_hang_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `don_gia` int NOT NULL,
  `so_luong` int NOT NULL,
  `thanh_tien` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chi_tiet_don_hangs`
--

INSERT INTO `chi_tiet_don_hangs` (`id`, `don_hang_id`, `san_pham_id`, `don_gia`, `so_luong`, `thanh_tien`) VALUES
(1, 1, 1, 75000, 1, 75000);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_gio_hangs`
--

CREATE TABLE `chi_tiet_gio_hangs` (
  `id` int NOT NULL,
  `gio_hang_id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `so_luong` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chuc_vu`
--

CREATE TABLE `chuc_vu` (
  `id` int NOT NULL,
  `ten_chuc_vu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `chuc_vu`
--

INSERT INTO `chuc_vu` (`id`, `ten_chuc_vu`) VALUES
(1, 'Quản trị'),
(2, 'Khách hàng');

-- --------------------------------------------------------

--
-- Table structure for table `danh_gias`
--

CREATE TABLE `danh_gias` (
  `id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `tai_khoan_id` int NOT NULL,
  `so_sao` tinyint NOT NULL DEFAULT '5',
  `noi_dung` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `danh_gias`
--

INSERT INTO `danh_gias` (`id`, `san_pham_id`, `tai_khoan_id`, `so_sao`, `noi_dung`, `created_at`) VALUES
(1, 5, 3, 5, 'ngon', '2026-08-04 14:30:59'),
(2, 1, 4, 5, '', '2026-08-06 10:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `danh_mucs`
--

CREATE TABLE `danh_mucs` (
  `id` int NOT NULL,
  `ten_danh_muc` varchar(100) NOT NULL,
  `mo_ta` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `danh_mucs`
--

INSERT INTO `danh_mucs` (`id`, `ten_danh_muc`, `mo_ta`, `created_at`) VALUES
(1, 'Trái cây nhập khẩu', 'Các loại trái cây chất lượng cao từ các nước', '2026-08-04 14:19:43'),
(2, 'Trái cây theo mùa', 'Các loại trái cây tươi ngon theo mùa', '2026-08-04 14:19:43'),
(3, 'Rau củ quả', 'Rau củ và quả sạch, hữu cơ', '2026-08-04 14:19:43'),
(4, 'Set & Giỏ quà trái cây', 'Đĩa hoa quả bổ sẵn, giỏ quà và hộp quà trái cây cho tặng biếu', '2026-08-05 04:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `don_hangs`
--

CREATE TABLE `don_hangs` (
  `id` int NOT NULL,
  `tai_khoan_id` int NOT NULL,
  `ten_nguoi_nhan` varchar(100) NOT NULL,
  `email_nguoi_nhan` varchar(100) NOT NULL,
  `sdt_nguoi_nhan` varchar(20) NOT NULL,
  `dia_chi_nguoi_nhan` text NOT NULL,
  `ghi_chu` text,
  `tong_tien` int NOT NULL,
  `phuong_thuc_thanh_toan_id` int DEFAULT NULL,
  `ngay_dat` date NOT NULL,
  `trang_thai_id` int DEFAULT '1',
  `ma_don_hang` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `don_hangs`
--

INSERT INTO `don_hangs` (`id`, `tai_khoan_id`, `ten_nguoi_nhan`, `email_nguoi_nhan`, `sdt_nguoi_nhan`, `dia_chi_nguoi_nhan`, `ghi_chu`, `tong_tien`, `phuong_thuc_thanh_toan_id`, `ngay_dat`, `trang_thai_id`, `ma_don_hang`, `created_at`) VALUES
(1, 3, 'nguyen b', 'nguyenb@gmail.com', '0900000001', 'Hà Nội', '', 105000, 2, '2026-08-04', 4, 'DH-2138', '2026-08-04 15:37:55'),
(2, 3, 'nguyen b', 'nguyenb@gmail.com', '0900000001', 'Hà Nội', '', 30000, 2, '2026-08-16', 1, 'DH-5488', '2026-08-16 11:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `gio_hangs`
--

CREATE TABLE `gio_hangs` (
  `id` int NOT NULL,
  `tai_khoan_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `gio_hangs`
--

INSERT INTO `gio_hangs` (`id`, `tai_khoan_id`, `created_at`) VALUES
(3, 4, '2026-08-05 06:15:27'),
(4, 3, '2026-08-16 11:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `hinh_anh_san_phams`
--

CREATE TABLE `hinh_anh_san_phams` (
  `id` int NOT NULL,
  `san_pham_id` int NOT NULL,
  `link_hinh_anh` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hinh_anh_san_phams`
--

INSERT INTO `hinh_anh_san_phams` (`id`, `san_pham_id`, `link_hinh_anh`) VALUES
(1, 1, 'uploads/dua-le-han-quoc.jpg'),
(2, 2, 'uploads/le-han-quoc-evergood.jpg'),
(3, 3, 'uploads/cherry-my.jpg'),
(4, 4, 'uploads/cam-cara-cara.jpg'),
(5, 5, 'uploads/hong-gion-new-zealand.jpg'),
(6, 6, 'uploads/dau-tay.jpg'),
(7, 7, 'uploads/kiwi-xanh.png'),
(8, 8, 'uploads/cam-vang.jpg'),
(9, 1, 'uploads/dua-le-han-quoc.jpg'),
(10, 2, 'uploads/le-han-quoc-evergood.jpg'),
(11, 3, 'uploads/cherry-my.jpg'),
(12, 4, 'uploads/cam-cara-cara.jpg'),
(13, 5, 'uploads/hong-gion-new-zealand.jpg'),
(14, 6, 'uploads/dau-tay.jpg'),
(15, 7, 'uploads/kiwi-xanh.png'),
(16, 8, 'uploads/cam-vang.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lien_he`
--

CREATE TABLE `lien_he` (
  `id` int NOT NULL,
  `ho_ten` varchar(150) NOT NULL,
  `so_dien_thoai` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `tieu_de` varchar(255) DEFAULT NULL,
  `noi_dung` text NOT NULL,
  `phan_hoi` text,
  `trang_thai` varchar(100) DEFAULT 'Chưa xử lý',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lien_he`
--

INSERT INTO `lien_he` (`id`, `ho_ten`, `so_dien_thoai`, `email`, `tieu_de`, `noi_dung`, `phan_hoi`, `trang_thai`, `created_at`) VALUES
(1, 'Nguyễn', '0385600666', 'nguyenthien1308@gmail.com', 'hỗ trợ', 'hi', NULL, 'Chưa xử lý', '2026-08-07 05:58:59'),
(2, 'Nguyễn', '0385600666', 'nguyenthien1308@gmail.com', 'hỗ trợ', 'hi', 'chào bạn', 'Đã trả lời', '2026-08-07 05:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `nha_cung_caps`
--

CREATE TABLE `nha_cung_caps` (
  `id` int NOT NULL,
  `ten_nha_cung_cap` varchar(150) NOT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `mo_ta` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `nha_cung_caps`
--

INSERT INTO `nha_cung_caps` (`id`, `ten_nha_cung_cap`, `dia_chi`, `so_dien_thoai`, `mo_ta`, `created_at`) VALUES
(1, 'VinEco', 'Hà Nội', NULL, 'Nông trại rau củ quả công nghệ cao', '2026-08-04 14:19:42'),
(2, 'Dalat GAP', 'Đà Lạt, Lâm Đồng', NULL, 'Trái cây đạt chuẩn VietGAP vùng Đà Lạt', '2026-08-04 14:19:42'),
(3, 'Klever Fruits', 'TP. Hồ Chí Minh', NULL, 'Trái cây nhập khẩu cao cấp', '2026-08-04 14:19:42'),
(4, 'Fruit Republic', 'Tiền Giang', NULL, 'Trái cây xuất khẩu đạt chuẩn quốc tế', '2026-08-04 14:19:42'),
(5, 'Nông trại Đồng Nai', 'Đồng Nai', NULL, 'Trái cây tươi sạch trồng tại Đồng Nai', '2026-08-04 14:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `phuong_thuc_thanh_toans`
--

CREATE TABLE `phuong_thuc_thanh_toans` (
  `id` int NOT NULL,
  `ten_phuong_thuc` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `phuong_thuc_thanh_toans`
--

INSERT INTO `phuong_thuc_thanh_toans` (`id`, `ten_phuong_thuc`) VALUES
(1, 'Thanh toán khi nhận hàng'),
(2, 'Chuyển khoản ngân hàng');

-- --------------------------------------------------------

--
-- Table structure for table `san_phams`
--

CREATE TABLE `san_phams` (
  `id` int NOT NULL,
  `ma_san_pham` varchar(20) DEFAULT NULL,
  `ten_san_pham` varchar(150) NOT NULL,
  `gia_san_pham` int NOT NULL,
  `gia_khuyen_mai` int DEFAULT NULL,
  `so_luong` int DEFAULT '0',
  `luot_xem` int DEFAULT '0',
  `ngay_nhap` date NOT NULL,
  `danh_muc_id` int NOT NULL,
  `nha_cung_cap_id` int DEFAULT NULL,
  `xuat_xu` varchar(100) DEFAULT NULL,
  `don_vi_tinh` varchar(50) DEFAULT 'kg',
  `trang_thai` tinyint(1) DEFAULT '1',
  `mo_ta` text,
  `hinh_anh` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `san_phams`
--

INSERT INTO `san_phams` (`id`, `ma_san_pham`, `ten_san_pham`, `gia_san_pham`, `gia_khuyen_mai`, `so_luong`, `luot_xem`, `ngay_nhap`, `danh_muc_id`, `nha_cung_cap_id`, `xuat_xu`, `don_vi_tinh`, `trang_thai`, `mo_ta`, `hinh_anh`, `created_at`) VALUES
(1, 'SP0001', 'Dưa lê Hàn Quốc', 85000, 75000, 60, 0, '2026-08-01', 1, 3, 'Hàn Quốc', 'kg', 1, 'Dưa lê vàng Hàn Quốc ruột giòn, vị ngọt thanh mát, thơm dịu, nhập khẩu chính ngạch.', 'uploads/dua-le-han-quoc.jpg', '2026-08-04 14:19:43'),
(2, 'SP0002', 'Lê Hàn Quốc Evergood', 180000, 159000, 50, 0, '2026-08-01', 1, 3, 'Hàn Quốc', 'kg', 1, 'Lê Hàn Quốc thương hiệu Evergood, quả to tròn, vỏ vàng nâu, ruột trắng giòn mọng nước, vị ngọt thanh.', 'uploads/le-han-quoc-evergood.jpg', '2026-08-04 14:19:43'),
(3, 'SP0003', 'Cherry Mỹ', 550000, 490000, 30, 0, '2026-08-01', 1, 3, 'Mỹ', 'kg', 1, 'Cherry Mỹ đỏ mọng, trái to đều, độ ngọt (Brix) trên 22 độ, nhập khẩu trực tiếp bằng đường bay.', 'uploads/cherry-my.jpg', '2026-08-04 14:19:43'),
(4, 'SP0004', 'Cam ruột đỏ Cara Cara', 110000, 95000, 80, 0, '2026-08-01', 1, 3, 'Mỹ', 'kg', 1, 'Cam Cara Cara ruột đỏ hồng, mọng nước, vị ngọt dịu ít chua, giàu vitamin C và chất chống oxy hóa.', 'uploads/cam-cara-cara.jpg', '2026-08-04 14:19:43'),
(5, 'SP0005', 'Hồng giòn New Zealand', 145000, 129000, 45, 0, '2026-08-01', 1, 3, 'New Zealand', 'kg', 1, 'Hồng giòn nhập khẩu New Zealand, quả tròn đều, vị ngọt giòn, không chát, ăn liền không cần ủ chín.', 'uploads/hong-gion-new-zealand.jpg', '2026-08-04 14:19:43'),
(6, 'SP0006', 'Dâu tây', 150000, 135000, 40, 0, '2026-08-01', 2, 2, 'Đà Lạt, Việt Nam', 'hộp', 1, 'Dâu tây tươi ngon, quả đỏ mọng, vị chua ngọt hài hòa, giàu vitamin C.', 'uploads/dau-tay.jpg', '2026-08-04 14:19:43'),
(7, 'SP0007', 'Kiwi xanh New Zealand', 120000, 105000, 55, 0, '2026-08-02', 1, 3, 'New Zealand', 'kg', 1, 'Kiwi xanh New Zealand ruột xanh mướt, hạt nhỏ đều, vị chua ngọt thanh mát, giàu vitamin C.', 'uploads/kiwi-xanh.png', '2026-08-04 14:19:43'),
(8, 'SP0008', 'Cam vàng nhập khẩu', 90000, 79000, 70, 0, '2026-08-02', 1, 4, 'Úc', 'kg', 1, 'Cam vàng nhập khẩu ruột vàng ươm, mọng nước, vị ngọt thanh, thích hợp vắt nước hoặc ăn trực tiếp.', 'uploads/cam-vang.jpg', '2026-08-04 14:19:43'),
(9, 'SP0009', 'Chôm chôm', 45000, 39000, 90, 0, '2026-08-05', 2, 5, 'Việt Nam', 'kg', 1, 'Chôm chôm tươi, vỏ đỏ gai mềm, cùi giòn ngọt, tách hạt dễ dàng.', 'uploads/chom-chom.jpg', '2026-08-05 04:12:54'),
(10, 'SP0010', 'Dưa lưới ruột xanh', 65000, 55000, 50, 0, '2026-08-05', 2, 1, 'Việt Nam', 'kg', 1, 'Dưa lưới trồng trong nhà màng công nghệ cao, vỏ lưới đều, ruột xanh giòn, vị ngọt mát, an toàn.', 'uploads/dua-luoi.jpg', '2026-08-05 04:12:54'),
(11, 'SP0011', 'Hồng giòn Mộc Châu', 70000, 62000, 55, 0, '2026-08-05', 2, 2, 'Mộc Châu, Việt Nam', 'kg', 1, 'Hồng giòn đặc sản Mộc Châu, quả vàng cam, ăn giòn ngọt ngay không cần ủ chín.', 'uploads/hong-gion-moc-chau.png', '2026-08-05 04:12:54'),
(12, 'SP0012', 'Bưởi da xanh', 55000, 48000, 65, 0, '2026-08-05', 2, 2, 'Bến Tre, Việt Nam', 'quả', 1, 'Bưởi da xanh ruột hồng, múi mọng nước, vị ngọt thanh ít hạt, đặc sản miền Tây.', 'uploads/buoi-da-xanh.jpg', '2026-08-05 04:12:54'),
(13, 'SP0013', 'Quýt ngọt', 60000, 52000, 60, 0, '2026-08-05', 2, 2, 'Việt Nam', 'kg', 1, 'Quýt ngọt vỏ xanh, tép cam vàng mọng nước, vị ngọt thanh dịu, dễ bóc vỏ.', 'uploads/quyt-ngot.jpg', '2026-08-05 04:12:54'),
(14, 'SP0014', 'Đĩa hoa quả bổ sẵn - Bưởi đỏ', 180000, 159000, 20, 0, '2026-08-05', 4, NULL, 'Việt Nam', 'đĩa', 1, 'Đĩa hoa quả bổ sẵn với bưởi đỏ tách múi trình bày đẹp mắt, tiện lợi cho tiệc, họp mặt.', 'uploads/dia-hoa-qua-buoi-do.jpg', '2026-08-05 04:12:54'),
(15, 'SP0015', 'Đĩa hoa quả bổ sẵn - Mận & Nho', 220000, 195000, 20, 0, '2026-08-05', 4, NULL, 'Việt Nam', 'đĩa', 1, 'Đĩa hoa quả bổ sẵn thập cẩm: mận, nho đen, nho đỏ, cherry, trình bày đẹp mắt sang trọng.', 'uploads/dia-hoa-qua-man-nho.jpg', '2026-08-05 04:12:54'),
(16, 'SP0016', 'Giỏ quà táo cao cấp', 850000, 790000, 15, 0, '2026-08-05', 4, NULL, 'Việt Nam', 'giỏ', 1, 'Giỏ quà táo nhập khẩu cao cấp, gói nơ sang trọng, phù hợp biếu tặng dịp lễ, thăm hỏi.', 'uploads/gio-qua-tao.png', '2026-08-05 04:12:54'),
(17, 'SP0017', 'Đĩa hoa quả bổ sẵn - Bưởi & Nho', 190000, 169000, 20, 0, '2026-08-05', 4, NULL, 'Việt Nam', 'đĩa', 1, 'Đĩa hoa quả bổ sẵn bưởi đỏ và nho xanh, tươi ngon, trình bày đẹp mắt sẵn sàng thưởng thức.', 'uploads/dia-hoa-qua-buoi-nho.png', '2026-08-05 04:12:54'),
(18, 'SP0018', 'Hộp quà táo', 320000, 289000, 25, 0, '2026-08-05', 4, NULL, 'Việt Nam', 'hộp', 1, 'Hộp quà táo đỏ tuyển chọn, đóng hộp gỗ kèm nơ, sang trọng, thích hợp làm quà tặng.', 'uploads/hop-qua-tao.jpg', '2026-08-05 04:12:54'),
(19, 'SP0019', 'Hộp quà nho Kiwi', 450000, 399000, 20, 0, '2026-08-05', 4, NULL, 'Việt Nam', 'hộp', 1, 'Hộp quà kết hợp nho xanh và kiwi tươi, trang trí lá xanh tinh tế, sang trọng để biếu tặng.', 'uploads/hop-qua-nho-kiwi.jpg', '2026-08-05 04:12:54'),
(20, 'SP0020', 'Rau chân vịt', 18000, 15000, 80, 0, '2026-08-16', 3, 1, 'Việt Nam', 'bó', 1, 'Rau chân vịt xanh mướt, lá mềm, thơm ngon, giàu sắt và vitamin, thích hợp nấu canh hoặc xào.', 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?auto=format&fit=crop&w=900&q=80', '2026-08-16 11:29:09'),
(21, 'SP0021', 'Bắp cải kale', 35000, 29000, 50, 0, '2026-08-16', 3, 1, 'Việt Nam', 'kg', 1, 'Bắp cải kale xanh non, tán lá xoăn, giòn ngon, giàu dinh dưỡng, phù hợp xào, nấu soup hoặc làm salad.', 'https://images.unsplash.com/photo-1518843875459-f738682238a6?auto=format&fit=crop&w=900&q=80', '2026-08-16 11:29:09'),
(22, 'SP0022', 'Ớt chuông đỏ', 30000, 26000, 60, 0, '2026-08-16', 3, 1, 'Việt Nam', 'kg', 1, 'Ớt chuông đỏ ngọt thanh, giòn và đẹp mắt, giàu vitamin C, dùng làm salad, xào hoặc nướng.', 'https://images.unsplash.com/photo-1563565375-f3fdfdbefa83?auto=format&fit=crop&w=900&q=80', '2026-08-16 11:29:09'),
(23, 'SP0023', 'Ớt chuông vàng', 32000, 28000, 55, 0, '2026-08-16', 3, 1, 'Việt Nam', 'kg', 1, 'Ớt chuông vàng ngọt dịu, vị thơm và màu sắc bắt mắt, rất phù hợp ăn sống hoặc làm món xào.', 'https://images.unsplash.com/photo-1588168345216-5356f9b7d0c5?auto=format&fit=crop&w=900&q=80', '2026-08-16 11:59:17'),
(24, 'SP0024', 'Ớt chuông xanh', 28000, 24000, 60, 0, '2026-08-16', 3, 1, 'Việt Nam', 'kg', 1, 'Ớt chuông xanh giòn, vị ngọt nhẹ, đa dụng trong nấu ăn và ăn sống, giữ được hương vị tươi mới.', 'https://images.unsplash.com/photo-1615485290382-441e4d049cb5?auto=format&fit=crop&w=900&q=80', '2026-08-16 11:59:17'),
(25, 'SP0025', 'Rúgula / Xà lách xoăn', 24000, 21000, 70, 0, '2026-08-16', 3, 1, 'Việt Nam', 'bó', 1, 'Rúgula xanh đậm, lá nhỏ gân rõ, hương vị đậm đà và giòn, thích hợp làm salad hoặc ăn kèm các món nướng.', 'https://images.unsplash.com/photo-1542838132-92c53300491e?auto=format&fit=crop&w=900&q=80', '2026-08-16 11:29:09'),
(26, 'SP0026', 'Cần tây', 22000, 19000, 75, 0, '2026-08-16', 3, 1, 'Việt Nam', 'bó', 1, 'Cần tây xanh tươi, cuống giòn, nhiều nước, rất tốt cho sức khỏe, dùng nấu soup, xào hoặc ép nước.', 'https://images.unsplash.com/photo-1556801712-76c8eb07bbc9?auto=format&fit=crop&w=900&q=80', '2026-08-16 11:29:09');

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoans`
--

CREATE TABLE `tai_khoans` (
  `id` int NOT NULL,
  `ho_ten` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `so_dien_thoai` varchar(20) DEFAULT NULL,
  `dia_chi` text,
  `ngay_sinh` date DEFAULT NULL,
  `gioi_tinh` tinyint(1) DEFAULT '1',
  `chuc_vu_id` int DEFAULT '2',
  `trang_thai` tinyint(1) DEFAULT '1',
  `anh_dai_dien` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tai_khoans`
--

INSERT INTO `tai_khoans` (`id`, `ho_ten`, `email`, `mat_khau`, `so_dien_thoai`, `dia_chi`, `ngay_sinh`, `gioi_tinh`, `chuc_vu_id`, `trang_thai`, `anh_dai_dien`, `created_at`) VALUES
(1, 'Quản trị viên', 'admin@fruitshop.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0900000001', 'Hà Nội', '1990-01-01', 1, 1, 1, NULL, '2026-08-04 14:19:43'),
(2, 'Nguyễn Minh An', 'khachhang1@gmail.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0900000002', 'Đà Nẵng', '1998-05-10', 2, 2, 1, NULL, '2026-08-04 14:19:43'),
(3, 'nguyen b', 'nguyenb@gmail.com', '$2y$10$Q2UxSvCzeoQDYOIa2sBUKOyGecg.b6qiINcL.7FxNHcVOpnfWzRWC', '0900000001', 'Hà Nội', '2005-02-12', 1, 2, 1, NULL, '2026-08-04 14:30:38'),
(4, 'ngô quốc thái', 'thainq123@gmail.com', '$2y$10$qCEogO3no9hKNt3KMj3eJut65o1WTA2dSGktfFhc34SL/6APzykKO', '0355659875', 'Hà Nội', '2006-04-13', 1, 2, 1, NULL, '2026-08-05 06:08:52'),
(5, 'nguyen ngoc thien', 'ngocthien13082006@gmail.com', '$2y$10$vJNKcyCz0K0v23Kd.5owG.KnjTk6eRCDurre/uCSwfqQRiBaOj2WW', '0385600521', '', NULL, 1, 1, 1, NULL, '2026-08-16 11:50:34');

-- --------------------------------------------------------

--
-- Table structure for table `trang_thai_don_hangs`
--

CREATE TABLE `trang_thai_don_hangs` (
  `id` int NOT NULL,
  `ten_trang_thai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `trang_thai_don_hangs`
--

INSERT INTO `trang_thai_don_hangs` (`id`, `ten_trang_thai`) VALUES
(1, 'Chờ xác nhận'),
(2, 'Đã xác nhận'),
(3, 'Đang giao'),
(4, 'Hoàn thành'),
(11, 'Đã hủy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_pham_id` (`san_pham_id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`);

--
-- Indexes for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `don_hang_id` (`don_hang_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gio_hang_id` (`gio_hang_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `chuc_vu`
--
ALTER TABLE `chuc_vu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `danh_gias`
--
ALTER TABLE `danh_gias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_rating_per_product` (`san_pham_id`,`tai_khoan_id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`);

--
-- Indexes for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`),
  ADD KEY `phuong_thuc_thanh_toan_id` (`phuong_thuc_thanh_toan_id`),
  ADD KEY `trang_thai_id` (`trang_thai_id`);

--
-- Indexes for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`);

--
-- Indexes for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `lien_he`
--
ALTER TABLE `lien_he`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nha_cung_caps`
--
ALTER TABLE `nha_cung_caps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD PRIMARY KEY (`id`),
  ADD KEY `danh_muc_id` (`danh_muc_id`),
  ADD KEY `nha_cung_cap_id` (`nha_cung_cap_id`);

--
-- Indexes for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `chuc_vu_id` (`chuc_vu_id`);

--
-- Indexes for table `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binh_luans`
--
ALTER TABLE `binh_luans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chuc_vu`
--
ALTER TABLE `chuc_vu`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `danh_gias`
--
ALTER TABLE `danh_gias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `danh_mucs`
--
ALTER TABLE `danh_mucs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `don_hangs`
--
ALTER TABLE `don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `lien_he`
--
ALTER TABLE `lien_he`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nha_cung_caps`
--
ALTER TABLE `nha_cung_caps`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `phuong_thuc_thanh_toans`
--
ALTER TABLE `phuong_thuc_thanh_toans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `san_phams`
--
ALTER TABLE `san_phams`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trang_thai_don_hangs`
--
ALTER TABLE `trang_thai_don_hangs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binh_luans`
--
ALTER TABLE `binh_luans`
  ADD CONSTRAINT `binh_luans_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `binh_luans_ibfk_2` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chi_tiet_don_hangs`
--
ALTER TABLE `chi_tiet_don_hangs`
  ADD CONSTRAINT `chi_tiet_don_hangs_ibfk_1` FOREIGN KEY (`don_hang_id`) REFERENCES `don_hangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_don_hangs_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`);

--
-- Constraints for table `chi_tiet_gio_hangs`
--
ALTER TABLE `chi_tiet_gio_hangs`
  ADD CONSTRAINT `chi_tiet_gio_hangs_ibfk_1` FOREIGN KEY (`gio_hang_id`) REFERENCES `gio_hangs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chi_tiet_gio_hangs_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`);

--
-- Constraints for table `danh_gias`
--
ALTER TABLE `danh_gias`
  ADD CONSTRAINT `danh_gias_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `danh_gias_ibfk_2` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `don_hangs`
--
ALTER TABLE `don_hangs`
  ADD CONSTRAINT `don_hangs_ibfk_1` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoans` (`id`),
  ADD CONSTRAINT `don_hangs_ibfk_2` FOREIGN KEY (`phuong_thuc_thanh_toan_id`) REFERENCES `phuong_thuc_thanh_toans` (`id`),
  ADD CONSTRAINT `don_hangs_ibfk_3` FOREIGN KEY (`trang_thai_id`) REFERENCES `trang_thai_don_hangs` (`id`);

--
-- Constraints for table `gio_hangs`
--
ALTER TABLE `gio_hangs`
  ADD CONSTRAINT `gio_hangs_ibfk_1` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `hinh_anh_san_phams`
--
ALTER TABLE `hinh_anh_san_phams`
  ADD CONSTRAINT `hinh_anh_san_phams_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_phams` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `san_phams`
--
ALTER TABLE `san_phams`
  ADD CONSTRAINT `san_phams_ibfk_1` FOREIGN KEY (`danh_muc_id`) REFERENCES `danh_mucs` (`id`),
  ADD CONSTRAINT `san_phams_ibfk_2` FOREIGN KEY (`nha_cung_cap_id`) REFERENCES `nha_cung_caps` (`id`);

--
-- Constraints for table `tai_khoans`
--
ALTER TABLE `tai_khoans`
  ADD CONSTRAINT `tai_khoans_ibfk_1` FOREIGN KEY (`chuc_vu_id`) REFERENCES `chuc_vu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
