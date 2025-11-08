<?php
// db_connect.php — simple PDO SQLite helper
$dbDir = __DIR__ . '/data';
if (!is_dir($dbDir)) mkdir($dbDir, 0755, true);
$dbFile = $dbDir . '/database.sqlite';

$need_create = !file_exists($dbFile);

try {
    $pdo = new PDO('sqlite:' . $dbFile);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($need_create) {
        $sql = "CREATE TABLE IF NOT EXISTS student (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            fullname TEXT NOT NULL,
            email TEXT NOT NULL,
            phone TEXT,
            gender TEXT,
            course TEXT,
            address TEXT,
            reg_date DATETIME DEFAULT CURRENT_TIMESTAMP
        )";
        $pdo->exec($sql);
    }
} catch (PDOException $e) {
    // show helpful error for debugging
    echo "DB error: " . htmlspecialchars($e->getMessage());
    exit;
}
