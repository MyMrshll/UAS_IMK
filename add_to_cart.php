<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login_page/login.php");
    exit;
}

$buyer_id = $_SESSION['user_id'];
$product_id = $_GET['id'];

// cek produk sudah ada di cart atau belum
$cek = mysqli_query($conn, "SELECT * FROM carts
WHERE buyer_id='$buyer_id'
AND product_id='$product_id'");

if (mysqli_num_rows($cek) > 0) {

    // tambah qty
    mysqli_query($conn, "UPDATE carts
    SET qty = qty + 1
    WHERE buyer_id='$buyer_id'
    AND product_id='$product_id'");

} else {

    // insert cart baru
    mysqli_query($conn, "INSERT INTO carts
    (buyer_id, product_id, qty)
    VALUES
    ('$buyer_id','$product_id','1')");
}

header("Location: keranjang.php");
exit;
?>
