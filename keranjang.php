<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_page/login.php");
    exit;
}

$buyer_id = $_SESSION['user_id'];

// Logika Hapus Item dari Keranjang (Jika parameter hapus dipicu)
if (isset($_GET['hapus'])) {
    $id_cart = mysqli_real_escape_string($conn, $_GET['hapus']);
    $hapus_query = mysqli_query($conn, "DELETE FROM carts WHERE id='$id_cart' AND buyer_id='$buyer_id'");
    if (!$hapus_query) die("Query Error (DELETE carts): " . mysqli_error($conn));
    if ($hapus_query) {
        header("Location: keranjang.php?status=terhapus");
        exit;
    }
}

$query = mysqli_query($conn, "
SELECT carts.*, products.nama_produk, products.harga,
products.gambar
FROM carts
JOIN products ON carts.product_id = products.id
WHERE carts.buyer_id='$buyer_id'
");

if (!$query) die("Query Error (SELECT carts JOIN products): " . mysqli_error($conn));

$total = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

<nav class="bg-blue-900 text-white p-5 flex justify-between items-center shadow-md">
    <h1 class="text-2xl font-bold flex items-center gap-2">
        <span class="material-symbols-outlined">shopping_cart</span> Keranjang Saya
    </h1>
    <a href="buyer/dashboard.php" class="bg-white text-blue-900 px-4 py-2 rounded-lg font-semibold shadow hover:bg-gray-100 transition flex items-center gap-1">
        <span class="material-symbols-outlined text-[20px]">arrow_back</span> Kembali
    </a>
</nav>

<div class="max-w-5xl mx-auto p-10">

    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">

        <?php 
        if (mysqli_num_rows($query) > 0) {
            while($cart = mysqli_fetch_assoc($query)) {
                $subtotal = $cart['harga'] * $cart['qty'];
                $total += $subtotal;
        ?>

        <div class="flex items-center gap-5 border-b py-5 hover:bg-gray-50/50 px-2 rounded-xl transition">

            <img src="assets/uploads/<?php echo $cart['gambar']; ?>" class="w-28 h-28 object-cover rounded-xl border border-gray-200 shadow-sm">

            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-800">
                    <?php echo $cart['nama_produk']; ?>
                </h2>
                <p class="text-gray-500 font-medium mt-1 bg-gray-100 px-2.5 py-0.5 rounded-md inline-block text-sm">
                    Qty: <?php echo $cart['qty']; ?>
                </p>
            </div>

            <div class="text-right flex flex-col items-end gap-3">
                <p class="font-bold text-blue-900 text-xl">
                    Rp <?php echo number_format($subtotal, 0, ',', '.'); ?>
                </p>
                <button onclick="konfirmasiHapusItem(<?= $cart['id']; ?>)" class="p-1.5 text-red-500 hover:bg-red-50 border border-dashed border-transparent hover:border-red-200 rounded-lg transition-all flex items-center" title="Hapus dari keranjang">
                    <span class="material-symbols-outlined text-[22px]">delete</span>
                </button>
            </div>

        </div>

        <?php 
            } 
        ?>

        <div class="mt-8 flex justify-between items-center bg-blue-50/50 p-5 rounded-xl border border-blue-100">
            <h2 class="text-2xl font-bold text-gray-700">Total Belanja:</h2>
            <h2 class="text-3xl font-bold text-blue-950">
                Rp <?php echo number_format($total, 0, ',', '.'); ?>
            </h2>
        </div>

        <button onclick="konfirmasiCheckout()" class="w-full block text-auto mt-8 bg-blue-900 hover:bg-blue-800 text-white text-center py-4 rounded-xl font-bold transition text-lg shadow-md tracking-wide">
            Proses ke Checkout
        </button>

        <?php 
        } else { 
        ?>
        <div class="text-center py-12 text-gray-400">
            <span class="material-symbols-outlined text-6xl mb-3 text-gray-300">shopping_basket</span>
            <p class="text-lg font-medium">Keranjang belanja Anda masih kosong.</p>
            <a href="buyer/dashboard.php" class="mt-4 inline-block bg-blue-900 text-white px-5 py-2 rounded-xl font-semibold hover:bg-blue-800 transition">Mulai Belanja</a>
        </div>
        <?php 
        } 
        ?>

    </div>

</div>

<script>
    // 1. Pop-up Konfirmasi Hapus Item
    function konfirmasiHapusItem(id) {
        Swal.fire({
            title: 'Hapus produk?',
            text: "Barang ini akan dikeluarkan dari daftar keranjang belanja Anda.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1e3a8a', // Biru Nav
            cancelButtonColor: '#ef4444',  // Merah
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: { popup: 'rounded-2xl' }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `keranjang.php?hapus=${id}`;
            }
        })
    }

    // 2. Pop-up Konfirmasi Sebelum Masuk Ke Checkout
    function konfirmasiCheckout() {
        Swal.fire({
            title: 'Lanjutkan ke Checkout?',
            text: 'Pastikan kuantitas produk dan item belanjaan Anda sudah sesuai.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#1e3a8a',
            cancelButtonColor: '#6b7280', // Abu-abu
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Periksa Kembali',
            customClass: { popup: 'rounded-2xl' }
        }).then((result) => {
            if (result.isConfirmed) {
                // Berpindah ke halaman checkout bawaan kamu
                window.location.href = 'checkout.php';
            }
        })
    }

    // 3. Notifikasi Berhasil Dihapus setelah Halaman Reload
    <?php if(isset($_GET['status']) && $_GET['status'] == 'terhapus'): ?>
        Swal.fire({
            title: 'Terhapus!',
            text: 'Item berhasil dikeluarkan dari keranjang.',
            icon: 'success',
            confirmButtonColor: '#1e3a8a',
            customClass: { popup: 'rounded-2xl' }
        }).then(() => {
            // Bersihkan parameter URL agar tidak memicu alert berulang saat di-refresh
            window.location.href = 'keranjang.php';
        });
    <?php endif; ?>
</script>

</body>
</html>