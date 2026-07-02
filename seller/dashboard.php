<?php
session_start();
include '../config/koneksi.php';

// 1. PROTECTION HALAMAN
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_page/login.php");
    exit;
}

$page = $_GET['page'] ?? 'dashboard';
$alert = ''; // Penampung notifikasi pop-up

// 2. LOGIKA: TAMBAH PRODUK
if (isset($_POST['tambah'])) {
    $seller_id = $_SESSION['user_id'];
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    
    if (!empty($gambar)) {
        $gambar_baru = time() . "_" . $gambar;
        move_uploaded_file($tmp, "../assets/uploads/" . $gambar_baru);
    } else {
        $gambar_baru = "";
    }

    $query = mysqli_query($conn, "INSERT INTO products (seller_id, nama_produk, harga, deskripsi, gambar, stok) VALUES ('$seller_id', '$nama_produk', '$harga', '$deskripsi', '$gambar_baru', '$stok')");

    if ($query) {
        $alert = "tambah_sukses";
    } else {
        $alert = "tambah_gagal";
    }
}

// 3. LOGIKA: EDIT / UPDATE PRODUK
if (isset($_POST['update'])) {
    $id_produk = mysqli_real_escape_string($conn, $_POST['id_produk']);
    $nama_produk = mysqli_real_escape_string($conn, $_POST['nama_produk']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok']);

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    if (!empty($gambar)) {
        $gambar_baru = time() . "_" . $gambar;
        move_uploaded_file($tmp, "../assets/uploads/" . $gambar_baru);

        // Hapus gambar lama agar hemat storage
        $ambil_lama = mysqli_query($conn, "SELECT gambar FROM products WHERE id='$id_produk'");
        $data_lama = mysqli_fetch_assoc($ambil_lama);
        if (!empty($data_lama['gambar'])) {
            $path_lama = "../assets/uploads/" . $data_lama['gambar'];
            if (file_exists($path_lama)) {
                unlink($path_lama);
            }
        }

        // Query update dengan gambar baru
        $query = mysqli_query($conn, "UPDATE products SET nama_produk='$nama_produk', harga='$harga', deskripsi='$deskripsi', gambar='$gambar_baru', stok='$stok' WHERE id='$id_produk'");
    } else {
        // Query update tanpa ganti gambar
        $query = mysqli_query($conn, "UPDATE products SET nama_produk='$nama_produk', harga='$harga', deskripsi='$deskripsi', stok='$stok' WHERE id='$id_produk'");
    }

    if ($query) {
        $alert = "edit_sukses";
    } else {
        $alert = "edit_gagal";
    }
}

// 4. LOGIKA: HAPUS PRODUK
if (isset($_GET['hapus'])) {
    $id_produk = mysqli_real_escape_string($conn, $_GET['hapus']);
    
    $ambil_gambar = mysqli_query($conn, "SELECT gambar FROM products WHERE id='$id_produk'");
    $data_gambar = mysqli_fetch_assoc($ambil_gambar);
    
    if (!empty($data_gambar['gambar'])) {
        $path_gambar = "../assets/uploads/" . $data_gambar['gambar'];
        if (file_exists($path_gambar)) {
            unlink($path_gambar);
        }
    }

    $hapus = mysqli_query($conn, "DELETE FROM products WHERE id='$id_produk'");
    if ($hapus) {
        $alert = "hapus_sukses";
    } else {
        $alert = "hapus_gagal";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMKM Seller Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700&family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f3f4f6; }
    </style>
</head>
<body class="min-h-screen flex flex-col md:flex-row">

    <div class="w-full md:w-64 bg-blue-900 text-white flex flex-col md:min-h-screen p-6 relative md:fixed">
        <h1 class="text-2xl font-bold mb-8">UMKM Seller</h1>
        <nav class="flex flex-col gap-4 flex-1">
            <a href="?page=dashboard" class="flex items-center gap-3 p-3 rounded-lg transition-all <?= $page == 'dashboard' ? 'bg-blue-700 font-semibold shadow-inner' : 'hover:bg-blue-800' ?>">
                <span class="material-symbols-outlined">dashboard</span> Dashboard
            </a>
            <a href="?page=tambah_produk" class="flex items-center gap-3 p-3 rounded-lg transition-all <?= $page == 'tambah_produk' ? 'bg-blue-700 font-semibold shadow-inner' : 'hover:bg-blue-800' ?>">
                <span class="material-symbols-outlined">add_box</span> Tambah Produk
            </a>
            <a href="?page=daftar_produk" class="flex items-center gap-3 p-3 rounded-lg transition-all <?= ($page == 'daftar_produk' || $page == 'edit_produk') ? 'bg-blue-700 font-semibold shadow-inner' : 'hover:bg-blue-800' ?>">
                <span class="material-symbols-outlined">inventory_2</span> Daftar Produk
            </a>
            <a href="../logout.php" class="flex items-center gap-3 p-3 rounded-lg hover:bg-red-700 transition-all mt-auto text-red-200">
                <span class="material-symbols-outlined">logout</span> Logout
            </a>
        </nav>
    </div>

    <div class="flex-1 md:ml-64 p-4 md:p-8">
        
        <?php if ($page == 'dashboard'): ?>
            <div class="bg-white p-8 rounded-2xl shadow-md max-w-3xl border border-gray-200">
                <h1 class="text-3xl font-bold text-gray-800">
                    Selamat Datang, <?= htmlspecialchars($_SESSION['nama'] ?? 'Seller'); ?>!
                </h1>
                <p class="text-gray-500 mt-2">Kelola operasional dan produk jualan UMKM Anda dengan mudah di sini.</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6">
                    <a href="?page=daftar_produk" class="p-6 bg-blue-50 rounded-xl border border-blue-100 hover:bg-blue-100 transition block">
                        <span class="material-symbols-outlined text-blue-600 text-3xl">inventory</span>
                        <h3 class="font-bold text-gray-800 mt-2">Lihat Produk</h3>
                        <p class="text-sm text-gray-500">Cek stok dan daftar barang</p>
                    </a>
                    <a href="?page=tambah_produk" class="p-6 bg-green-50 rounded-xl border border-green-100 hover:bg-green-100 transition block">
                        <span class="material-symbols-outlined text-green-600 text-3xl">add_box</span>
                        <h3 class="font-bold text-gray-800 mt-2">Tambah Baru</h3>
                        <p class="text-sm text-gray-500">Mulai jual produk baru</p>
                    </a>
                </div>
            </div>

        <?php elseif ($page == 'tambah_produk'): ?>
            <div class="bg-white p-8 rounded-2xl shadow-md max-w-3xl border border-gray-200">
                <h2 class="text-3xl font-bold text-gray-800 mb-1">Tambah Produk</h2>
                <p class="text-sm text-gray-500 mb-8">Masukkan rincian informasi produk UMKM Anda</p>

                <form method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" required class="w-full border border-gray-300 rounded-xl p-3.5 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Masukkan nama produk">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Harga (Rp)</label>
                        <input type="number" name="harga" required class="w-full border border-gray-300 rounded-xl p-3.5 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: 15000">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" required class="w-full border border-gray-300 rounded-xl p-3.5 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Spesifikasi produk"></textarea>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Stok</label>
                        <input type="number" name="stok" required class="w-full border border-gray-300 rounded-xl p-3.5 focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Jumlah stok">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Gambar Produk</label>
                        <input type="file" name="gambar" required class="w-full border border-gray-300 rounded-xl p-3 bg-gray-50 file:mr-4 file:py-1.5 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <button type="submit" name="tambah" class="bg-blue-900 hover:bg-blue-800 text-white p-4 rounded-xl font-semibold transition duration-300 shadow-md mt-2">
                        Simpan & Publikasikan Produk
                    </button>
                </form>
            </div>

        <?php elseif ($page == 'edit_produk'): ?>
            <?php 
            $id_edit = mysqli_real_escape_string($conn, $_GET['id'] ?? '');
            $ambil_data = mysqli_query($conn, "SELECT * FROM products WHERE id='$id_edit'");
            if (!$ambil_data) die("Query Error (SELECT products edit): " . mysqli_error($conn));
            $data = mysqli_fetch_assoc($ambil_data);

            if (!$data) {
                echo "<p class='text-red-500'>Data tidak ditemukan!</p>";
            } else {
                // Sinkronisasi nama field database
                $e_nama = $data['nama_produk'] ?? $data['name'] ?? '';
                $e_harga = $data['harga'] ?? $data['price'] ?? 0;
                $e_deskripsi = $data['deskripsi'] ?? $data['description'] ?? '';
                $e_stok = $data['stok'] ?? $data['stock'] ?? 0;
                $e_gambar = $data['gambar'] ?? $data['image'] ?? '';
            ?>
            <div class="bg-white p-8 rounded-2xl shadow-md max-w-3xl border border-gray-200">
                <h2 class="text-3xl font-bold text-gray-800 mb-1">Edit Produk</h2>
                <p class="text-sm text-gray-500 mb-8">Perbarui data informasi barang dagangan Anda</p>

                <form method="POST" enctype="multipart/form-data" class="flex flex-col gap-5">
                    <input type="hidden" name="id_produk" value="<?= $data['id']; ?>">
                    
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Nama Produk</label>
                        <input type="text" name="nama_produk" value="<?= htmlspecialchars($e_nama); ?>" required class="w-full border border-gray-300 rounded-xl p-3.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Harga (Rp)</label>
                        <input type="number" name="harga" value="<?= $e_harga; ?>" required class="w-full border border-gray-300 rounded-xl p-3.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Deskripsi</label>
                        <textarea name="deskripsi" rows="4" required class="w-full border border-gray-300 rounded-xl p-3.5 focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($e_deskripsi); ?></textarea>
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Stok</label>
                        <input type="number" name="stok" value="<?= $e_stok; ?>" required class="w-full border border-gray-300 rounded-xl p-3.5 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block mb-2 font-semibold text-gray-700">Gambar Produk Saat Ini</label>
                        <?php if(!empty($e_gambar) && file_exists("../assets/uploads/" . $e_gambar)): ?>
                            <img src="../assets/uploads/<?= $e_gambar; ?>" class="w-24 h-24 object-cover rounded-lg mb-3 border border-gray-200">
                        <?php endif; ?>
                        <input type="file" name="gambar" class="w-full border border-gray-300 rounded-xl p-3 bg-gray-50 file:mr-4 file:py-1.5 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <span class="text-xs text-gray-400 mt-1 block">*Biarkan kosong jika tidak ingin mengganti gambar produk.</span>
                    </div>
                    
                    <div class="flex gap-3 mt-2">
                        <button type="submit" name="update" class="flex-1 bg-blue-900 hover:bg-blue-800 text-white p-4 rounded-xl font-semibold transition duration-300 shadow-md">
                            Simpan Perubahan
                        </button>
                        <a href="?page=daftar_produk" class="bg-gray-200 hover:bg-gray-300 text-gray-700 p-4 rounded-xl font-semibold transition text-center px-6">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
            <?php } ?>

        <?php elseif ($page == 'daftar_produk'): ?>
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Daftar Produk</h2>
                    <p class="text-sm text-gray-500 mt-1">Kelola seluruh produk jualan UMKM Anda di sini</p>
                </div>
                <a href="?page=tambah_produk" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-4 rounded-lg flex items-center gap-2 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[20px]">add</span> Tambah Baru
                </a>
            </div>

            <div class="bg-white rounded-xl shadow-md overflow-x-auto border border-gray-200">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-gray-700 font-semibold text-sm">
                            <th class="p-4 w-16 text-center">No</th>
                            <th class="p-4 w-24">Gambar</th>
                            <th class="p-4">Nama Produk</th>
                            <th class="p-4">Harga</th>
                            <th class="p-4 text-center">Stok</th>
                            <th class="p-4">Deskripsi</th>
                            <th class="p-4 text-center w-36">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-600 divide-y divide-gray-200">
                        <?php 
                        $no = 1;
                        $query = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
                        if (!$query) die("Query Error (SELECT products): " . mysqli_error($conn));
                        if ($query && mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_assoc($query)) { 
                                $nama = $row['nama_produk'] ?? $row['name'] ?? $row['nama'] ?? 'Tanpa Nama';
                                $harga = $row['harga'] ?? $row['price'] ?? 0;
                                $stok = $row['stok'] ?? $row['stock'] ?? 0;
                                $deskripsi = $row['deskripsi'] ?? $row['description'] ?? '-';
                                $img = $row['gambar'] ?? $row['image'] ?? '';
                        ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4 text-center font-medium"><?= $no++; ?></td>
                            <td class="p-4">
                                <?php if(!empty($img) && file_exists("../assets/uploads/" . $img)): ?>
                                    <img src="../assets/uploads/<?= $img; ?>" alt="Produk" class="w-16 h-16 object-cover rounded-lg border border-gray-200">
                                <?php else: ?>
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center border border-dashed border-gray-300">
                                        <span class="material-symbols-outlined text-gray-400">image</span>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="p-4 font-semibold text-gray-800"><?= htmlspecialchars($nama); ?></td>
                            <td class="p-4 font-medium text-blue-600">Rp <?= number_format($harga, 0, ',', '.'); ?></td>
                            <td class="p-4 text-center font-semibold <?= $stok <= 5 ? 'text-red-500' : 'text-gray-700'; ?>">
                                <?= $stok; ?>
                            </td>
                            <td class="p-4 max-w-xs truncate"><?= htmlspecialchars($deskripsi); ?></td>
                            <td class="p-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="?page=edit_produk&id=<?= $row['id']; ?>" class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-lg border border-amber-200 transition-all" title="Edit">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </a>
                                    <button onclick="konfirmasiHapus(<?= $row['id']; ?>)" class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg border border-red-200 transition-all" title="Hapus">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php 
                            }
                        } else { 
                        ?>
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400">
                                <span class="material-symbols-outlined text-4xl mb-2">inventory</span>
                                <p class="text-sm">Belum ada produk yang ditambahkan.</p>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

    </div>

    <script>
        function konfirmasiHapus(id) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Produk akan dihapus permanen dari katalog!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1e3a8a',
                cancelButtonColor: '#ef4444',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-2xl' }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `?page=daftar_produk&hapus=${id}`;
                }
            })
        }

        // Trigger Pop-up Notifikasi Otomatis
        <?php if($alert == 'tambah_sukses'): ?>
            Swal.fire({ title: 'Berhasil!', text: 'Produk baru telah ditambahkan.', icon: 'success', confirmButtonColor: '#1e3a8a' })
            .then(() => { window.location.href = '?page=daftar_produk'; });
        <?php elseif($alert == 'tambah_gagal'): ?>
            Swal.fire({ title: 'Gagal!', text: 'Gagal menambah data produk.', icon: 'error', confirmButtonColor: '#1e3a8a' });
        
        <?php elseif($alert == 'edit_sukses'): ?>
            Swal.fire({ title: 'Berhasil Diupdate!', text: 'Data produk telah diperbarui.', icon: 'success', confirmButtonColor: '#1e3a8a' })
            .then(() => { window.location.href = '?page=daftar_produk'; });
        <?php elseif($alert == 'edit_gagal'): ?>
            Swal.fire({ title: 'Gagal Update!', text: 'Gagal memperbarui data produk.', icon: 'error', confirmButtonColor: '#1e3a8a' });

        <?php elseif($alert == 'hapus_sukses'): ?>
            Swal.fire({ title: 'Dihapus!', text: 'Produk berhasil dihapus.', icon: 'success', confirmButtonColor: '#1e3a8a' })
            .then(() => { window.location.href = '?page=daftar_produk'; });
        <?php endif; ?>
    </script>
</body>
</html>