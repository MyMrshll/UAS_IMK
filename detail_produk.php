<?php
session_start();
include 'config/koneksi.php';

$id = mysqli_real_escape_string($conn, $_GET['id']);

$query = mysqli_query($conn, "SELECT * FROM products WHERE id='$id'");
if (!$query) die("Query Error (SELECT products): " . mysqli_error($conn));

$product = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-blue-900 text-white p-5 flex justify-between items-center">

        <h1 class="text-2xl font-bold">
            UMKM Marketplace
        </h1>

        <a href="buyer/dashboard.php" class="bg-white text-blue-900 px-4 py-2 rounded-lg">
            Kembali
        </a>

    </nav>

    <!-- Content -->
    <div class="max-w-6xl mx-auto p-4 md:p-10">

        <div class="bg-white rounded-3xl shadow-xl overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-10 p-6 md:p-10">

            <!-- Gambar -->
            <div>

                <img src="assets/uploads/<?php echo $product['gambar']; ?>" class="w-full rounded-2xl object-cover">

            </div>

            <!-- Detail -->
            <div class="flex flex-col justify-center">

                <h1 class="text-4xl font-bold text-gray-800 mb-4">
                    <?php echo $product['nama_produk']; ?>
                </h1>

                <p class="text-2xl font-bold text-blue-900 mb-6">
                    Rp <?php echo number_format($product['harga']); ?>
                </p>

                <p class="text-gray-600 leading-relaxed mb-8">
                    <?php echo $product['deskripsi']; ?>
                </p>

                <p class="mb-6">
                    <span class="font-bold">
                        Stok:
                    </span>

                    <?php echo $product['stok']; ?>
                </p>

                <!-- Button -->
                <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="bg-blue-900 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded-xl transition text-center shadow-md">
                    Tambah ke Keranjang
                </a>

            </div>

        </div>

    </div>

</body>

</html>