<?php
session_start();
include '../config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_page/login.php");
    exit;
}

$buyer_id = $_SESSION['user_id'];
$alert = '';

// ================= LOGIKA: TAMBAH KE KERANJANG =================
if (isset($_POST['add_to_cart'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $qty = (int)$_POST['qty'];

    if ($qty > 0) {
        // Cek dulu apakah produk ini sudah ada di keranjang buyer
        $cek_keranjang = mysqli_query($conn, "SELECT * FROM carts WHERE buyer_id='$buyer_id' AND product_id='$product_id'");
        if (!$cek_keranjang) die("Query Error (SELECT carts): " . mysqli_error($conn));
        
        if (mysqli_num_rows($cek_keranjang) > 0) {
            // Jika sudah ada, tinggal update kuantitas/nominal barangnya
            $data_cart = mysqli_fetch_assoc($cek_keranjang);
            $qty_baru = $data_cart['qty'] + $qty;
            $update = mysqli_query($conn, "UPDATE carts SET qty='$qty_baru' WHERE buyer_id='$buyer_id' AND product_id='$product_id'");
            if (!$update) die("Query Error (UPDATE carts): " . mysqli_error($conn));
            $alert = 'sukses';
        } else {
            // Jika belum ada, lakukan insert data baru
            $insert = mysqli_query($conn, "INSERT INTO carts (buyer_id, product_id, qty) VALUES ('$buyer_id', '$product_id', '$qty')");
            if (!$insert) die("Query Error (INSERT carts): " . mysqli_error($conn));
            $alert = 'sukses';
        }
    }
}

// Ambil total nominal item unik di keranjang untuk badge navbar
$query_badge = mysqli_query($conn, "SELECT SUM(qty) as total_item FROM carts WHERE buyer_id='$buyer_id'");
if (!$query_badge) die("Query Error (SELECT SUM carts): " . mysqli_error($conn));
$data_badge = mysqli_fetch_assoc($query_badge);
$total_keranjang = $data_badge['total_item'] ?? 0;

// Ambil semua produk untuk katalog
$query = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
if (!$query) die("Query Error (SELECT products): " . mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buyer Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">

    <nav class="bg-blue-900 text-white p-5 flex justify-between items-center shadow-lg sticky top-0 z-50">

        <h1 class="text-2xl font-bold tracking-wide">
            UMKM Marketplace
        </h1>

        <div class="flex items-center gap-6">

            <span class="font-medium hidden sm:inline text-blue-100">
                Halo, <strong class="text-white"><?php echo htmlspecialchars($_SESSION['nama']); ?></strong>
            </span>

            <a href="../keranjang.php" class="relative flex items-center p-2.5 bg-blue-800 hover:bg-blue-700 rounded-xl transition shadow-inner" title="Lihat Keranjang Saya">
                <span class="material-symbols-outlined text-[26px]">shopping_cart</span>
                <?php if ($total_keranjang > 0): ?>
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white font-bold text-xs w-6 h-6 flex items-center justify-center rounded-full shadow-md animate-bounce">
                        <?php echo $total_keranjang; ?>
                    </span>
                <?php endif; ?>
            </a>

            <a href="../logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-xl transition font-semibold shadow-md flex items-center gap-1 text-sm">
                <span class="material-symbols-outlined text-[18px]">logout</span> Logout
            </a>

        </div>

    </nav>

    <div class="max-w-7xl mx-auto p-4 md:p-10">

        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-1">
                Produk Terbaru
            </h1>
            <p class="text-gray-500">
                Temukan dan beli produk UMKM terbaik pilihan Anda langsung di bawah ini
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

            <?php while ($product = mysqli_fetch_assoc($query)) { ?>

                <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition duration-300 border border-gray-100 flex flex-col justify-between">

                    <div>
                        <img src="../assets/uploads/<?php echo $product['gambar']; ?>" class="w-full h-48 object-cover">

                        <div class="p-5 pb-2">
                            <h2 class="text-lg font-bold text-gray-800 line-clamp-1">
                                <?php echo htmlspecialchars($product['nama_produk']); ?>
                            </h2>

                            <p class="text-gray-400 text-xs mt-1 bg-gray-100 inline-block px-2 py-0.5 rounded-md font-semibold">
                                Stok: <?php echo $product['stok'] ?? 0; ?>
                            </p>

                            <p class="text-gray-500 text-sm mt-2 line-clamp-2 min-h-[40px]">
                                <?php echo htmlspecialchars($product['deskripsi']); ?>
                            </p>

                            <div class="mt-3">
                                <span class="text-blue-900 font-bold text-xl block">
                                    Rp <?php echo number_format($product['harga'], 0, ',', '.'); ?>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="p-5 pt-0 border-t border-gray-50 mt-4">
                        <form method="POST" class="mt-4 flex flex-col gap-3">
                            <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                            
                            <div class="flex items-center justify-between bg-gray-50 p-1.5 rounded-xl border border-gray-200">
                                <span class="text-xs font-semibold text-gray-500 pl-2">Jumlah:</span>
                                <div class="flex items-center gap-1">
                                    <button type="button" onclick="ubahQty(this, -1)" class="w-8 h-8 rounded-lg bg-white border border-gray-300 flex items-center justify-center font-bold text-gray-600 hover:bg-gray-100 transition shadow-sm">-</button>
                                    <input type="number" name="qty" value="1" min="1" max="<?php echo $product['stok']; ?>" class="w-12 text-center bg-transparent font-bold text-gray-800 focus:outline-none" readonly>
                                    <button type="button" onclick="ubahQty(this, 1)" class="w-8 h-8 rounded-lg bg-white border border-gray-300 flex items-center justify-center font-bold text-gray-600 hover:bg-gray-100 transition shadow-sm">+</button>
                                </div>
                            </div>

                            <div class="grid grid-cols-4 gap-2">
                                <button type="submit" name="add_to_cart" class="col-span-3 bg-blue-900 hover:bg-blue-800 text-white py-2.5 rounded-xl font-semibold transition text-sm flex items-center justify-center gap-1 shadow">
                                    <span class="material-symbols-outlined text-[18px]">add_shopping_cart</span> Beli
                                </button>
                                <a href="../detail_produk.php?id=<?php echo $product['id']; ?>" class="col-span-1 border border-gray-300 text-gray-600 hover:bg-gray-50 rounded-xl flex items-center justify-center transition" title="Lihat detail lengkap">
                                    <span class="material-symbols-outlined text-[18px]">visibility</span>
                                </a>
                            </div>
                        </form>
                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

    <script>
        // Fungsi pengubah kuantitas input box produk
        function ubahQty(button, change) {
            const wrapper = button.parentElement;
            const input = wrapper.querySelector('input[name="qty"]');
            let currentVal = parseInt(input.value) + change;
            const maxVal = parseInt(input.getAttribute('max')) || 999;

            if (currentVal < 1) currentVal = 1;
            if (currentVal > maxVal) currentVal = maxVal;

            input.value = currentVal;
        }

        // Tampilkan Notifikasi SweetAlert2 jika ada proses masuk keranjang
        <?php if($alert == 'sukses'): ?>
            Swal.fire({
                title: 'Berhasil Ditambahkan! 🛒',
                text: 'Item berhasil dimasukkan ke keranjang belanja Anda.',
                icon: 'success',
                confirmButtonColor: '#1e3a8a',
                customClass: { popup: 'rounded-2xl' }
            }).then(() => {
                window.location.href = 'dashboard.php'; // Refresh halaman untuk merestart data badge
            });
        <?php elseif($alert == 'gagal'): ?>
            Swal.fire({
                title: 'Gagal Masuk Keranjang!',
                text: 'Terjadi masalah database. Silakan coba beberapa saat lagi.',
                icon: 'error',
                confirmButtonColor: '#1e3a8a',
                customClass: { popup: 'rounded-2xl' }
            });
        <?php endif; ?>
    </script>

</body>
</html>