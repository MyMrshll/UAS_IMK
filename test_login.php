<?php
session_start();
include 'config/koneksi.php';

$email = 'seller@example.com';
$password = 'password123';

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
if (!$query) {
    echo "Query Error: " . mysqli_error($conn) . "\n";
} else {
    echo "Found " . mysqli_num_rows($query) . " rows.\n";
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        echo "Role from DB: " . $data['role'] . "\n";
        if (password_verify($password, $data['password']) || $password === $data['password']) {
            echo "Password matched.\n";
        } else {
            echo "Password mismatch.\n";
        }
    }
}
?>
