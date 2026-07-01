<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_page/login.php");
    exit;
}

$buyer_id = $_SESSION['user_id'];

// Ambil cart
$query = mysqli_query($conn, "
SELECT carts.*, products.harga
FROM carts
JOIN products ON carts.product_id = products.id
WHERE carts.buyer_id='$buyer_id'
");
if (!$query) die("Query Error (SELECT carts): " . mysqli_error($conn));

$total = 0;
$items = [];

while($cart = mysqli_fetch_assoc($query)) {
    $subtotal = $cart['harga'] * $cart['qty'];
    $total += $subtotal;
    $items[] = $cart;
}

// Variabel flag untuk pop-up
$checkout_sukses = false;

if ($total > 0) {
    // Simpan order
    mysqli_query($conn, "
    INSERT INTO orders
    (buyer_id, total_harga)
    VALUES
    ('$buyer_id','$total')
    ");
    if (!mysqli_affected_rows($conn) && mysqli_error($conn)) {
        die("Query Error (INSERT orders): " . mysqli_error($conn));
    }

    $order_id = mysqli_insert_id($conn);

    // Simpan order items
    foreach($items as $item) {
        mysqli_query($conn, "
        INSERT INTO order_items
        (order_id, product_id, qty, harga)
        VALUES
        (
            '$order_id',
            '{$item['product_id']}',
            '{$item['qty']}',
            '{$item['harga']}'
        )
        ");
        if (mysqli_error($conn)) {
            die("Query Error (INSERT order_items): " . mysqli_error($conn));
        }
    }

    // Kosongkan cart
    mysqli_query($conn, "
    DELETE FROM carts
    WHERE buyer_id='$buyer_id'
    ");
    if (mysqli_error($conn)) {
        die("Query Error (DELETE carts): " . mysqli_error($conn));
    }

    $checkout_sukses = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memproses Checkout...</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f3f4f6; }
    </style>
</head>
<body class="flex items-center justify-center min-h-screen">

    <div class="text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-900 mx-auto mb-4"></div>
        <p class="text-gray-600 font-medium">Sedang memproses pesanan Anda...</p>
    </div>

    <script>
        // Jalankan SweetAlert2 jika proses insert database berhasil
        <?php if($checkout_sukses): ?>
            Swal.fire({
                title: 'Checkout Berhasil! 🎉',
                text: 'Pesanan Anda telah sukses dibuat. Mengalihkan ke riwayat belanja...',
                icon: 'success',
                confirmButtonColor: '#1e3a8a', // Warna biru navigasi biar sinkron
                background: '#ffffff',
                customClass: {
                    popup: 'rounded-2xl'
                }
            }).then(() => {
                window.location.href = 'riwayat.php';
            });
        <?php else: ?>
            Swal.fire({
                title: 'Keranjang Kosong!',
                text: 'Tidak ada produk di keranjang untuk diproses.',
                icon: 'error',
                confirmButtonColor: '#1e3a8a',
                customClass: { popup: 'rounded-2xl' }
            }).then(() => {
                window.location.href = 'buyer/dashboard.php';
            });
        <?php endif; ?>
    </script>
</body>
</html>