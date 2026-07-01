<?php
include 'config/koneksi.php';

echo "<h1>Setup Database UMKM Market</h1>";

$queries = [
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role ENUM('buyer', 'seller') NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        seller_id INT NOT NULL,
        nama_produk VARCHAR(255) NOT NULL,
        harga DECIMAL(10,2) NOT NULL,
        deskripsi TEXT,
        gambar VARCHAR(255),
        stok INT DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (seller_id) REFERENCES users(id) ON DELETE CASCADE
    )",

    "CREATE TABLE IF NOT EXISTS carts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        buyer_id INT NOT NULL,
        product_id INT NOT NULL,
        qty INT NOT NULL DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (buyer_id) REFERENCES users(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    )",

    "CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        buyer_id INT NOT NULL,
        total_harga DECIMAL(12,2) NOT NULL,
        status VARCHAR(50) DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (buyer_id) REFERENCES users(id) ON DELETE CASCADE
    )",

    "CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        product_id INT NOT NULL,
        qty INT NOT NULL,
        harga DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    )",

    // --- DUMMY DATA ---
    // User Seller: seller@example.com / password: password123
    "INSERT IGNORE INTO users (id, nama, email, password, role) VALUES 
    (1, 'Toko Budi', 'seller@example.com', 'password123', 'seller')",

    // User Buyer: buyer@example.com / password: password123
    "INSERT IGNORE INTO users (id, nama, email, password, role) VALUES 
    (2, 'Andi Pembeli', 'buyer@example.com', 'password123', 'buyer')",

    // Dummy Products for Seller 1
    "INSERT IGNORE INTO products (id, seller_id, nama_produk, harga, deskripsi, gambar, stok) VALUES 
    (1, 1, 'Keripik Tempe', 15000, 'Keripik tempe renyah dan gurih khas daerah.', '1782902284_Keripik Tempe.jpeg', 50)",
    
    "INSERT IGNORE INTO products (id, seller_id, nama_produk, harga, deskripsi, gambar, stok) VALUES 
    (2, 1, 'Baju Adat Gayo Aceh', 350000, 'Baju adat khas Gayo Aceh asli, bahan nyaman dipakai.', '1782902532_Baju Adat Gayo Aceh.jpeg', 15)",
    
    "INSERT IGNORE INTO products (id, seller_id, nama_produk, harga, deskripsi, gambar, stok) VALUES 
    (3, 1, 'Kerajinan Tangan Khas', 50000, 'Produk kerajinan UMKM berkualitas tinggi.', '1782901269_images.jpg', 10)"
];

foreach ($queries as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color: green;'>Sukses mengeksekusi tabel.</p>";
    } else {
        echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}

echo "<h3>Setup & Dummy Data Berhasil Dibuat!</h3>";
echo "<ul>
        <li><b>Akun Penjual:</b> seller@example.com | <b>Password:</b> password123</li>
        <li><b>Akun Pembeli:</b> buyer@example.com | <b>Password:</b> password123</li>
      </ul>";
echo "<p>Hapus file ini setelah dijalankan untuk keamanan.</p>";
echo "<a href='index.php'>Kembali ke Aplikasi (Login)</a>";
?>
