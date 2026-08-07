<?php
require 'commons/env.php';
require 'commons/function.php';
$sql = "CREATE TABLE IF NOT EXISTS lien_he (
  id INT AUTO_INCREMENT PRIMARY KEY,
  ho_ten VARCHAR(150) NOT NULL,
  so_dien_thoai VARCHAR(50) NOT NULL,
  email VARCHAR(150) NOT NULL,
  tieu_de VARCHAR(255) DEFAULT NULL,
  noi_dung TEXT NOT NULL,
  phan_hoi TEXT DEFAULT NULL,
  trang_thai VARCHAR(100) DEFAULT 'Chưa xử lý',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
try {
    $pdo = connectDB();
    $pdo->exec($sql);
    echo "TABLE CREATED OR ALREADY EXISTS\n";
    $stmt = $pdo->query("SHOW TABLES LIKE 'lien_he'");
    $tables = $stmt->fetchAll();
    echo count($tables) . " table(s) found\n";
    if (count($tables)) {
        $stmt = $pdo->query('SELECT COUNT(*) AS c FROM lien_he');
        $row = $stmt->fetch();
        echo 'rows=' . $row['c'] . "\n";
    }
} catch (Exception $e) {
    echo 'ERROR: ' . $e->getMessage() . "\n";
}
