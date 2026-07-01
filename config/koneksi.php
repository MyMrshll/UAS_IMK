<?php

// Fungsi sederhana untuk membaca file .env di PHP murni
function loadEnv($path) {
    if (!file_exists($path)) {
        return false;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Abaikan jika baris tersebut adalah komentar
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Pisahkan antara KEY dan VALUE
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        // Masukkan ke dalam Environment Variable PHP
        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv(sprintf('%s=%s', $name, $value));
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Panggil fungsi loadEnv (sesuaikan path menuju file .env Anda)
// Karena koneksi.php ada di folder config/, kita naik satu tingkat ke root folder
loadEnv(__DIR__ . '/../.env');

// Ambil data kredensial dari file .env
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');
$db_port = getenv('DB_PORT') ?: 3306;

// Membuat koneksi menggunakan MySQLi
$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

// Cek apakah koneksi berhasil
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>