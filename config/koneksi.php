<?php

// Fungsi sederhana untuk membaca file .env di PHP murni
function loadEnv($path) {
    if (!file_exists($path)) {
        return false;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        // Abaikan jika baris tersebut adalah komentar atau kosong
        if (empty($line) || strpos($line, '#') === 0) {
            continue;
        }

        // Pisahkan antara KEY dan VALUE
        if (strpos($line, '=') !== false) {
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
}

// Panggil fungsi loadEnv (sesuaikan path menuju file .env Anda)
loadEnv(__DIR__ . '/../.env');

// Ambil data kredensial dari file .env
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');
$db_port = getenv('DB_PORT') ?: 3306;

// Agar error tidak langsung 500 (terutama di PHP 8.1+)
mysqli_report(MYSQLI_REPORT_OFF);

// Membuat koneksi menggunakan MySQLi dengan SSL support (dibutuhkan untuk Aiven dsb)
$conn = mysqli_init();
if (!$conn) {
    die("Koneksi database gagal (mysqli_init).");
}

// Coba koneksi menggunakan SSL jika mendukung, kalau gagal ya gagal
$koneksi_berhasil = @mysqli_real_connect($conn, $db_host, $db_user, $db_pass, $db_name, $db_port, NULL, MYSQLI_CLIENT_SSL);

if (!$koneksi_berhasil) {
    // Fallback coba tanpa SSL jika SSL gagal (untuk localhost)
    $conn = mysqli_init();
    $koneksi_berhasil_tanpa_ssl = @mysqli_real_connect($conn, $db_host, $db_user, $db_pass, $db_name, $db_port);
    
    if (!$koneksi_berhasil_tanpa_ssl) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }
}

// Buat alias $koneksi agar script yang menggunakan $koneksi tetap jalan
$koneksi = $conn;

?>