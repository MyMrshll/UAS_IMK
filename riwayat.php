<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_page/login.php");
    exit;
}

$buyer_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "
SELECT * FROM orders
WHERE buyer_id='$buyer_id'
ORDER BY id DESC
");

if (!$query) die("Query Error (SELECT orders): " . mysqli_error($conn));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

    <nav class="bg-blue-900 text-white p-5 flex justify-between">

        <h1 class="text-2xl font-bold">
            Riwayat Pesanan
        </h1>

        <a href="buyer/dashboard.php" class="bg-white text-blue-900 px-4 py-2 rounded-lg">
            Kembali
        </a>

    </nav>

    <div class="max-w-5xl mx-auto p-4 md:p-10">

        <div class="bg-white rounded-2xl shadow-lg p-4 md:p-8">

            <?php while ($order = mysqli_fetch_assoc($query)) { ?>

                <div class="border-b py-5 flex flex-col sm:flex-row sm:justify-between items-start sm:items-center gap-3">

                    <div>

                        <h2 class="text-xl font-bold">
                            Order #<?php echo $order['id']; ?>
                        </h2>

                        <p class="text-gray-500">
                            <?php echo $order['created_at']; ?>
                        </p>

                    </div>

                    <div class="sm:text-right w-full sm:w-auto">

                        <p class="text-blue-900 font-bold text-xl">
                            Rp <?php echo number_format($order['total_harga']); ?>
                        </p>

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-lg text-sm">
                            <?php echo $order['status']; ?>
                        </span>

                    </div>

                </div>

            <?php } ?>

        </div>

    </div>

</body>

</html>