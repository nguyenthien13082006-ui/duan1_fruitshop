<?php
require 'commons/env.php';
require 'commons/function.php';
try {
    $pdo = connectDB();
    $stmt = $pdo->query('SELECT DATABASE() AS db');
    $row = $stmt->fetch();
    echo "DATABASE=" . $row['db'] . "\n";
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
